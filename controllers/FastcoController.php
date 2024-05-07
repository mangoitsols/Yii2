<?php

namespace app\controllers;
use Yii;
use app\models\Users;
use app\models\WpUsers;
use app\models\UserDevices;
use yii\web\Controller;
use Firebase\JWT\JWT;
use Firebase\JWT\JWK;
use yii\httpclient\Client;
use app\models\utilities\AnalyticsHelper;

/**
 * Class FastcoController
 *
 * This is the controller for the FastcoIntegration
 *
 * @package app\controllers
 * @copyright Copyright (c) 2015 Petcloud PTY LTD
 * @author Charles Galvin <charles@petcloud.com.au>
 * @version 2.6.0 2.6.0
 */
 
class FastcoController extends Controller
{
	use AnalyticsHelper;
	
	public function actionIndex() {
		
		
		$data = Yii::$app->request->get();
		
		if(isset($data['token']) && $data['token']){
			if($data = $this->verifylogin($data)){
				$user = Users::find()->where(['email' => $data->email])->one();
				  if($user){
					if($user->login(true)){ 
						include('../web/d/wp-blog-header.php'); 
						include('../web/d/wp-load.php');
						$key = WpUsers::checkWpUser(Yii::$app->user->identity);
						if($key){
							
							if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
							  $secureset = true;
							}else{
							  $secureset = false;
							}
							clean_user_cache($key);
							wp_clear_auth_cookie();
							wp_set_current_user( $key );
							wp_set_auth_cookie( $key , true,$secureset);
									
								
						}
						$this->ReferralCreate($user->id, $user->first_name, $user->email);
						$this->recordEvent('login', ['login-type' => 'fastco']);
						if (Yii::$app->getUser()->getReturnUrl() == Yii::$app->getHomeUrl()){
							return $this->redirect(['/dashboard']);
						}else{
							return $this->goBack();
						}
					}
				  }	
			}else{
				return $this->redirect(['/login']);
			}
		}
		
		Yii::$app->session->setFlash('error', Yii::t('app','Something went wrong try again'));
		
		return $this->redirect(['/login']);
		
	}
	
	public function verifylogin($data){
		
		$keys = $this->checkforKeys($data['token']);	
		
		try{
		
		if($keys){
			
			$jwks = json_decode($keys,true);
			$token = $data['token'];
			$data  = JWT::decode($token, JWK::parseKeySet($jwks),['RS256']);
			return $data;
		}else{
			Yii::$app->session->setFlash('error','Something went wrong try again');
		}	
		}catch(\Exception $ex){
			//echo $ex->getMessage(); die;
			Yii::$app->session->setFlash('error', $ex->getMessage());
			return false;
		}
		return false;
	}
	
	public function checkforKeys($token){
		
		$api_url = "https://api.fast.co/v1/oauth2/jwks";
		$keys = '';
		$client = new Client();
		$filePath = Yii::getAlias('@webroot') . "/../uploads/fastco.json";
		if(file_exists($filePath)){
			$keys = file_get_contents($filePath);
		}else{
			
			$response = $client->createRequest()
			->setMethod('GET')
			->setUrl($api_url)
			->setOptions([
				'userAgent' => $_SERVER['HTTP_USER_AGENT']
			])
			->send();
			
			if(isset($response->content) && $response->content){
				$keys = $response->content;
				file_put_contents($filePath,$keys);
			}
		}
		$keyexist = false;
		if(!empty($keys)){
			$keysArray = json_decode($keys,true);
			$tokenData = explode('.',$token);
			$tokenHeader = json_decode($tokenData[0],true);
			foreach($keysArray as $key){
				if(isset($tokenHeader['kid']) && $tokenHeader['kid'] == $key['kid']){
					$keyexist  = true;
				}
			}
			
			if(!$keyexist){
				$response = $client->createRequest()
				->setMethod('GET')
				->setUrl($api_url)
				->setOptions([
					'userAgent' => $_SERVER['HTTP_USER_AGENT']
				])
				->send();
				
				if(isset($response->content) && $response->content){
					$keys = $response->content;
					file_put_contents($filePath,$keys);
				}
			}
		}
		
		return $keys;	
	}
	
	 public function ReferralCreate($id, $first_name, $email) {
		
		if(Yii::$app->session->has('PetCloudReferral') && Yii::$app->session->has('ReferralCode') ){
			 
			$baseUrl = Yii::getAlias('@web');
			$affiliate_id = Yii::$app->session->get('PetCloudReferral');
			$code = Yii::$app->session->get('ReferralCode');
			$user = Yii::$app->user->identity;
			$user_id = Yii::$app->user->identity->id ;
			$main_url = $baseUrl ;
			$api_url = $main_url."/d/wp-json/affwp/v1/referrals/?affiliate_id=".$affiliate_id."&amount=0&type=lead&reference=".$user_id."&description=SignUp";
			$Referal = WpUsers::createReferral($affiliate_id,$api_url,DEV_Affiliate_Key);
			//$this->doReferralandCoupon($code, $id, $first_name, $email);
			$model = new Wallet();
			$model->user_id = Yii::$app->user->id;
			$model->available_balance = 10;
			$model->non_withdrawable = 10;
			$model->total_balance = 10;
			$model->registeration_type = $affiliate_id;
			
			if ($model->save()) {
				
				$modelTrans = new WalletTransaction();
				$modelTrans->wallet_id = $model->id ;
				$modelTrans->userId = $model->user_id ;
				$modelTrans->amount = 10;
				$modelTrans->txn_type = 'promo';
				$modelTrans->description = 'Referral Credits';
				$modelTrans->status = 4;
				$modelTrans->save();
			}
			 // Mailqueue::createMessage($user->email, 'Your $10 Coupon', "referral/referralreward");
			  Mailqueue::createMessage($user->email, "Your friend just gave you $10", 'referral/referralreward', null);
				 
			
			Yii::$app->session->setFlash("info", Yii::t('app', "Welcome to PetCloud, $10 Credited on your wallet."));
			Yii::$app->session->remove('PetCloudReferral');
			Yii::$app->session->remove('ReferralCode');
		}
	 }
}
