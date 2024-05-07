<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

    /* @var $this yii\web\View */
	$this->title = 'Best Dog Sitter near me';
	$this->params['breadcrumbs'][] = $this->title;
	$this->registerMetaTag(['name' => 'description', 'content' => ""]);
	Yii::$app->params['metaKeywords'] ="";
	$this->params['submenu'] = Yii::$app->params['servicesSubMenu'];
	$postJobLink = (!empty(Yii::$app->user->identity) ? Yii::$app->getUrlManager()->getBaseUrl() . "post-a-job" :  Yii::$app->getUrlManager()->getBaseUrl() . "guest/post-a-job");
	
	
?>



<div class="banner-image petsit_banner_main app_store_icons" id="banner-image" style="background-image: url(/img/pages/best-sitter/Dog-Sitting-Banner.png)">
    <div class="banner-background-overlay"></div>
    <div class="container">
        <div class="row serviceTypeSearchFormRow">			
            <div class="col-xs-12 col-lg-12 petsit_banner">
                <h1>Best Dog Sitter near me</h1>
                <p>More and more Dog Owners, like you, prefer PetCloud’s home-based Dog Sitters as an alternative to kennel boarding facilities.</p>
                
				<div class="serviceTypeSearchForm petsit_form slideDown">


                    <?php
                    $form = ActiveForm::begin([
                                'action' => ['/dog-sitters'],
                                'method' => 'post',
                                'options' => [
                                    'id' => "serviceTypeSearchForm",
                                    'class' => "search-form container"
                                ]
                    ]);
                    //###PASS THE HIDDEN SearchForm[serviceTypeId] FOR DESIRED SERVICE TYPE SO SEARCH FORM REDIRECTS ACCORDINGLY###
                    ?>
                    
                        <input type="hidden" value="20" class="form-control" name="SearchForm[serviceTypeId]">

                        <input type="hidden" id="serviceTypeSearchForm-lat" class="form-control" name="SearchForm[lat]">

                        <input type="hidden" id="serviceTypeSearchForm-lng" class="form-control" name="SearchForm[lng]">

                        <input type="hidden" id="serviceTypeSearchForm-suburb" class="form-control" name="SearchForm[suburb]">

                        <input type="hidden" id="serviceTypeSearchForm-state" class="form-control" name="SearchForm[state]">


                        <input type="hidden" name="current-location" id="serviceTypeSearchForm-current-location" value="" />
                        <input type="hidden" name="current-location-label" id="serviceTypeSearchForm-current-location-label" value="" />

                        <input type="text" placeholder="Enter Your Location" class="location pac-target-input petsitter_loc" id="locationSerivceTypeSearchForm" onkeypress="handleEnterKeyServiceTypeSearchForm(event)" name="location" autocomplete="off" />

                        <?= Html::button('Search', ['type' => "submit", 'class' => "button search primary pink_button", 'name' => "btn_search", 'id' => "serviceTypeSearchBtn"]) ?>

                    <?php ActiveForm::end(); ?>


                </div>
				
                <a href="<?= $postJobLink; ?>" class="petsit_link">Or post a job and let our sitters come to you ...</a>
				<div class="brand-logo banner_logo">
					   <a data-toggle="tooltip" class="app_store logo_inner" href="https://apps.apple.com/au/app/petcloud-pet-sitters-walkers/id1539909889?platform=iphone" title="Download IOS App">
						<img data-original="https://cdn.petcloud.com.au/img/homepage/app-store-apple.png" src="https://cdn.petcloud.com.au/img/homepage/app-store-apple.png" class="rspca-logo lazy-load" alt="RSPCA Group Logo" style="display: inline;">
						</a>
						<a data-toggle="tooltip"  class="google_play logo_inner" href="https://play.google.com/store/apps/details?id=com.petcloud.petcloud" title="Download Android App">
							<img data-original="https://cdn.petcloud.com.au/img/homepage/google-play-badge.png" src="https://cdn.petcloud.com.au/img/homepage/google-play-badge.png" class="rspca-logo lazy-load" alt="RSPCA Group Logo" style="display: inline;">
						</a>
				</div>
            </div>
        </div>
    </div>
</div>


<div class="imm_top_rev desk_slider_content sitter_page petSitters">
    <div class="wk_top_row">
        <div class="wk_top_colm">
            <div class="wk_rev_box">
                <div>
                    <img src="/img/guest/smile.png" alt="Certified Vet Nurse Badge" class="img-responsive lazy-load">
                </div>
                <div>
                    <p>Sitter Compatability Guarantee</p>
                </div>
            </div>
        </div>
        <div class="wk_top_colm">
            <div class="wk_rev_box">
                <div>
                    <img src="/img/guest/insurance.png" alt="Insured" class="img-responsive lazy-load">
                </div>
                <div>
                    <p>All Sitters are Police Checked & Insured</p>
                </div>
            </div>
        </div>
        <div class="wk_top_colm">
            <div class="wk_rev_box">
                <div>
                    <img src="/img/guest/headphone.png" alt="Customer Care icon" class="img-responsive lazy-load">
                </div>
                <div>
                    <p>Customer Support by RSCPA QLD</p>
                </div>
            </div>
        </div>
        <div class="wk_top_colm">
            <div class="wk_rev_box">
                <div>
                    <img src="/img/guest/dog-frame.png" alt="Daily Photo Updates" class="img-responsive lazy-load">
                </div>
                <div>
                    <p>Daily Photo Updates on Wellness & Activity</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container main_sitting_page">      
    <div class="row">            
        <div class="col-md-12">                  
            <div class="sitter_new_content new_layout_sitter"> 
                <p class="heading_sitter"><strong>When you book a Dog Sitter through PetCloud the benefits are:</strong></p>
				<div class="listing_points">
                    <ul>
                        <li>Meet in person before your card is charged</li>
                        <li>Liability Insurance up to $10M covering Vet treatment for illness + injuries</li>
                        <li>National Customer Support by RSPCA Qld on shore, in Australia.</li>
                        <li>Compatibility Guarantee – Find a Great Match or we'll help you find better or happily refund you.</li>
                        <li>Daily photo updates on Wellness & Activity sent by the sitter to you</li>                         
                    </ul>   
                </div>
				<p>If you'd like to connect with a reviewed and verified Dog sitter near you, PetCloud’s unique Dog Jobs Board is the fastest way to connect with a local sitter. All you do is Post a Job this will send out an alert in a 25km radius and available Sitters will apply.</p>
				
                <p><a class="banner_inner_btn" href="<?= $postJobLink ; ?>">Post a Job</a></p>
				<h3><strong>You can also do a location based search by typing your suburb into the search bar to filter for listing of home-based Dog sitters near you.</strong></h3>
				
				<div class="listing_points">
                    <ul>
                        <li>What is a Dog Sitter?</li>
                        <li>What does a Dog Sitter do?</li>
                        <li>What Verifications should a Professional Dog Sitter have?</li>
                        <li>What qualifications does a Professional Dog Sitter have?</li>
                        <li>How can you find a reliable Dog Sitter?</li>
                        <li>What is the difference between a Dog sitter and a Dog Hotel?</li>
                        <li>What makes a great Dog Sitter?</li>
                        <li>How do I pick the right Dog sitter for my Dog?</li>
                        <li>Will I be able to find a Dog sitter in near me?</li>
                        <li>How much should I pay for a Dog sitter?</li>
                        <li>What is a Dog Resort?</li>
                        <li>What is dog boarding?</li>
                    </ul>
                </div>
                                     
                <p class="heading_sitter"><strong>What is a Dog Sitter?</strong></p>
                <p>Dog Sitting also known as Dog Minding which is a service which involves taking care of another person's Dog for a given time frame in the Dog Sitter's own home. </p>
				
				<p class="heading_sitter"><strong>What makes PetCloud different?</strong></p>
                <p>Thanks to the input and guidance of RSPCA Senior Vets, Foster Carers, Animal Inspectors, and Dog Trainers, PetCloud has been helping Dog Sitters to lead the industry in providing a safe standard of holiday care.</p>
				
				<p class="heading_sitter"><strong>When should you book care in a Dog Sitter’s home?</strong></p>
                <div class="care_three_sec row">
                    <div class="col-md-4 col-sm-12 text-center">
                        <div class="care_heading">When you want to book care locally or at holiday destination</div>
                        <div class="care_img_sec">  
							<img src="../img/pages/best-sitter/best_sitter_a.png" alt=" "class="img-responsive care_img"/>          
						</div>      
                        <div class="care_content">                                          
                            <p><font color="#34bb30">✔</font>Great for when you want to do a road trip with your dog and aren’t staying at dog friendly accommodation.</p>
                        </div>                
                    </div>
                              
                    <div class="col-md-4 col-sm-12 text-center">
                        <div class="care_heading">When you want company for your Dogs in a loving home environment</div>
                        <div class="care_img_sec">              
							<img src="../img/pages/best-sitter/best_sitter_b.png" alt=" "class="img-responsive care_img"/>        
						</div>      
                        <div class="care_content">
                            <p><font color="#34bb30">✔</font>Great for cats if the Sitter has an apartment or cat enclosure.</p>
                        </div>
                    </div>
                              
                    <div class="col-md-4 col-sm-12 text-center">
                        <div class="care_heading">When you don’t have a spare Guest room or when you have only 1-2 Dogs.</div>
                        <div class="care_img_sec">
							<img src="../img/pages/best-sitter/best_sitter_c.png" alt=" "class="img-responsive care_img"/>            
						</div>                                    
                        <div class="care_content">                                          
                            <p><font color="#34bb30">✔</font>Great for small to medium domestic Dogs.</p>                                        
                        </div>
                    </div>
                </div>
                                        
                <p class="heading_sitter"><strong>What does a Professional Dog Sitter do?</strong></p>
				<p>Professional Dog Sitters are responsible for all basic animal care while their clients are on holidays or travelling for work.</p>
				
				<p><strong>They will also:</strong></p>
				<div class="listing_points">
                    <ul>
                        <li>Supervise domestic Dogs ensuring they are safe and happy</li>
                        <li>Give daily nose to tail body checks for lumps, scrapes, ticks, and bumps</li>
                        <li>Give first aid attention to hot spots or scrapes</li>
                        <li>Do daily feeding, putting out fresh water in cleaned bowls every morning and evening. Owners provide all food.</li>
                        <li>Brushing and washing Dogs</li>
                        <li>Transporting Dogs to Vet or Grooming Appointments</li>
                        <li>Administering medicine or parasite control provided by the Owner</li>
                        <li>Taking dogs on walks, and providing exercise through play</li>
                        <li>Cleaning kitty litter boxes, puppy pads,or picking up stools in the yard and placing in the wheelie bin</li>
                        <li>Providing a daily photo update to the Owner with a small wellness & activity summary.</li>
                        <li>Notifying owners and taking Dogs to the vet if they should become sick or suffer an injury while under their supervision</li>
                    </ul>
                </div>
				
				<p class="heading_sitter"><strong>PetCloud’s Professional Dog Sitters are Police Checked</strong></p>
				<p>On PetCloud we display Digital badges that show what verifications and qualifications Sitters have obtained.</p>
				
				<p class="heading_sitter"><strong>Professional Dog Sitters trained in Animal Care can spot warning signs if your Dog needs veterinary attention.</strong></p>
				<p>They are experienced in understanding what is normal behaviour for Dogs versus behaviour such as;</p>
				<div class="listing_points">
                    <ul>
                        <li>Odd eating habits.</li>
                        <li>Excessive thirst.</li>
                        <li>Rough or dry coat.</li>
                        <li>Lethargy.</li>
                        <li>Vomiting.</li>
                        <li>Unusual stool.</li>
                        <li>Sudden weight loss.</li>
                        <li>Cloudy or red eyes.</li>
                        <li>Scooting or dragging rear</li>
                        <li>Emergency symptoms</li>
                    </ul>
                </div>
				
				<p class="heading_sitter"><strong>Professional Dog Sitters will always have a Meet & Greet in advance</strong></p>
				<p>Having an inspection at the Dog Sitters home in advance of the stay allows:</p>
				<div class="listing_points">
                    <ul>
                        <li>Dog Sitters and Owners to take joint responsibility to ensure the property is escape-proof and hazard-free and suitable for the size and type of Dog, and if not, discuss whether a solution exists to resolve if possible.</li>
                        <li>Both Sitter and Owner to observe interactions to try and predict whether all Dogs, Children, and Sitters will likely be compatible. </li>
                    </ul>
                </div>
					
				<p class="heading_sitter"><strong>Professional Dog Sitters are Insured</strong></p>
				<p>When you book through PetCloud every booking is covered with $10M public liability insurance. If a Dog swallows an object or suffers injury and requires surgery, the Vet bill can amount to as high as $16,000. By booking through PetCloud, you can feel reassured that our insurance will cover liability claims.</p>
				
				<p class="heading_sitter"><strong>How do I find a great Dog Sitter?</strong></p>
				<div class="doggy_circle_sec">
                    <div class="cirle_main first_circle1">
                        <div class="aquaNumberCircle"><p>1</p></div>
                        <div class="text-center circle_content">
							<strong>Find a Dog Sitter  near you</strong>
                            <p>Search for Dog Sitters in your area, read the reviews and select the best sitter for you.</p>
                        </div>
                    </div>  
                    <div class="cirle_main sec_circle1">
                       <div class="aquaNumberCircle"><p>2</p></div>
                        <div class="text-center circle_content">
							<strong>Meet and Greet</strong>              
                            <p>Meet your chosen Dog Sitter at the proposed location of care before the stay.</p>
                        </div>    
                    </div>    
                    <div class="cirle_main thr_circle1">
                        <div class="aquaNumberCircle"><p>3</p></div>
                        <div class="text-center circle_content">
							<strong>Finalise Your Booking</strong>              
                            <p>Seamlessly book and securely pay using the PetCloud digital wallet.</p> 
                        </div>
                    </div> 
                    <div class="cirle_main fur_circle1">
                        <div class="aquaNumberCircle"><p>4</p></div>
                        <div class="text-center circle_content">
							<strong>Pack, Travel and Relax</strong>              
                            <p>Pack your bags, drop off your Dog and relax knowing they are in the best care.</p>
                        </div>
                    </div>
                </div>
				
				<p class="heading_sitter"><strong>What types of Dogs do PetCloud Dog Sitters look after?</strong></p>
				<p>Domestic animals such as cats and dogs, pocket Dogs/ rodents such as guinea pigs, rats, mice, rabbits, reptiles such as snakes, frill neck lizards, turtles, hobby farm animals such as alpacas, horses, pigs, chickens, ponies, and goats.</p>
				<p>We don’t look after large scale commercial farms – commercial Farm Hands are required for this.</p>
				
				<p class="heading_sitter"><strong>What sorts of breeds of dogs do PetCloud Dog Sitters look after?</strong></p>
				<p>All breeds of domestic Dogs mentioned, except dangerous dog breeds mentioned.</p>
				
				<p class="heading_sitter"><strong>How do I identify a great Dog Sitter?</strong></p>
				<p><strong>Great Dog Sitters are:</strong></p>
                <div class="listing_points_count">
                    <ol>
                        <li>Insured with public liability insurance,</li>
                        <li>Have passed a Police Check</li>
                        <li>Have a high number of repeat clients and</li>
                        <li>Five star reviews, and</li>                        
                        <li>Prompt in reply and clear communication with you</li>
						<li>Have done a Dog Care Course, such as our industry leading RSPCA Qld Dog Sitting course - as this course trains sitters in animal care to the standard that the RSPCA expects</li>
						<li>Requests a Meet & Greet with you at the proposed location of care in advance of the Dog stay.</li>
                    </ol>   
                </div>
				<p>Also take note of great traits that a Dog Sitter should have.</p>
                                      
                <p class="heading_sitter"><strong>What Verifications do Dog Sitters have?</strong></p>
				<p>Each PetCloud Dog Sitter has clear <a href="https://petcloud.com.au/verification-badges">digital verification badges</a> that display the police verifications they have attained.</p>
				                        
                <p class="heading_sitter"><strong>What Training do Dog Sitters have?</strong></p>
				<p>Each Sitter must sit the <a href="https://www.petcloud.com.au/petsittercourse">online pet care training course</a> created by RSPCA Vets. Once they have completed the course, their profile will display an accredited badge.</p>
                
				<p class="heading_sitter"><strong>Professional Dog Sitters are trained in Animal Welfare standards</strong></p>                        
                <p>Professional Dog Sitters are trained by a recognised industry Dog care course.  They are experienced in working with all types of Dog types, breeds, and temperaments and will know how to tailor your Dog’s care based on their unique likes, triggers, fears, and habits.</p>                        
                <p>PetCloud's Dog Sitter's and Dog Walkers uphold the Animal Welfare 5 Freedoms that are internationally accepted standards of Dog care that affirm every living being's right to humane treatment which are: </p>
                        
                <div class="listing_points">
                    <ul>
                        <li>Freedom from hunger and thirst.</li>
                        <li>Freedom from discomfort.</li>
                        <li>Freedom from pain, injury and disease.</li>
                        <li>Freedom to express normal behaviours.</li>
                        <li>Freedom from fear and distress.</li>
                    </ul>
                </div>
                        
                <p class="heading_sitter"><strong>What interview questions do I ask a Dog Sitter?</strong></p>                        
                <p>PetCloud will provide you with a set of interview questions and checks when you join. It’s free to join.</p>                        
                <div class="guide_img text-center" style="margin-bottom: 20px;">    
					<img style="margin: 0 auto !important;" src="../img/pages/doggy-day-care/Guide_img.png" alt="" class="img-responsive">
				</div>
                        
                <p class="heading_sitter"><strong>How does Dog sitting work?</strong></p>
                <p>Both Dog Owners and Dog Sitters join the PetCloud website free. Dog Owners can Post a Job and this will send out a job alert in a 25km radius and available sitters will apply. You review their profiles, and then click to request a Meet & Greet with the Sitter you select.</p>
                        
                <p class="heading_sitter"><strong>When do I pay for my Booking and how?</strong></p>
                <p>After the Meet & Greet, but before the stay begins you will be shown a link to pay via PetCloud. The Sitter will only receive payment at the end of the stay by PetCloud. Never pay Dog Sitters directly. Always pay via the website as your Dog will be protected with insurance against big Vet Bills that may occur in the event of illness or accidental injury.</p>
                        
                <p class="heading_sitter"><strong>How much do you pay a dog sitter?</strong></p>
				<p>When you create a booking, the website will provide you with an upfront estimate. </p>
				<p>As a rough guide, Dog Sitters charge $20-$40 a day on average, depending on the services involved and depending on whether they are in metro, or regional areas. </p>
				<p>The average cost of a 20-minute home visit is $40, while overnight Dog-sitting costs $20-$55. Discounts may be given if there are multiple Dogs, and longer stays. </p>
				<p>Vet Nurse Dog sitters will often charge more for 24-hour Supervision, additional Dogs, and bookings over public holidays when demand is high from many Dog Owners going away on holiday.</p>
				
				
				
				<p class="heading_sitter"><strong>Every booking makes an impact</strong></p>
				<p>Read more about the <a href="https://www.petcloud.com.au/social-impact">impact you make</a> when you book Dog Sitting for your Dog through PetCloud</p>
				
				<p class="heading_sitter"><strong>Why choose home-based Dog sitters?</strong></p>
				<p>PetCloud Dog Sitters keep Dogs safe and happy in a home environment. That’s why all our members are home-based Dog Sitters.  Vets agree home is the one place all Dogs feel safe and happy, you can travel with true peace of mind.</p>
                <p>PetCloud has different types of services that our home-based Dog Sitters offer:</p>
				<div class="listing_points_count">
                    <ol>
                        <li>Dog Sitters who offer overnight care for your Dog in their home,</li>
                        <li><a href="https://www.petcloud.com.au/house-sitting">House Sitters</a> to come and stay overnight in a Guest bedroom at your home for a period of time if you own multiple Dogs or large Dogs, </li>
                        <li>Dog Sitters who do Home Visits to your home where a Dog Sitter will drive over & call in once or twice a day for 20 minutes to feed and top up water in your Dogs bowls.</li>
                    </ol>   
                </div>
				
				<p class="heading_sitter"><strong>In what locations does PetCloud have Dog Sitters?</strong></p>
				<p>Whether you are in Brisbane, Gold Coast, Byron Bay, Sydney, Newcastle, Canberra, Melbourne, Hobart, Adelaide, Perth, Darwin or even Alice Springs – PetCloud has Dog sitters nationally, right across Australia.</p>
				        
                <p class="heading_sitter"><strong>Puppy Dog Sitters</strong></p>
				<p>PetCloud has Puppy Dog Sitters who will have your puppy stay at their loving home. Use the Advanced Search filter to specify your puppy’s needs.</p>
                                
                <p class="heading_sitter"><strong>Senior Dog Sitters</strong></p>
                <p>Use PetCloud’s Advanced Search Filters to find Sitters who have homes without steps and ramps for senior pets. Providing high quality washable Pet Nappies if your pet is incontinent will make the stay much easier.</p>
				
				<p class="heading_sitter"><strong>Big Dog Sitters</strong></p>
                <p>PetCloud has strong big dog sitters with large fenced backyards.  We also have House Sitters who can come to stay at your home with your big dog.</p>
				
				<p class="heading_sitter"><strong>Special Needs Dog Care</strong></p>
                <p>PetCloud has an advanced search filter on the Search Results screen where Dog Owners can filter to find Vet Nurse Dog Sitters who have had their Vet Nurse Qualifications verified and have been allocated a Vet Nurse digital badge.</p>
				<p>Dog Owners love our local Dog sitters whether it’s because it’s easier to meet in person or they want someone who already knows the best dog walks, many people are looking for local Dog sitters in particular.</p>
				
				<p><strong>Dog sitting stories</strong></p>
				<p>Members across Australia tell us their lives have changed thanks to Dog sitting. From local Dog sitters who tell us it’s filled a gap in their life left by the loss of their own Dog, to dedicated Dog Owners who can finally take a well-deserved break, there are so many touching stories.</p>
				<p>Read about Petra’s story, who joined PetCloud to find special Dog care for Wheelie Wilbur the dachshund dog with Stage 5 IVDD. Thanks to PetCloud Sitter, Bronte, Petra was able to spend a holiday with her Partner for the first time in five years!</p>
				<p>Want to know more about finding a Dog sitter and creating your own story?</p>
				<p>Post a Job and available Dog Sitters will apply</p>
				
				<p><strong>Read More </strong><br><a href="https://www.petcloud.com.au/blog/The-Golden-Rules-for-Pet-Owners-when-using-a-Pet-Sitter">The Golden Rules for Dog Owners when using a Dog Sitter</a></p>
				
				<p><strong>Your Dogs will love it…</strong></p>
				<p>Staying in a familiar home-based environment means Dogs will be surrounded by sights and smells of a family home. Their new human friend be sure to cuddle and care for them, just like you do, as well as maintain their routine.</p>
				<p><strong>You will love it…<strong></p>
				<p>Whether its travelling for a work trip or for a holiday, you can travel with peace of mind knowing your Dog is in the safe hands of a professional Dog sitter and animal lover. It’s local, safe, convenient Dog care you can trust, without having to bargain with family, friends, or neighbours for help.</p>
				
				<p><strong>Your booking includes:</strong></p>
                <div class="listing_points">
                    <ul>
                        <li>Dog care from police checked and insured professional dog sitters</li>
                        <li>A website that allows you to connect with Dog sitters, safely and securely</li>
                        <li>Our Insurance Backed Guarantee that covers bookings for up to $10 million</li>
                        <li>Vet Advice Line for you and your sitter to call anytime, anywhere, charges apply</li>
                        <li>Support from RSPCA Qld’s National Call Centre</li>
                    </ul>
					
                </div>


					<div class="faq">
						<p class="heading_sitter"><strong>Frequently Asked Questions</strong></p>
                     <br/>          
            
            
            <div class="panel-group" id="faqAccordion">
                
                <div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
                    <div class="panel-heading">
                        <h4 class="panel-title" itemprop="name" >
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapseOne">
                                <span class="glyphicon glyphicon-minus-sign"></span>
                                What does a pet sitter do?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div class="panel-body" itemprop="text" >
                            Pet sitters care for a pet when the owner can't be there. Whether you have a work commitment, a vacation or anything else, a pet sitter will provide care for your pet making sure they are fed, have fresh water, have the opportunity to go to the bathroom and get some exercise. Pet sitters can look after your pet in the owners home, their own home or pay daily visits to check in on a pet.
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
                    <div class="panel-heading">
                        <h4 class="panel-title" itemprop="name" >
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapseTwo">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                How much does the average pet sitter charge?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div class="panel-body" itemprop="text" >
                            All of our pet sitters set their own prices which you will find on their listing, however the average price is typically $25 a day on average and around or $40 for overnight stays.
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
                    <div class="panel-heading">
                        <h4 class="panel-title" itemprop="name" >
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapseThree">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                Why choose a pet sitter over other types of dog boarding?
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div class="panel-body" itemprop="text" >
                            There are many benefits for choosing a pet sitter over things like kennels, mong other things, these include reduced stress and a reduced risk of picking up an infectious disease or even kennel cough.
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
                    <div class="panel-heading">
                        <h4 class="panel-title" itemprop="name" >
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse4">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                What sorts of pets do PetCloud pet sitters look after?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div class="panel-body" itemprop="text" >
                            Domestic animals such as cats and dogs, pocket pets/ rodents such as guinea pigs, rats, mice, rabbits, reptiles such as snakes, frill neck lizards, turtles, hobby farm animals such as alpacas, horses, pigs, chickens, ponies, and goats.
                            <br/>We don't look after large scale commercial farms – commercial Farm Hands are required for this.
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
                    <div class="panel-heading">
                        <h4 class="panel-title" itemprop="name" >
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse5">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                What sorts of breeds of pets do PetCloud pet sitters look after?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div class="panel-body" itemprop="text" >
                            All breeds of domestic pets mentioned, except dangerous dog breeds mentioned.
                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
                    <div class="panel-heading">
                        <h4 class="panel-title" itemprop="name" >
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse6">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                What training do pet sitters have?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div class="panel-body" itemprop="text" >
                            Each Sitter must sit the online pet care training course created by RSPCA Vets. Once they have completed the course, their profile will display an accredited badge.

                            Professional Pet Sitters are trained by a recognised industry pet care course.  They are experienced in working with all types of pet types, breeds, and temperaments and will know how to tailor your pet’s care based on their unique likes, triggers, fears, and habits.  
                            <br/>
                            PetCloud's Pet Sitter's and Dog Walkers uphold the Animal Welfare 5 Freedoms that are internationally accepted standards of pet care that affirm every living being's right to humane treatment which are: 

                            <ul>
                                <li>
                                    Freedom from hunger and thirst.
                                </li>
                                <li>
                                    Freedom from discomfort.
                                </li>
                                <li>
                                    Freedom from pain, injury and disease.
                                </li>
                                <li>
                                    Freedom to express normal behaviours.
                                </li>
                                <li>
                                    Freedom from fear and distress.
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                
                <div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
                    <div class="panel-heading">
                        <h4 class="panel-title" itemprop="name" >
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse8">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                When do I pay for my booking and how?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse8" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div class="panel-body" itemprop="text" >
                            After the Meet & Greet, but before the stay begins you will be shown a link to pay via PetCloud. The Sitter will only receive payment at the end of the stay by PetCloud. Never pay Pet Sitters directly. Always pay via the website as your pet will be protected with insurance against big Vet Bills that may occur in the event of illness or accidental injury.
                        </div>
                    </div>
                </div>

                <div class="panel panel-default"  itemscope itemprop="mainEntity" itemtype="https://schema.org/Question" >
                    <div class="panel-heading">
                        <h4 class="panel-title" itemprop="name" >
                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#faqAccordion" href="#collapse10">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                                Why choose home-based pet sitters?
                            </a>
                        </h4>
                    </div>
                    <div id="collapse10" class="panel-collapse collapse" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer" >
                        <div class="panel-body" itemprop="text" >
                            PetCloud Pet Sitters keep pets safe and happy in a home environment. That's why all our members are home-based pet sitters.  And with vets agreeing home is the one place all pets feel safe and happy, you can travel with true peace of mind.
                            <br/>
                            PetCloud has different types of services that our home-based Pet Sitters offer:                            
                            <ul>
                                <li>
                                    Pet Sitters who offer overnight care for your pet in their home,
                                </li>
                                <li>
                                    House Sitters to come and stay overnight in a Guest bedroom at your home for a period of time if you own multiple pets or large pets, 
                                </li>
                                <li>
                                    Pet Sitters who do Home Visits to your home where a Pet Sitter will drive over & call in once or twice a day for 20 minutes to feed and top up water in your pets bowls.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                                
            </div>
						
					</div>
			</div>          
            </div>
        </div>
          
    </div>
</div>
<script>
    //$(document).ready(function(){$(".imm_slider_widget").slick({dots:!0,infinite:!1,arrows:!1,speed:300,autoplay:!0,slidesToShow:2,slidesToScroll:2,responsive:[{breakpoint:200,settings:{slidesToShow:1,slidesToScroll:1,infinite:!0,arrows:!0}}]})});
    
    
</script>
 