<?php

namespace app\controllers;

use app\models\Review;
use app\models\ReviewSearch;
use app\models\Users;
use Yii;
use app\models\Team;
use app\models\Pages;
use app\models\utilities\AnalyticsHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use app\models\forms\ContactForm;
use app\models\forms\ComplaintForm;
use app\models\forms\IncidentForm;
use yii\db\Query;
use app\models\utilities\Distance;


/**
 * Class PagesController
 *
 * This is the controller for the sites external pages.
 *
 * @package app\controllers
 * @copyright Copyright (c) 2015 Petcloud PTY LTD
 * @author Charles Galvin <charles@petcloud.com.au>
 * @version 2.6.0 2.6.0
 */
class PagesController extends Controller
{
	use AnalyticsHelper;
	use Distance;

	public $layout = "page";

	public function actionIndex()
	{
		$this->layout = "base";
		return $this->render('index');
	}

	public function actionSearchkennels()
	{

		Yii::$app->response->redirect(Url::to(['/dog-kennels-near-me']), 301);
		/*  $this->view->params['page_title'] = 'Local Dog Kennels Near Me - PetCloud';
									  $this->view->params['banner_description'] = 'With local & national maps for searching, PetCloud makes it easy to find thousands of trusted Minders across the country ready to care for your pet. Simply search your Suburb and begin browsing through PetCloud Minders in your area.';
									  $this->view->params['banner_image'] = '/img/pages/about-banner.jpg';
									  return $this->render('searchKennels'); */
	}

	public function actionSearchkennelsnearme()
	{

		$this->view->params['page_title'] = 'Dog Kennels Near Me';
		$this->view->params['banner_description'] = 'Pet Owners love their dogs and it can be hard to know what to do with them while we are gone. It would be ideal if we could bring them with us, to us they’re family.';
		$this->view->params['banner_image'] = 'https://cdn.petcloud.com.au/img/pages/dog-kennels.png';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('searchKennels');
	}

	public function actionListings_script()
	{
		return $this->render('listingscript');
	}

	public function actionCrisissupportworkers()
	{


		$this->view->params['page_title'] = 'Pets of Crisis Support Workers';
		$this->view->params['banner_description'] = "PetCloud's Pet care when you can't be there";
		$this->view->params['banner_image'] = 'https://cdn.petcloud.com.au/img/pages/Pets-of-Crisis-Support-Workers.png';

		return $this->render('supportworkers');
	}

	public function actionPetsitternearme()
	{

		//        $this->view->params['page_title'] = 'Looking for a Pet Sitter near you?';
		//        $this->view->params['banner_description'] = 'PetCloud has Pet Sitters right across Australia ready to care for your pet, like one of their own. Simply post a job, and this will alert sitters in your area and available ones will apply!';
		//        $this->view->params['banner_image'] = 'https://cdn.petcloud.com.au/img/pages/pet-sitter-near-me.png';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$reviewSearch = new ReviewSearch();

		//        $this->view->params['reviews_cnt'] = $reviewSearch->searchContReviews(Yii::$app->params, 50);

		return $this->render('petSitterNearme', [
			#'review' => $this->view->params['reviews_cnt'],
		]);
	}

	public function actionOurpolicies()
	{

		//$this->view->params['page_title'] = 'Our Policies';
		//$this->view->params['banner_description'] = 'PetCloud has Pet Sitters right across Australia ready to care for your pet, like one of their own. Simply post a job, and this will alert sitters in your area and available ones will apply!';
		// $this->view->params['banner_image'] = 'https://cdn.petcloud.com.au/img/pages/pet-sitter-near-me.png';

		return $this->render('ourpolicies');
	}


	public function actionComplaintform()
	{

		$secretKey = Yii::$app->params['CaptchaSecret'];
		$captchaVarification = false;
		$model = new ComplaintForm();

		if ($model->load(Yii::$app->request->post())) {

			if ($model->createMail()) {
				Yii::$app->session->setFlash("success", Yii::t('app', "Thank you for contacting us. We will get back to you shortly"));
			} else {
				Yii::$app->session->setFlash("error", Yii::t('app', "Your message has not been sent. Please refresh and try again"));
			}

			return $this->refresh();
		} else if (!Yii::$app->user->isGuest) {
			$model->name = Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name;
			$model->email = Yii::$app->user->identity->email;
			$model->phone = (isset(Yii::$app->user->identity->mobile) && Yii::$app->user->identity->mobile != null ? Yii::$app->user->identity->mobile : '');
		}



		return $this->render('complaintform', [
			'model' => $model,
		]);
	}


	public function actionInsidentform()
	{

		$secretKey = Yii::$app->params['CaptchaSecret'];
		$captchaVarification = false;
		$model = new IncidentForm();

		if ($model->load(Yii::$app->request->post())) {

			if ($model->createMail()) {
				Yii::$app->session->setFlash("success", Yii::t('app', "Thank you for contacting us. We will get back to you shortly"));
			} else {
				Yii::$app->session->setFlash("error", Yii::t('app', "Your message has not been sent. Please refresh and try again"));
			}

			return $this->refresh();
		} else if (!Yii::$app->user->isGuest) {
			$model->name = Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name;
			$model->email = Yii::$app->user->identity->email;
			$model->phone = (isset(Yii::$app->user->identity->mobile) && Yii::$app->user->identity->mobile != null ? Yii::$app->user->identity->mobile : '');
		}



		return $this->render('insidentForm', [
			'model' => $model,
		]);
	}



	public function actionDiversitypolicy()
	{
		return $this->render('diversitypolicy');
	}

	public function actionPolicecheckpolicy()
	{

		return $this->render('policecheckpolicy');
	}

	public function actionTrainingpolicy()
	{

		return $this->render('trainingpolicy');
	}


	public function actionContact_us()
	{

		$secretKey = Yii::$app->params['CaptchaSecret'];
		$captchaVarification = false;
		$model = new ContactForm();

		if ($model->load(Yii::$app->request->post())) {

			if (Yii::$app->request->post('captcha-response-contact-us') && !empty(Yii::$app->request->post('captcha-response-contact-us'))) {
				$verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secretKey . '&response=' . Yii::$app->request->post('captcha-response-contact-us'));
				$responseData = json_decode($verifyResponse);
				if ($responseData->success) {
					$captchaVarification = true;
				} else {
					$captchaVarification = false;
				}
			}

			if ($captchaVarification == false) {

				Yii::$app->session->setFlash("error", Yii::t('app', "Robot verification failed, please try again"));
				return $this->refresh();
			}


			$this->recordEvent('contact-us', []);
			if ($model->createMail()) {
				Yii::$app->session->setFlash("success", Yii::t('app', "Thank you for contacting us. We will get back to you shortly"));
			} else {
				Yii::$app->session->setFlash("error", Yii::t('app', "Your message has not been sent. Please refresh and try again"));
			}

			return $this->refresh();
		} else if (!Yii::$app->user->isGuest) {
			$model->name = Yii::$app->user->identity->first_name . ' ' . Yii::$app->user->identity->last_name;
			$model->email = Yii::$app->user->identity->email;
			$model->phone = (isset(Yii::$app->user->identity->mobile) && Yii::$app->user->identity->mobile != null ? Yii::$app->user->identity->mobile : '');
		}

		$this->view->params['page_title'] = 'Contact Us';
		$this->view->params['banner_description'] = "The PetCloud Team is made up of long-serving individuals from different cultures, values, abilities, and norms who share a love of animals. 
		They have all been trained in Customer Service, Animal Care, NDIS Legislation, and Privacy Laws.  We believe every individual should have an equal opportunity to make the most of their lives and talents. By signing up or signing in to PetCloud you agreed to adhere to our <a href='https://community.petcloud.com.au/portal/en/kb/articles/anti-discrimination-policy-4-6-2022' target='_blank'>Anti-discrimination</a> policy by respectfully engaging with our team. ";
		$this->view->params['banner_image'] = '/img/pages/contact_us_new.png';

		return $this->render('contact_us', [
			'model' => $model,
		]);
	}

	public function actionTeam()
	{
		$this->view->params['page_title'] = 'Our Team';
		$this->view->params['banner_description'] = 'The following team members make it all possible!';
		$this->view->params['banner_image'] = '/img/pages/about-banner.jpg';
		$teamMembers = Team::find()->where(['active' => 1])->all();
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('team', ['teamMembers' => $teamMembers]);
	}

	public function actionAbout()
	{
		$this->view->params['page_title'] = 'About Us';
		$this->view->params['banner_description'] = 'PetCloud is a high quality, national, pet care network who make responsible pet care easy.';
		$this->view->params['banner_image'] = '/img/pages/about-banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('about');
	}

	public function actionInsurance()
	{
		$this->view->params['page_title'] = 'Insurance Protection';
		$this->view->params['banner_description'] = 'PetCloud is proud to supply the most comprehensive insurance to ensure Pet Sitters, Pet Owners and all pets in the care of a registered PetCloud Sitter are covered so that they are cared for in the best way possible.';
		$this->view->params['banner_image'] = '/img/pages/insurance-banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('insurance');
	}

	public function actionFaq()
	{
		Yii::$app->response->redirect("https://community.petcloud.com.au/portal/en/kb/petcloud", 301);
		Yii::$app->end();
		return;
	}

	public function actionHow_it_works()
	{
		$this->view->params['page_title'] = 'How it Works';
		$this->view->params['banner_description'] = 'Having a meet and greet is really important for you and your Pet. We go through how you should conduct one.';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}

		$this->view->params['banner_image'] = '/img/pages/home-page/Meet-and-Greet-Banner.png';
		return $this->render('how_it_works');
	}

	public function actionVerification_badges()
	{
		$this->view->params['page_title'] = 'Verification Badges';
		$this->view->params['banner_description'] = 'The badges displayed on PetCloud search results and the sitter profile pages are visual symbols of trust, and expertise, knowledge and values.';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('verification_badges');
	}

	public function actionGps_tracking()
	{
		$this->view->params['page_title'] = 'GPS Tracking';
		$this->view->params['banner_description'] = '<p>Our cloud-partner Pet Find provides state of the art GPS tracking and will notify you if your pet strays. Not only is TrakaPet one of the most accurate on the market, but it is also easy-to-use.</p><a rel="nofollow" href="https://www.gpspetcollar.com.au/" target="_blank"><button type="button" class="btn btn-aqua shop-now-btn">Shop Now</button></a>';
		return $this->render('gps_tracking');
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
	}

	public function actionPet_minding_course()
	{
		Yii::$app->response->redirect("/petcloudacademy", 301);
		Yii::$app->end();
		return;
	}

	public function actionPet_owner_course()
	{
		$this->view->params['page_title'] = 'Accredited Pet Owner Course';
		$this->view->params['banner_description'] = 'This course provides an outstanding opportunity for Pet Owners to gain confidence and skills needed to provide a high standard of care.';
		$url = Yii::$app->user->isGuest ? Url::to(["/signup?redirect=learningcare"], 'https') : Url::to(["learning/care"], 'https');
		$this->view->params['extra_button'] = '<div class="col-xs-12 text-center"><a href="' . $url . '"><button type="button" class="btn btn-aqua" style="font-size: 28px;padding: 15px;">Join & Enrol Now</button></a></div>';
		$this->view->params['banner_image'] = '/img/pages/banner_animal_care_course.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('pet_owner_course');
	}

	public function actionEmergency_vet_care()
	{
		$this->view->params['page_title'] = 'Emergency Vet Care';
		$this->view->params['banner_description'] = 'We hope you\'ll never have to deal with a pet emergency. In case of any of these emergency situations, contact a veterinarian immediately. Once the situation is under control, please reach out to PetCloud Support so we can offer further assistance.';
		$this->view->params['banner_image'] = '/img/pages/emergency-vet.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('emergency_vet_care');
	}

	public function actionPetcloud_property_check_list()
	{
		$this->view->params['page_title'] = 'PetCloud Property Check List';
		$this->view->params['banner_description'] = 'This page is a summary of the "RSPCA Qld Property Guide for Home Pet Stays". Please read the full document to gain a more complete understanding of security and safety issues that impact pet minders and pet owners.';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('petcloud_property_check_list');
	}

	public function actionTrust_safety()
	{
		$this->view->params['page_title'] = 'Trust & Safety';
		$this->view->params['banner_description'] = 'Our commitment to trust and safety and so we have added several safety-related features to strengthen trust and confidence in our community. With a National network of Pet Sitters and Pet Services across Australia - trust is what makes it work.';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('trust_safety');
	}

	public function actionAmbassador_program()
	{
		$this->view->params['page_title'] = 'Ambassador Program';
		$this->view->params['banner_description'] = 'PetCloud is looking for Ambassadors in each State in Australia; Queensland, New South Wales, Australian Capital Territory, Victoria, Tasmania, South Australia, Western Australia, Northern Territory.';
		$this->view->params['banner_image'] = '/img/pages/ambassador/petcloud-ambassador.png';

		return $this->render('ambassador_program');
	}

	public function actionReviews()
	{
		$this->view->params['page_title'] = "See what people are saying about PetCloud";
		$this->view->params['banner_description'] = "We are a radically transparent sharing economy organisation. We aim to continually improve, and every review helps other Pet Owners make good booking decisions, and helps our community provide better experiences for everyone.";
		$this->view->params['banner_image'] = '/img/pages/Pet_Owner_Reviews_banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$reviewSearch = new ReviewSearch();
		$reviews = $reviewSearch->searchReviews(Yii::$app->params, 30);

		return $this->render('reviews', [
			'reviews' => $reviews
		]);
	}

	public function actionLearning_external()
	{
		return $this->render('learning_external');
	}

	public function actionTerms_of_service()
	{
		$this->view->params['page_title'] = 'Terms of Service';
		$this->view->params['banner_description'] = 'The Terms of Service Terms and Conditions of Usage are in place to ensure the safety of our Owners, Minders, and their Pets. This ensures that together we have a happy, healthy, well-connected community of animal lovers!';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('terms_of_service');
	}

	public function actionCookie_policy()
	{
		$this->view->params['page_title'] = 'Privacy & Cookie Policy';
		$this->view->params['banner_description'] = '';
		return $this->render('cookie_policy');
	}

	public function actionPetcloud_difference()
	{
		$this->view->params['page_title'] = 'The PetCloud Difference';
		$this->view->params['banner_description'] = 'At PetCloud, we strive to ensure you have the best care experience possible. Thanks to the amazing staff at RSPCA Qld, our team have attempted to nut out scenarios, processes, and procedures to ensure you & your pet have only the best experience possible';
		$this->view->params['banner_image'] = '/img/pages/petcloud-difference-banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('petcloud_difference');
	}

	public function actionCode_of_conduct()
	{
		$this->view->params['page_title'] = 'Code of Conduct';
		$this->view->params['banner_description'] = "We're passionate about connecting people ready to work with Pet Owners who need care for their pets. As PetCloud continues to grow, it's important that the community follows guidelines that reflect our values and standards of behaviour";
		$this->view->params['banner_image'] = '/img/pages/about-banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('code_of_conduct');
	}

	public function actionRspca_partnership()
	{
		$this->view->params['page_title'] = 'RSPCA Partnership';
		$this->view->params['banner_description'] = "PetCloud is part-owned by one of Australia most respected and trusted Animal Welfare Charities, <a href='https://www.rspcaqld.org.au' rel='nofollow' target='_blank'>RSPCA Qld</a>";
		$this->view->params['banner_image'] = '/img/pages/petcloud-difference-banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('rspca_partnership');
	}

	public function actionVirgin()
	{
		Yii::$app->response->redirect(Url::to(['/']), 301);
		$this->view->params['page_title'] = 'Virgin Australia Holidays';
		$this->view->params['banner_description'] = "You now don’t have to choose between meeting a new client, or going on a holiday, and your pet again";
		$this->view->params['banner_image'] = '/img/pages/virgin-banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('virgin');
	}

	public function actionFlightcentre()
	{
		$this->view->params['page_title'] = 'Flight Centre';
		$this->view->params['banner_description'] = "Flight Centre are one of Australia's leading travel booking companies - Choose from short cruises, long cruises, flights, car hire, hotels and more. <p><a target='_blank' href='https://www.flightcentre.com.au/deals/hot-1'><img src='https://cdn.petcloud.com.au/img/pages/button_hot-deals.png'/></a></p>";
		$this->view->params['banner_image'] = 'https://cdn.petcloud.com.au/img/pages/flight-centre_banner.png';

		return $this->render('flightcentre');
	}

	public function actionSocial_responsibility()
	{
		$this->view->params['page_title'] = 'Social Impact';
		$this->view->params['banner_description'] = "As a community-minded organisation, we believe there are many social issues that PetCloud can help to alleviate. We believe we have an obligation to act for the benefit of society at large and not solely focused on maximising profits";
		$this->view->params['banner_image'] = 'https://cdn.petcloud.com.au/img/pages/SocialImpactBanner.png';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('social_responsibility');
	}

	public function actionPress_media()
	{
		$this->view->params['page_title'] = 'Press and Media';
		$this->view->params['banner_description'] = "We continue to have a considerable amount of success in national coverage from the media. We have been on every Australian TV channel, major newspapers, radio, and social media";
		$this->view->params['banner_image'] = '/img/pages/media-banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('press-media');
	}

	public function actionPet_care_services()
	{
		$this->view->params['page_title'] = 'Services & Prices';
		$this->view->params['banner_description'] = "PetCloud.com.au has loving pet carers across Australia who offer all kinds of pet care services for busy pet owners to keep their pets happy and healthy!";

		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}

		$this->view->params['banner_image'] = 'https://cdn.petcloud.com.au/img/pages/herobanner.png';

		return $this->render('pet_care_services');
	}

	public function actionBoard()
	{
		$this->view->params['page_title'] = 'PetCloud Board';
		$this->view->params['banner_description'] = "<p>We're Australia’s most trusted network of pet carers—join us!</p>";
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('board', []);
	}

	public function actionBecome_a_pet_sitter($location = '')
	{

		$location = trim(ucwords(preg_replace('/[-_]+/', ' ', $location)));
		return $this->render('become_a_pet_sitter', ['location' => $location]);
	}

	public function actionBecome_a_dog_trainer()
	{

		return $this->render('become_a_dog_trainer');
	}

	public function actionTop_dog_boarding_cities($service = '')
	{
		$servicetrim = trim(ucwords(preg_replace('/[-_]+/', ' ', $service)));
		return $this->render('top_cities/top_dog_boarding_cities', ['service' => $service, 'servicetrim' => $servicetrim]);
	}

	public function actionCities_list_by_state($service = '', $state = '')
	{
		$statesAbbreviations = array(
			"Australian Capital Territory" => "ACT",
			"New South Wales" => "NSW",
			"Northern Territory" => "NT",
			"Queensland" => "QLD",
			"South Australia" => "SA",
			"Tasmania" => "TAS",
			"Victoria" => "VIC",
			"Western Australia" => "WA"
		);


		$servicetrim = trim(ucwords(preg_replace('/[-_]+/', ' ', $service)));
		$state = trim(ucwords(preg_replace('/[-_]+/', ' ', $state)));

		$query = new Query();

		$results = $query->select('*')
			->from('geocode_cache')
			->where(['state' => $statesAbbreviations[$state]])
			->groupBy('suburb')
			->all();


		return $this->render('top_cities/cities_list_by_state/cities_list', ['service' => $service, 'location' => $state, 'statesAbbreviations' => $statesAbbreviations[$state], 'result' => $results, 'servicetrim' => $servicetrim]);
	}

	public function actionTop_pet_sitting_jobs_cities($service = '')
	{
		$servicetrim = trim(ucwords(preg_replace('/[-_]+/', ' ', $service)));
		return $this->render('top_cities/top_pet_sitting_jobs_cities', ['service' => $service, 'servicetrim' => $servicetrim]);
	}

	public function actionJob_cities_list_by_state($service = '', $state = '')
	{
		$statesAbbreviations = array(
			"Australian Capital Territory" => "ACT",
			"New South Wales" => "NSW",
			"Northern Territory" => "NT",
			"Queensland" => "QLD",
			"South Australia" => "SA",
			"Tasmania" => "TAS",
			"Victoria" => "VIC",
			"Western Australia" => "WA"
		);


		$servicetrim = trim(ucwords(preg_replace('/[-_]+/', ' ', $service)));
		$state = trim(ucwords(preg_replace('/[-_]+/', ' ', $state)));

		$query = new Query();

		$results = $query->select('*')
			->from('geocode_cache')
			->where(['state' => $statesAbbreviations[$state]])
			->groupBy('suburb')
			->all();


		return $this->render('top_cities/cities_list_by_state/job_cities_list', ['service' => $service, 'location' => $state, 'statesAbbreviations' => $statesAbbreviations[$state], 'result' => $results, 'servicetrim' => $servicetrim]);
	}


	public function actionCareers()
	{
		$this->view->params['page_title'] = 'Careers With PetCloud';
		$this->view->params['banner_description'] = "<p>We're Australia’s most trusted network of pet carers—join us!</p>";
		$this->view->params['banner_image'] = '/img/pages/become-a-pet-sitter/become-a-pet-sitter-banner.jpg';
		if (Yii::$app->user->isGuest) {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		return $this->render('careers', []);
	}

	public function actionBecome_a_pet_sitter_location($location)
	{

		$location = trim(ucwords(preg_replace('/[-_]+/', ' ', $location)));
		return $this->render('become_a_pet_sitter_location', ['location' => $location]);
	}

	// Our Services
	public function actionDoggy_day_care()
	{

		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";

		return $this->render('doggyDayCare');

	}



	public function actionBest_sitter_near_me()
	{

		return $this->render('bestSitterNear');
	}

	public function actionDog_boarding_near_me()
	{

		return $this->render('dogboardingnear');
	}
	public function actionWhy_join_petcloud()
	{

		return $this->render('whyjoinpetCloud');
	}

	public function actionBecome_dog_walker()
	{

		return $this->render('becomeDogWalker');
	}

	public function actionBecome_dog_groomer()
	{

		return $this->render('become_dog_groomer');
	}

	public function actionDog_sitters()
	{
		$url = Url::to(["/pet-sitters?"], 'https');
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('services/dog_sitting');
	}

	public function actionDog_walkers()
	{
		$url = Url::to(["/pet-sitters?"], 'https');

		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('dogWalkers');
	}

	public function actionHouse_sitters()
	{
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('houseSitters');
	}

	public function actionDog_boarding()
	{
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('dogBoarding');
	}

	public function actionHome_visits()
	{
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('homeVisits');
	}

	public function actionCat_sitters()
	{
		$this->view->params['page_title'] = 'Cat Sitting & Boarding';
		$this->view->params['banner_description'] = "On PetCloud, you can find sitters who would host your cat at their place, take care at your place as a house sitter or just visit your home to feed the cat";
		$this->view->params['banner_image'] = '/img/pages/services/cat-sitter-banner-sml.jpg';
		$url = Url::to(["/pet-sitters?"], 'https');
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('services/cat_sitting');
	}

	public function actionDog_groomers()
	{
		$url = Url::to(["/pet-sitters?"], 'https');
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('dogGroomers');
	}

	public function actionPetCare24Hour()
	{
		//die("testing");
		$url = Url::to(["/pet-sitters?"], 'https');
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('24hourPetCare');
	}

	public function actionMinding_sitters_home()
	{
		$url = Url::to(["/pet-sitters?"], 'https');
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('mindingSittersHome');
	}

	public function actionWashing_brushing()
	{
		$this->view->params['page_title'] = 'Washing and Brushing';
		$this->view->params['banner_description'] = "Now who doesn't love a good pampering and grooming session? Grooming is not only important for your dog's cleanliness but also for it's health and appearance";
		$this->view->params['banner_image'] = '/img/pages/services/dog-grooming-banner.jpg';
		$url = Url::to(["/pet-sitters?"], 'https');
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('washing_brushing');
	}

	public function actionPet_taxi()
	{
		$url = Url::to(["/pet-sitters?"], 'https');
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('petTaxi');
	}

	public function actionNdis_pet_care()
	{
		$url = Url::to(["/pet-sitters?"], 'https');
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('ndisPetCare');
	}

	public function actionPet_taxi_for_groomers_and_vets()
	{
		Yii::$app->response->redirect(Url::to(['/']), 301);
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('petTaxiForGroomersAndVets');
	}

	public function actionBecome_a_pet_taxi_driver()
	{

		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('becomeAPetTaxiDriver');
	}

	public function actionDog_trainer()
	{
		if (Yii::$app->user->isGuest) {
			$link = '<a href="guest/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/guest/post-a-job">Post a Job</a>';
		} else {
			$link = '<a href="/post-a-job" class="btn btn-aqua" style="font-size: 24px;padding: 15px;">Post a Job</a>';
			$this->view->params['post_job_btn'] = '<a class="banner_inner_btn" href="/post-a-job">Post a Job</a>';
		}
		$this->view->params['extra_button'] = "<div class='col-xs-12 text-center'>$link </div>";
		return $this->render('dogTrainer');
	}

	public function actionBreedindex($search = 'A')
	{
		$pages = Pages::find()->select(['id', 'url', 'image', 'title', 'seoDescription'])->where(['category' => 'breed'])->andWhere("publishDate IS NOT NULL")->andWhere("title LIKE \"$search%\"")->all();

		return $this->render('breeds/index', ['pages' => $pages, 'search' => $search]);
	}

	public function actionSubscribe()
	{
		return $this->render('subscribe');
	}

	public function actionCatch($url)
	{
		$page = Pages::find()->select(Pages::$publicSelect)->where(['url' => $url, 'category' => Pages::PAGETYPE])->one();
		if (empty($page)) {
			Yii::warning("No page found - return");
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	public function actionTest($url)
	{
		$page = Pages::find()->where(['url' => $url, 'category' => Pages::PAGETYPE])->one();
		if (empty($page)) {
			Yii::warning("No page found - return");
			throw new NotFoundHttpException('The requested page does not exist.');
		}
		/** @var Pages $page */
		$this->view->params['page_title'] = $page->editTitle;
		$this->view->params['banner_description'] = $page->editBannerText;
		if (!empty($page->editActionButton)) {
			$this->view->params['extra_button'] = '<div class="col-xs-12 text-center"><a href="' . $page->editActionButton . '"><button type="button" class="btn btn-aqua" style="font-size: 28px;padding: 15px;"><?= $model->buttonText ?></button></a></div>';
		}
		if (!empty($page->editImage)) {
			$this->view->params['banner_image'] = $page->editImage;
		}

		return $this->render("test", ['model' => $page]);
	}

	/**
	 * Finds the Pages model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param string $id
	 * @return Pages the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($url)
	{
		if (($model = Pages::find()->select(Pages::$publicSelect)->where(['url' => $url, 'category' => 'page'])->andWhere("publishDate IS NOT NULL")->one()) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
