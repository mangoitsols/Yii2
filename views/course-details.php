<?php

use yii\web\View;
/**
 * @var $paymentstatus - Whether there has been a payment failure
 * @var $bookingCancelForm BookingCancelForm HTML form for booking cancels
 * @var $model Booking The booking object that this view represents
 * @var $message string
 * @var $error string A failure messages from paypal
 */


$this->title = 'Course Details';

$this->params ['layout'] = 'full';

?>
<div class="container content contentsbox">
    <div class="row">
		<section class="success_section">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="success_box">
							<div class="request_id_sec">
								<!--div class="request_id">Use 100% Coupon Code: <span>VIPSITTER</span></div-->
								<div class="request_btns">
									<a href="https://www.openlearning.com/courses/pet-sitter-course/HomePage/" target="_blank" class="btn primary">Go to Pet Sitting Course</a>
									
								</div>
								<p class="noti-text-note">Clicking on this link will take you to our PetCloud Accredited Training, please register with the email address you used here.  For any help, email <a href="emailto:service@petcloud.com.au">service@petcloud.com.au</a>. Happy Learning</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
</div>
<style>
/****************/
body #pageContent p.noti-text-note {
    margin-top: 10px;
    font-weight: 600;
    font-size: 18px !important;
    color: green;
}
.success_box {
    max-width: 800px;
    margin: 0 auto;
    background: #fff;
    padding: 40px 0;
}

.success_section {
    text-align: center;
}
.success_section .success_box .check_icon i {
    font-size: 150px;
    color: #5AB854;
}
.success_section .success_box .success_mseg h3 {
    font-size: 32px;
    font-weight: 600;
    color: #666;
}
.success_section .success_box .success_mseg p {
    font-size: 20px;
    color: #666;
    font-weight: 600;
}
.success_section .success_box .success_mseg {
    border-bottom: 1px solid #eaeaea;
   
    padding-bottom: 20px;
}
.success_section .success_box .request_id_sec {
       border-bottom: 1px solid #eaeaea;
    padding: 30px 0px;
   
    padding-bottom: 30px;
}
.success_section .success_box .request_id_sec .request_id {
    margin-bottom: 20px;
    font-size: 16px;
    font-weight: 600;
    color: #9e9e9e;
}
.success_section .success_box .request_id_sec .request_id span {
    color: #53bfbe;
}
.success_section .success_box .request_id_sec .request_btns a {
	margin: 0px 8px;
    font-weight: 500;
    font-size: 25px;
}
}
 @media screen and (max-width:575px){
.success_section .success_box .check_icon i {
  font-size: 140px;
 }
 .success_section .success_box .success_mseg h3 {
font-size: 24px;
 }
   .success_section .success_box .success_mseg p {
font-size: 17px;
}
.success_section .success_box .request_id_sec .request_id{
font-size: 15px;
}
.success_section .success_box .request_id_sec .request_btns a {
 margin: 0px 4px;
 font-size: 15px;
}
 }
</style>