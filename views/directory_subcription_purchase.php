<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use app\assets\ProductAsset;
use yii\helpers\ArrayHelper;
use app\models\Country;
if(Yii::$app->user->identity){ 

	$countries = Country::find()->all();
	
}
ProductAsset::register($this);
/* @var $this yii\web\View */
$this->title = 'RSPCA Certified Online Pet Sitter Course';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'description', 'content' => 'Developed & designed by the Vet scientists at RSPCA, this online Pet Sitting Course is certified by RSPCA. Join PetCloud now as a Pet Sitter']);
$this->params['submenu'] = Yii::$app->params['ourDifferenceSubMenu'];
$this->params['submenu-active-label'] = 'Our Difference';
$imageUrl = Yii::getAlias('@imageUrl');
?>
<div class="container content contentsbox">
    <div class="row">
       <div class="container h-100">
		<div class="row h-100 justify-content-center align-items-center">
			
				<!-- Form -->
				 <?php 
				 
				if(isset(Yii::$app->user->identity) && Yii::$app->user->identity){
				
				
				?>
					
				<section class="complete_purchase_sec">
				  <div class="container">
					  <div class="row">
						<div class="col-md-12">
						<div class="purchase_wrap_box">
						<div class="purchase_title">
						<h1>Complete Your Purchase</h1>
						</div>

						   <div class="purchase_box_content">
						<div class="purchase_box">
						<div class="row">
						<?php if($product->name == "Pet Sitting Course"){ ?>
						  <div class="col-sm-3 col-md-3">
						 <div class="img_purchase"><img src="/img/pages/home-page/Weekly Dog Walking.png" class="img-responsive lazy-load"></div>
						  </div>
						<div class="col-sm-9 col-md-9">
						<div class="purchase_box_text">
						<h3><?= $product->name; ?></h3>
						<p>Do you dream of working with animals? Then being a pet sitter/dog walker might be the answer! Get your confidence up and understand the standard of care the RSPCA expects and how to handle potentially tricky situations</p>
						<div class="box_txt_img">
						Petcloud
						</div>
						</div>
						</div>
						<?php }else{
							
							echo '<h3>'.$product->name.'</h3>';
							
						} ?>
						</div>
						</div>
						<div class="purchase_subtotal">
							<div class="subtotl">
								<span>Subtotal</span><span>A$<?= number_format($product->price,2) ?></span>
							</div>
							 <div class="total">
								<span>Total</span><span>A$<?= number_format($product->price,2) ?></span>
							</div>
						</div>
					
					<div class="credit_card_box">
						<div class="bs-example">
						<div class="panel-group" id="accordion">
						<?php /*	
						<?php
							$user = Yii::$app->user->identity;
							if($user->stripeCustomerId && $user->stripeCardId){ ?>
							<div class="panel panel-default">
								<div class="panel-heading">
								   <a data-toggle="collapse" data-parent="#accordion" href="#collapsethree" aria-expanded="false" class="collapsed"><div class="credit_title panel-title card_title_bottom">
										<h3> <i class="fa fa-check-circle" aria-hidden="true"></i>Saved Card</h3>
										<div class="pay_cards">
										Pay with Card Ending xxxx<?php echo $lastcard->last4; ?>
										</div>
										</div></a>
								   
									</div>
									<div id="collapsethree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
										<div class="panel-body">
											<div class="card_pay_form text-center">
												<button data-id="<?= $product->id; ?>" class="btn primary" id="pay-with-stripe">Purchase</button>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>	
							<div class="panel panel-default">
								<div class="panel-heading">
								   
								<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="collapsed" aria-expanded="false"><div class="credit_title panel-title">
					<h3> <i class="fa fa-check-circle" aria-hidden="true"></i> Credit Card</h3>
					<div class="pay_cards">
					<img src="/img/cards/visa.png"><img src="/img/cards/mastercard.png">
					</div>
					</div></a>
							   
					</div>
					<div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
						<div class="panel-body">
							<div class="card_pay_form credit_card_form">
									<form id="Stripe_card_form">
										<div class="form-group">
										<label>Name on card</label>
										<input type="text" class="form-control" required="required" name="Name" placeholder="Name on card">
										</div>
										<div class="form-group">
										<label>Card Number</label>
										<input type="text" maxlength="16" name="card_number"class="form-control" required="required" placeholder="Card Number">
										</div>
										<div class="form-group">
										<label>Expiration Date</label>
										<div class="expire_date">
										<span><input type="text" maxlength="2" class="form-control" name="expiry_month" required="required" placeholder="MM"></span>
										<span>/</span>
										<span><input type="text" maxlength="2" class="form-control" name="expiry_year" required="required" placeholder="YY"></span>
										</div>
										</div>
										<div class="form-group">
										<label>CVV</label>
										<input type="text" maxlength="4" name="cvv" class="form-control cvv_input" required="required" placeholder="CVV">
										</div>
										<div class="form-group">
										<label>Country</label>
										<select name="country" required="required">
										<option>Select your country</option>
										<?php foreach($countries as $country){ ?>
											<option value="<?= $country->countryname ?>"><?= $country->countryname ?></option>
										<?php } ?>
										</select>
											<input type="hidden" name="payment_type" value="stripe">
											<input type="hidden" name="productId" value="<?= $product->id ?>">
											<input type="hidden" class="productsku" name="productSKU" value="<?= $product->sku ?>">
											
										</div>
										<div class="form-submit">
											<input type="submit" class="btn primary" name="stripe_submit" value="Purchase">
										</div>
									</form>

										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
								   <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" class="collapsed"><div class="credit_title panel-title card_title_bottom">
					<h3> <i class="fa fa-check-circle" aria-hidden="true"></i>Paypal</h3>
					<div class="pay_cards">
					<img  class="paypal-img" src="/img/cards/paypal.png">
					</div>
					</div></a>
               
							</div>
							<div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
								<div class="panel-body">
									<div class="card_pay_form text-center">
										<button data-id="<?= $product->id; ?>" class="btn primary" id="pay-with-paypal">Purchase with Paypal</button>
									</div>
								</div>
							</div>
						</div>
					  */ ?>
					  <div class="card_pay_form text-center">
						<button data-id="<?= $product->id; ?>" data-uom="<?= $product->Uom; ?>" class="btn primary" id="pay-with-wallet">Purchase</button>
					</div>
					</div>
					</div>
					</div> 
						</div>
						</div>
						</div>
					  </div>
				   </div>
				</section>
					
					
					
				<?php }else{
					
				$showExtra = "block"; 
				 if (array_key_exists("email",$model->getErrors())){
					 $errorsArray = implode(",",$model->getErrors()['email']);
					 if(strpos($errorsArray,'already registered') != false){
						$showExtra = "none";	
					 }
				 }
				 
				 $form = ActiveForm::begin([
					'id' => 'order-form',
					'options' => ['class' => 'subtext', 'id' => 'order_form','name' => 'order_form'],
					]); ?>
					<h1><?php echo $product->name; ?></h1>
					<div id="login_error"></div>
					<div id="exist_email">
					<?php if($showExtra == "none"){ ?>
					<div class='alert alert-danger'><p>A profile already exists with this email, please check if it's your email address. Is it your email? Please click on <a id ='change_pass_model' data-toggle='modal' data-target='#change_password'> Enter your password </a>or <a id ='reset_email'>Reset your password</a>.Don't worry, you can still change the email address in the box below;</p></div>
					<?php } ?>
					</div>
					<div id="sucess_email"></div>
					<div class="col-sm-6">
					<h4>Enter Your Details:</h4>
					<div class="signup_details" style="display:<?php echo $showExtra; ?>">
					<?= $form->field($model, 'first_name', [
                        'template' => "<div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-user\"></i></span>{input}</div>{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'First Name']
                    ]) ?>
					<?= $form->field($model, 'last_name', [
                        'template' => "<div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-user\"></i></span>{input}</div>{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Last Name']
                    ]) ?>
					</div>
					
					<?= $form->field($model, 'email', [
                        'template' => "<div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-envelope\"></i></span>{input}</div>{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Email']
                    ]) ?>
					<div class="signup_details" style="display:<?php echo $showExtra; ?>">
					<?= $form->field($model, 'password', [
                        'template' => "<div class=\"input-group\"><span class=\"input-group-addon\"><i class=\"fa fa-lock\"></i></span>{input}</div>{error}",
                        'inputOptions' => ['class' => 'form-control', 'placeholder' => 'Password']
                    ])->passwordInput(); ?>
					<?php /*  echo $form->field($model, 'course_sku')->checkboxList(
						[
							'1' => Yii::t("app", "I want to be a pet sitter"),
							'2' => Yii::t("app", "I am a pet owner"),
							'3' => Yii::t("app", "I need a pet sitter")
						]
					)->label('Tell us about yourself:');  */
					?>
					
					<button type="submit" class="btn btn-primary course-continue">Continue</button>
					</div>
				 <?php ActiveForm::end(); ?>
					</div>	
			 <?php } ?>
			
		</div>
     </div>
    </div>
</div>
<?php if(isset(Yii::$app->user->identity) && Yii::$app->user->identity){ ?>
				
<?php echo $this->render("forms/password",['modelpassword'=>$modelpassword,'model'=>$model]); ?>
<?php echo $this->render('../wallet/dir-checkout-form',["product"=>$product]); ?>

<?php } ?>	