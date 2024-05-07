<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Pet Sitting - List your services &amp; get noticed by Pet Owners across Australia' . ($location != '' ? " in $location" : '');
//$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'description', 'content' => "Want to earn money providing pet sitting & minding services with flexible working hours? Join PetCloud now, Australia's most trusted pet network."]);
$this->params['submenu'] = Yii::$app->params['becomePetSittermenu'];

$imageUrl =  str_replace('http:','https:',Yii::getAlias('@imageUrl'));
$cdnUrl = Yii::getAlias('@cdnUrl');
?>
<div class="pet_main_pages">
<section class="profl_top_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="prof_app_text">
                    <h1>Have fun doing something you love with PetCloud!</h1>
                    <p>PetCloud gives Pet Sitters the freedom 
                        to build a recurring client base, and 
                        live the flexible life you deserve.
                    </p>
                    <div class="brand-logo banner_logo">
                        <a data-toggle="tooltip" class="app_store logo_inner" href="https://apps.apple.com/au/app/petcloud-pet-sitters-walkers/id1539909889?platform=iphone" title="Download IOS App">
							<img data-original="https://cdn.petcloud.com.au/img/homepage/app-store-apple.png" src="https://cdn.petcloud.com.au/img/homepage/app-store-apple.png" class="rspca-logo lazy-load" alt="RSPCA Group Logo" style="display: inline;">
                        </a>
                        <a data-toggle="tooltip" class="google_play logo_inner" href="https://play.google.com/store/apps/details?id=com.petcloud.petcloud" title="Download Android App">
							<img data-original="https://cdn.petcloud.com.au/img/homepage/google-play-badge.png" src="https://cdn.petcloud.com.au/img/homepage/google-play-badge.png" class="rspca-logo lazy-load" alt="RSPCA Group Logo" style="display: inline;">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6">
                <div class="prof_app_img">
                    <img src="/img/pages/become-a-pet-sitter/profile-app.png" class="img-responsive"/>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="features_app_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="feature_content">
                    <h2 class="text-center">Features you'll love.<br/>Saving you time & making you money.</h2>
                    <div class="feature_wrp_box">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/1.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Automatic SMS Reminders (Reduce No Shows)</h3>
                                        <p>We'll send Automatic Meet & Greet & Booking SMS & Email Reminders & Review Requests at the end of a stay.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/12.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Automatic Insurance Cover</h3>
                                        <p>Protection for your own wallet in the event of negligence and large Vet Bills if surgery is required.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/19.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Track your Earnings</h3>
                                        <p>A single screen of all payments where you can check each payment status (finalised or pending), payment gateway (PayPal, Stripe).</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/2.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Automatic Email Reminders</h3>
                                        <p>Email reminders will keep Pet Owners prompt to appointments. These emails will automatically be sent out for you.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/14.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Pet Jobs Board</h3>
                                        <p>Access to view and apply to our National Pet Jobs Board. Receive push notifications when jobs come up in your area.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/22.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Unlimited clients</h3>
                                        <p>There are no limits on the number of jobs you can apply for, or the number of clients you can book with.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/3.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Live Chat with Clients</h3>
                                        <p>Be in instant touch with your customers - see when they were last online or whether they are online right now. Share photo updates.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/15.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Your home address kept private</h3>
                                        <p>Your listing will appear in our Directory for Pet Owners to contact, enabling you to screen who you want to invite to meet you.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/24.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Digital Verification Badges</h3>
                                        <p>Build trust quickly when your listing has online digital verification badges</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/4.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Get Paid for Promotion</h3>
                                        <p>When you <a href="/refer-a-friend">refer a Pet Owner</a> who books for the 1st time through PetCloud, they'll get $10 credit, & you'll get 8% of the booking - in cash!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/16.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Digital Visit Report Card</h3>
                                        <p>Quickly provide a summary to your clients daily with a digital report card for your client's peace of mind.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/12.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Packages of Services</h3>
                                        <p>Encourage your customers to buy more by bundling multiple services in a package of appointments. You can set the price for the whole package so your customers can have a discount when purchasing the package of services.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/6.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Booking Modification / Scheduling</h3>
                                        <p>You or your clients can easily request booking modfications.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/18.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Offer Recurring Appointments</h3>
                                        <p>Your customers will become returning customers by letting them schedule recurring appointments. Daily, weekly, monthly or yearly.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/27.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Accredited Pet Care Course</h3>
                                        <p>Become a highly sought after Pet Sitter in your area. Get Confident with the standard of Pet Care the RSPCA promotes and understand local laws. Learn Pet Sitter Marketing Secrets to build yiour client base.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/8.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Calendar / Availability Management</h3>
                                        <p>Easily block out the dates youre unavailable.  Have a break when you need to.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/19.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Make an impact</h3>
                                        <p>Pet Owners can donate to the RSPCA through PetCloud when they book. Now that's pet sitting with purpose!</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/18.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Discount coupons for bookings</h3>
                                        <p>We'll give you your own promo code to give to new Pet Owners or to display on business cards and flyers</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/9.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Support for Multiple Services</h3>
                                        <p>No matter how many different services do you provide, you can add all of them to PetCloud, configuring individual duration, price, and other parameters.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/21.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>We'll auto send Property Checklists</h3>
                                        <p>We will send Pet Owners an RSPCA Property Checklist so you can conduct Property Tours at Meets & Greets with better informed Pet Owners.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/21.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>No Chasing Payments</h3>
                                        <p>Stolen, Expired, or Maxxed out Credit Cards are a thing of the past with our Digital Wallet to collect payment in escrow from Pet Owners before the stay. You'll get reliable payouts after the stay.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/10.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Service Photo Galleries</h3>
                                        <p>Upload multiple pictures for service, to be shown on site’s front-end as service photo galleries/slideshows.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/23.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Mobile Apps & Website</h3>
                                        <p>You and Pet Owners can communicate with through PetCloud's easy to use Android or IOS App or website.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/24.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>A choice of refund policies.</h3>
                                        <p>You get a choice of refund policies to display on your listing.  Your time is valuable, so if you get cancelled on, we will refund the Pet Owner according to the policy you chose.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="feat_save_bx">
                                    <img src="/img/pages/become-a-pet-sitter/icons/11.svg" class="img-responsive"/>
                                    <div class="feat_txt_blk">
                                        <h3>Customer Support</h3>
                                        <p>PetCloud's Customer Support team is available to answer questions through live chat on the website, email, or phone.</p>
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

<section class="testimonials_section">
    <div class="container main_sitting_page">
        <div class="row">
            <div class="col-md-12">
                <div class="sitter_new_content new_layout_sitter">
                    <div class="profl_testimonial_sec">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="heading_sitter"><strong>Testimonials</strong></p>
                            </div>
                        </div>
                        <div class="row testimonials_row">
                            <div class="col-md-3 col-sm-4">
                                <div class="testi_img">
                                    <img src="/img/pages/become-a-pet-sitter/testimonial-pick.png" class="img-responsive"/>
                                </div>
                            </div>
                            <div class="col-md-9  col-sm-8">
                                <div class="profl_testi_contet">
                                    <p>PetCloud enables me to follow my passion to work with all different animals and gave me the confidence I needed - that I was meeting the pet care standards expected of me through their online accredited pet sitting course.</p>
                                    <p>The PetCloud website reaches Pet Owners in my area - much more effectively than my own marketing efforts and it's wonderful working with a company who gives back to support the RSPCA's rescue work.</p>
                                    <p>- Cecilia, Pet Sitter in Caloundra</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>  
                </div>
            </div>
        </div>
    </div>
</section>

<section class="faq_section">
	<div class="container main_sitting_page">
        <div class="row">
            <div class="col-md-12">
				 <div class="sitter_new_content new_layout_sitter">
					<div class="faq">
						<p class="heading_sitter"><strong>Frequently Asked Questions</strong></p>
					</div>
					<div class="panel-group" id="faqAccordion">
                
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapseOne">
										<span class="glyphicon glyphicon-minus-sign"></span>
										Who are PetCloud?
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>PetCloud is an Australian, 5 year old, national company and part owned by <a href="https://www.petcloud.com.au/rspca-partnership">RSPCA Qld</a>. PetCloud’s mission is about making responsible pet care easy. We have an excellent reputation and high standard of care.</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapseTwo">
										<span class="glyphicon glyphicon-plus-sign"></span>
										What does a Pet Sitter do?
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>Pet sitters are responsible for all basic animal care while their clients are on vacation or traveling for business. Routine duties include:</p>
									<ul>
										<li>Daily Feeding, putting out fresh water every morning and evening &amp; scrubbing bowls.</li>
										<li>Brushing pets</li>
										<li>Taking dogs on walks, and providing exercise through play</li>
										<li>Cleaning litter boxes</li>
										<li>Additional services may include giving medications, vacuuming up pet hair in the house, or collecting the client's mail or newspaper</li>
										<li>Pet sitters are also responsible for notifying owners and taking pets to the vet if they should become sick or suffer an injury while under their supervision</li>
									</ul>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapseThree">
										<span class="glyphicon glyphicon-plus-sign"></span>
										Where can I get training to become a Pet Sitter?
									</a>
								</h4>
							</div>
							<div id="collapseThree" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>With the help of RSPCA Vets, PetCloud has created the most reputable <a href="https://www.petcloud.com.au/petsittercourse">Accredited Pet Sitting course</a> in Australia. We equip you with skills to be assertive, recognise potential risks, and handle situations, give you the confidence to understand the standard of care the RSPCA expects &amp; become in-demand in your area.</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse4">
										<span class="glyphicon glyphicon-plus-sign"></span>
										How much money can I make as a Pet Sitter?
									</a>
								</h4>
							</div>
							<div id="collapse4" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>The price of Pet Sitting per night can be on par with a luxury Hotel booking. How? Say for instance, you see a month long house sitting job for 2 dogs and a cat.  If you offer extras to the owner, during the meet &amp; greet, such as walking the 2 dogs x3 days a week during the booking. Your total booking price really starts to increase. For example:</p>
									<p>Core Service:<br>House Sitting for 31 nights @ $51pn = $1550.</p>
									<p>Plus Extras:<br>x2 dogs being walked 3 days per week for 4 weeks = $40 x 12 = $480</p>
									Total: $2,030 Wow!!
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse5">
										<span class="glyphicon glyphicon-plus-sign"></span>
										What are other ways to Make Money as a Pet Sitter?
									</a>
								</h4>
							</div>
							<div id="collapse5" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p><a href="https://www.petcloud.com.au/refer-a-friend">PetCloud has a Paid Referral Program</a> where you can use your unique referral link to earn money for promoting PetCloud to Pet Owners across social media, and email. Potential earnings could look like an <strong>extra $240 per month if you bring on 10 new Pet Owners who book</strong> based on an average booking price of $300.</p>
									<p><strong>You can offer Extras on your listing</strong> such as;</p>
									<ol>
										<li>Pet Supplies Pick up (Food, Toys, treats, Parasite control)</li>
										<li>Poo Patrol and deodorising patios and balconies, Cleaning Litter boxes, Fish Tank Cleaning</li>
										<li>Doggy Day Care &amp; Puppy Desensitisation Period</li>
										<li>Health check-ups, desexing, teeth descales, vaccination boosters</li>
										<li>Grooming &amp; Clipping Coats, Nail clips, Expressing Anal Glands, Cleaning ears and eyes, Washing and Brushing, Double Coat de-shed and blow out.</li>
										<li>Exercise / Dog Walks</li>
										<li>Pet Sitting, House sitting, or Home Visits</li>
										<li>Pet Concierge for Weddings</li>
										<li>Pet Taxi Trips to pre-booked Vet or Grooming Appointments.</li>
										<li>Dog Training</li>
										<li>24hr supervision</li>
									</ol>
									<p><strong>Recurring Client Bookings</strong><br>
										Recurring bookings are key to being rewarded with a higher placement in search results. We will help you build up your repeat client base.
									</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse6">
										<span class="glyphicon glyphicon-plus-sign"></span>
										Do Pet Sitters need Insurance?
									</a>
								</h4>
							</div>
							<div id="collapse6" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>Insurance is already included in every booking under PetCloud’s insurance policy and PetCloud retains a percentage when we pay you at the end of the stay. So no, you don’t need to buy additional insurance.  Insurance is important so that you or the Pet Owner isn’t hit with large Veterinary bills in the event of a pet accident during a pet stay. </p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse7">
										<span class="glyphicon glyphicon-plus-sign"></span>
										How does PetCloud Work for Pet Sitters?
									</a>
								</h4>
							</div>
							<div id="collapse7" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p><strong>Step 1. Join free</strong> through the website or by downloading the App to your phone. www.petcloud.com.au/signup</p>
									<p><strong>Step 2. Get Verified &amp; Trained</strong><br>All applicants must upload a recent National Australian Police check received in the last 12 months or apply to undergo a new check. Take our Mandatory Pet Sitting and Dog Walking Course</p>
									<p><strong>Step 3. Set up your Profile &amp; Create your own listing</strong><br>Your listing is your very own business web page on PetCloud. You can direct customers to it to read your reviews from past customers, see photos, see the services you offer, and see your prices, check your calendar of availability, and book you.</p>
									<p><strong>Step 4. Share your Custom Business Cards &amp; your PetCloud Links.</strong><br>Request these from our team. Also check out PetCloud Merchandise to look professional.</p>
									<p><strong>Step 5. View Pet Jobs on our Pet Jobs Board &amp; Respond to enquiries</strong><br>Viewing our pet jobs board or respond to private messages from Pet Owners searching their local area for Pet Care Services.</p>
								</div>
							</div>
						</div>

						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse9">
										<span class="glyphicon glyphicon-plus-sign"></span>
										How do PetCloud Pet Sitters Make an Impact?
									</a>
								</h4>
							</div>
							<div id="collapse9" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>Our Pet Sitters are an extremely important part of our community. Read about the <a href="https://www.petcloud.com.au/social-impact">social impact</a> you are helping to make.  Pet Owners are also able to donate to their chosen Animal Welfare Charity in the booking flow.</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse10">
										<span class="glyphicon glyphicon-plus-sign"></span>
										Do Pet Sitters need a Police check?
									</a>
								</h4>
							</div>
							<div id="collapse10" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>Yes</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse11">
										<span class="glyphicon glyphicon-plus-sign"></span>
										What is the difference between Pet Sitting and House Sitting and Dog Boarding?
									</a>
								</h4>
							</div>
							<div id="collapse11" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<ul>
										<li>Pet sitting means boarding the pet at the sitter's own residence.</li>
										<li>House sitting means caring for one or more pet by a Sitter staying at the pet's own residence (both day and night)</li>
										<li>Doggy day care means caring for the dog at the pet sitter's residence during the day only. The pet gets dropped off in the morning and picked up the same day.</li>
										<li>Cat Sitter means caring for the cat by boarding at the Sitter's own residence (day and night).</li>
										<li>Dog sitting means caring for the dog by boarding at the Sitter's own residence (day and night).</li>
										<li>Dog boarding means caring for the dog by boarding at the Sitter's home (both day and night).</li>
									</ul>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse12">
										<span class="glyphicon glyphicon-plus-sign"></span>
										What is the difference between house sitting, cat sitting, and dog sitting?
									</a>
								</h4>
							</div>
							<div id="collapse12" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>The location of where the care takes place.</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse13">
										<span class="glyphicon glyphicon-plus-sign"></span>
										Is there a difference between pet sitting and dog boarding?
									</a>
								</h4>
							</div>
							<div id="collapse13" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>No difference.</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse14">
										<span class="glyphicon glyphicon-plus-sign"></span>
										How old do I have to be to be a Pet Sitter?
									</a>
								</h4>
							</div>
							<div id="collapse14" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>18 years old so that in the event of an emergency, you can safely drive the Pet to an emergency Vet.</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse15">
										<span class="glyphicon glyphicon-plus-sign"></span>
										Do I get to choose when I am available?
									</a>
								</h4>
							</div>
							<div id="collapse15" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>Yes.  You are able to specify your general availability on your calendar.  But once you are booked - a booking is a commitment to honour your word.</p>
								</div>
							</div>
						</div>
						
						<div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
							<div class="panel-heading">
								<h4 class="panel-title" itemprop="name" >
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse16">
										<span class="glyphicon glyphicon-plus-sign"></span>
										Do I get to choose the types of pets I want to mind?
									</a>
								</h4>
							</div>
							<div id="collapse16" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
								<div class="panel-body" itemprop="text" >
									<p>Yes. You specify this on your listing.</p>
								</div>
							</div>
						</div>
										
					</div>
					
					<p class="heading_sitter"><strong>To get started, download the PetCloud App today! </strong></p>
					<p>Apple App Store: <a href="https://apple.co/2PifzXs">https://apple.co/2PifzXs</a> Google Play Store: <a href="https://bit.ly/3aFeK2m?fbclid=IwAR2VSHMCV-T7eEmtGLognSxDE8pTg1Ie2aujOBieEJMV24_Wnfb3Kjn6QeI">https://bit.ly/3aFeK2m</a></p>
				</div>
			</div>
		</div>
	</div>
</section>
</div>