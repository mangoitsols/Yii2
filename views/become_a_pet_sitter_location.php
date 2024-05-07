<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
//$this->title = $this->params['page_title'];
//$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'description', 'content' => "Want to earn money providing pet sitting & minding services with flexible working hours? Join PetCloud now, Australia's most trusted pet network."]);
$this->params['submenu'] = Yii::$app->params['ourDifferenceSubMenu'];

$imageUrl = Yii::getAlias('@imageUrl');

$this->registerJs("
$(document).ready(function() {
    var videoUrl = 'https://www.youtube.com/embed/XJC4u4njhPM?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1';

    $('#videoModal').on('hide.bs.modal', function(){
        $('#youtubeVideo').attr('src', '');
    });

    $('#videoModal').on('show.bs.modal', function(){
        $('#youtubeVideo').attr('src', videoUrl);
    });

});
");

/**
 * START SEEK TRACKER
 */
if (strtolower(Yii::$app->request->get('utm_source')) == 'indeed') {
	Yii::$app->session->set("seektracker", 'true');
}
/**
 * END SEEK TRACKER
 */

?>

<div id="pet-sitter-responsibilities" class="container">
	<div class="row">
		<div class="col-xs-12">
			<h3>Become a Pet Sitter</h3>
			<h5>Company: PetCloud.com.au </h5>
			<h5>Location: <?= 'australia' != strtolower($location) ? "$location " : "" ?>Australia</h5>

			<p>Do you love cavoodles, frenchies, pugs, persian cats, ragdolls, tabbies, rabbits and guinea pigs? If so, PetCloud is for you! </p>

			<p>Getting paid to do Pet sitting through PetCloud.com.au is a great way to earn money from your own home or - from the Pet Owners home, and within your schedule. No experience necessary. </p>

			<p>We look for pet sitters who not only love all sorts of pets,but are also friendly and happy to go the extra mile for the owner’s pet. PetCloud pet sitting is perfect for those looking for seasonal, home-based, entry level or temporary work. </p>

			<p>Through our easy to use website, we will guide you through the steps to create your own advertising listing for Pet Owners to browse. You can choose when you want to work, accept only the pets you want to mind. </p>

			<p>Pet sitters are responsible for all basic animal care while their clients are on vacation or traveling for business. </p>

			<p><b>Routine duties include: </b></p>
			<ul>
				<li>Daily Feeding, putting out fresh water every morning and evening </li>
				<li>Brushing pets, </li>
				<li>Taking dogs on walks, and providing exercise through play. </li>
				<li>Cleaning litter boxes. </li>
				<li>Additional services may include giving medications, vacuuming up pet hair in the house, or collecting the client’s mail or newspaper. </li>
				<li>Pet sitters are also responsible for notifying owners and taking pets to the vet if they should become sick or suffer an injury while under their supervision. We are Australia's most trusted pet sitting service, partnered with the RSPCA across most States, so there will be plenty of job opportunities. </li>
				<li>We have an amazing Support Team and Paypal integration to assist your pet sitting operations. </li>
				<li>We cover every booking with insurance for you and the pet so you can relax. </li>
			</ul>
			<p>There are opportunities to grow as a pet sitter and become an Area Manager or a PR & Events Ambassador for PetCloud in your local area, city or even State! 

			<p>If this sounds like you, then APPLY TODAY</p>
		</div>
	</div>

	<div id="become-pet-sitter-buttons" class="row">
		<div class="col-xs-12 col-sm-12">
			<div class="button-center">
				<a class="btn btn-xl btn-pink pull-right" href="<?php echo Url::base('https')?>/signup">Apply Today</a>
			</div>
		</div>
	</div>
</div>


<div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="videoModal">How it works</h4>
            </div>
            <div class="modal-body">
                <iframe id="youtubeVideo" width="100%" height="313" src="" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>
    </div>
</div>
