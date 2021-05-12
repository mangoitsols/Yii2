<?php

namespace app\models;
use app\services\DbUtils;
use Yii;

/**
 * This is the model class for table "carmailproduction.customer_review".
 *
 * @property int $id
 * @property int $sales_id
 * @property int $customer_id
 * @property int $sales_rep_id
 * @property int $rating
 * @property int $review_image
 * @property string $title
 * @property string $customer_name
 * @property string $customer_email
 * @property string $details
 * @property string $created_at
 * @property string $updated_at
 * @property string $job_id
 * @property string $vin
 * @property int $is_sms
 */
class CustomerReview extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'carmailproduction.customer_review';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'sales_rep_id', 'rating', 'sales_id','is_sms','job_id'], 'integer'],
            [['details','vin','customer_email','customer_name'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_id' => 'Sales ID',
            'customer_id' => 'Customer ID',
            'sales_rep_id' => 'Sales Rep',
            'rating' => 'Rating',
            'title' => 'Title',
            'details' => 'Details',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'vin'=>'vin',
            'buyerName' => 'Buyer',
            'sellerName' => 'Seller',
            'vehicleImage' => 'Vehicle'
        ];
    }

    public function getBuyersSales()
    {
        return $this->hasOne(BuyersSales::className(), ['id' => 'sales_id']);
    }

    public function getBuyer()
    {
        return $this->hasOne(Buyers::className(), ['id' => 'customer_id']);
    }

    /*** Added By Arpit */

    public function getSeller()
    {
        return $this->hasOne(Users::className(), ['id' => 'sales_rep_id']);
    }

    public function getVehicle()
    {
        return $this->hasOne(Vehicles::className(), ['vin' => 'vin']);
    }

    public function getBuyerName()
    {
        return ($this->buyer != null)? $this->buyer->firstname . " " . $this->buyer->lastname : "";
    }

    public function getSellerName()
    {
        return ($this->seller != null)? $this->seller->first_name . " " . $this->seller->last_name : "";
    }

    public function getVehicleImage()
    {
        if($this->vehicle != null){
            if($this->vehicle->display_image){
                return '/web/img/'.$this->vehicle->display_image;
            }else{
                return $this->vehicle->primaryImage;
            }
        }else{
            return '';
        }
    }

    public static function getTotalreviewsCount(){
        $query = (new \yii\db\Query())->select(['count(*) as total_reviews'])->from('carmailproduction.customer_review')->where('DATE(created_at) = DATE(NOW())');
        $command = $query->createCommand();
        $result = $command->queryAll();
        return $result;
    }

    public static function getfiltercounts($filterval){
        $result = '';
        if(!empty($filterval) && $filterval == 'Today'){
            $query = (new \yii\db\Query())->select(['count(*) as total_reviews'])->from('carmailproduction.customer_review')->where('DATE(created_at) = DATE(NOW())');
            $command = $query->createCommand();
            $result = $command->queryAll();
            
        }elseif($filterval == 'Yesterday'){
            $query = (new \yii\db\Query())->select(['count(*) as total_reviews'])->from('carmailproduction.customer_review')->where('DATE(created_at) >= DATE(NOW() - INTERVAL 1 DAY)');
            $command = $query->createCommand();
            $result = $command->queryAll();
        }elseif($filterval == 'Week'){
            $query = (new \yii\db\Query())->select(['count(*) as total_reviews'])->from('carmailproduction.customer_review')->where('DATE(created_at) >= DATE(NOW() - INTERVAL 1 WEEK)');
            $command = $query->createCommand();
            $result = $command->queryAll();
        }elseif($filterval == 'Month'){
            $query = (new \yii\db\Query())->select(['count(*) as total_reviews'])->from('carmailproduction.customer_review')->where('DATE(created_at) >= DATE(NOW() - INTERVAL 1 MONTH)');
            $command = $query->createCommand();
            $result = $command->queryAll();
        }           
            return $result;
    }

    /*** End */

    public static function getBuyerAvgRating( $buyer_id ){

        $query = "SELECT avg(carmailproduction.customer_review.rating) as `avg`, count(*) as `total`  FROM carmailproduction.customer_review WHERE carmailproduction.customer_review.sales_rep_id=".$buyer_id;
        $obj = DbUtils::getOne($query);
        $total = 0;
        if($obj && $obj['total']){
            $total = intval($obj['total']);
        }


        $query = "SELECT carmailproduction.customer_review.rating, count(*) as `count`  FROM carmailproduction.customer_review WHERE carmailproduction.customer_review.sales_rep_id='".$buyer_id."' group by carmailproduction.customer_review.rating" ;
        $list = DbUtils::getAll($query);
        $ratings = [];
        $ratings[1] = 0;
        $ratings[2] = 0;
        $ratings[3] = 0;
        $ratings[4] = 0;
        $ratings[5] = 0;

        foreach($list as $l){
            $count = intval($l['count']);
            $percent = 0;
            if($count > 0){
                $percent = ($count * 100) / $total;
            }
            $ratings[intval($l['rating'])]= $percent;
        }
        $avgRating = new \stdClass();
        $avgRating->ratings = $ratings;
        $avgRating->avg = $obj['avg'];
        $avgRating->total = $obj['total'];
        return $avgRating;
    }
    public static function sendReviewEmail($review){




            $vehicle = Vehicles::find()->where(['vin'=>$review->vin])->one();
//            if($vehicle->newused == 'U'){
//                $imgModel = 'https://londoff.revferral.com/img/usedgenericimage.png';
//            }else{
                $imgModel = $vehicle->getGenericImageByModel();
          //  }
            $saler = Users::find()->where(['id'=>$review->sales_rep_id])->one();
            $vehicleINfo  = $vehicle->year.' '.$vehicle->make.' '.$vehicle->model;
            $image =  $review->buyersSales->vehicle_img;
            $arrSales  = Users::find()->where(['role'=>2, 'company_id'=>3])->all();
        $urlss= 'https://'.$saler->company->setting->subdomain.'.revferral.com';
        $url = $urlss.'/advisor-review-details.php?saler_id=';



            $startimg =Yii::$app->params['RTAGURL'].'/img/Review-'.$review->rating.'.png';

            //foreach ($arrSales as $item){
                $emailThemplate = EmailTemplate::find()->where(['title'=>'saler-email-review'])->one();
                $emailThemplate->body=str_replace('%IMAGE%',$image,$emailThemplate->body);
                $emailThemplate->body=str_replace('%CUSTOMER%',$review->customer_name,$emailThemplate->body);
                $emailThemplate->body=str_replace('%REVIEWTEXT%',$review->details,$emailThemplate->body);
                $emailThemplate->body=str_replace('%SALER%',$saler->first_name.' '.$saler->last_name,$emailThemplate->body);
                $emailThemplate->body=str_replace('%SALERIMG%',$saler->image_url,$emailThemplate->body);
                $emailThemplate->body=str_replace('%VEHICLEINFO%',$vehicleINfo,$emailThemplate->body);
                $emailThemplate->body=str_replace('%MODELIMG%',$imgModel,$emailThemplate->body);
                $emailThemplate->body=str_replace('%URLSALER%',$url.$saler->id,$emailThemplate->body);
                $emailThemplate->body=str_replace('%RATINGIMG%',$startimg,$emailThemplate->body);

                $urlss= 'https://'.$saler->company->setting->subdomain.'.revferral.com';
                $shareurl = 'https://www.facebook.com/sharer/sharer.php?text=Thank%20You&amp;u='.$urlss.'/index.php?token='.$review->buyersSales->token.'%26ogreviewid='.$review->id;

                $emailThemplate->body=str_replace('%SHAREURL%',$shareurl,$emailThemplate->body);
                $sgmailer = Yii::$app->sgmailer;
                $send = $sgmailer->compose()
                    ->setFrom(['noreply@revferral.com' => str_replace("@"," at ",'randyz@revferral.com')])
                    ->setReplyTo('noreply@revferral.com')
                    //->setTo('randyz@optimum-response.com')
                    ->setTo($saler->email)
                    //->setTo('avik.torosyan987@gmail.com')
                    ->setSubject('New review')
                    ->setHtmlBody($emailThemplate->body)
                    //->addCustomArg('suuid', $suuid)
                    ->addCustomArg('sentto', "saler")
                    ->send();

        $buyer = $review->buyersSales->buyer_name;
        $buyer_first_name = explode(' ', $review->buyersSales->buyer_name);
        $emailThemplate = EmailTemplate::find()->where(['title'=>'seller-email-review'])->one();
        $emailThemplate->body=str_replace('%IMAGE%',$image,$emailThemplate->body);
        $emailThemplate->body=str_replace('%CUSTOMER%',$review->customer_name,$emailThemplate->body);
        $emailThemplate->body=str_replace('%REVIEWTEXT%',$review->details,$emailThemplate->body);
        $emailThemplate->body=str_replace('%BUYER%',$buyer,$emailThemplate->body);
        $emailThemplate->body=str_replace('%FIRSTNAME%',$buyer_first_name[0],$emailThemplate->body);
        $emailThemplate->body=str_replace('%SALER%',$saler->first_name.' '.$saler->last_name,$emailThemplate->body);
        $emailThemplate->body=str_replace('%SALERIMG%',$saler->image_url,$emailThemplate->body);
        $emailThemplate->body=str_replace('%SALEREMAIL%',$saler->email,$emailThemplate->body);
        $emailThemplate->body=str_replace('%SALERPHONE%',$saler->phone,$emailThemplate->body);
        $emailThemplate->body=str_replace('%VEHICLEINFO%',$vehicleINfo,$emailThemplate->body);
        $emailThemplate->body=str_replace('%MODELIMG%',$imgModel,$emailThemplate->body);
        $emailThemplate->body=str_replace('%URLSALER%',$url.$saler->id,$emailThemplate->body);
        $emailThemplate->body=str_replace('%RATINGIMG%',$startimg,$emailThemplate->body);
        $emailThemplate->body=str_replace('%COMPANY_NAME%',$saler->company->name,$emailThemplate->body);
        $emailThemplate->body=str_replace('%COMPANY_ADRESS%',$saler->company->setting->address,$emailThemplate->body);
        $emailThemplate->body=str_replace('%COMPANY_URL%',$saler->company->setting->web_site_link,$emailThemplate->body);
        $emailThemplate->body=str_replace('%COMPANY_PHONE%',$saler->company->setting->service_phone,$emailThemplate->body);
        $url = $urlss.'/index.php?token='.$review->buyersSales->token.'%26ogreviewid='.$review->id;

//        $shareurl = 'https://www.facebook.com/sharer/sharer.php?text=Thank%20You&amp;u='.$url;
        $emailThemplate->body=str_replace('%SHAREURL%',$shareurl,$emailThemplate->body);
        $sgmailer = Yii::$app->sgmailer;
        $send = $sgmailer->compose()
            ->setFrom($saler->email)
//            ->setFrom(['noreply@revferral.com' => str_replace("@"," at ",'randyz@revferral.com')])
            ->setReplyTo('noreply@revferral.com')
             //->setTo('randyz@optimum-response.com')
            ->setTo($review->buyersSales->buyer_email)
            //->setTo('avik.torosyan987@gmail.com')
            ->setSubject($emailThemplate->subject)
            ->setHtmlBody($emailThemplate->body)
            //->addCustomArg('suuid', $suuid)
            ->addCustomArg('sentto', "saler")
            ->send();
        $return = 'https://www.facebook.com/sharer/sharer.php?text=Thank%20You&u='.$urlss.'/index.php?token='.$review->buyersSales->token.'%26ogreviewid='.$review->id;

        return $return;

    }
}
