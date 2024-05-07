<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\file\FileInput;
use kartik\widgets\DatePicker;
use app\assets\HTML5ImageEditorAsset;
use app\assets\UsersAsset;
use yii\helpers\Url;

HTML5ImageEditorAsset::register($this);
UsersAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$imageUrl = Yii::getAlias('@imageUrl');
$uploadUrl = Yii::getAlias('@uploadUrl');

$progress = $model->progress;

if(!empty($model->ndisprofile)){
	$model->ndis_participant = $model->ndisprofile->ndis_participant;
	$model->plan_managed = $model->ndisprofile->plan_managed;
	$model->plan_manager_email = $model->ndisprofile->plan_manager_email;
}
$progress_count = $model->progress_count;
$required_count = 3;
if (!empty($model->user_type)) {
    switch ($model->user_type) {
        case 1:
            $required_count = 3;
            break;
        case 2:
            $required_count = 7;
            break;
        case 3:
            $required_count = 8;
            break;
    }
}

$stateList = [];
foreach (Yii::$app->params['states'] as $index => $state) {
    $stateList[$index] = $state['shortName'];
}

$percent_complete = round(($progress_count / $required_count * 100), 0);
$percent_complete = ($percent_complete > 100) ? 100 : $percent_complete;
?>

<div class="users-form">
	<?php
		if ($progress_count < $required_count)
			echo $this->render('_userProgress', ['model' => $model, 'percent_complete' => $percent_complete, 'progress' => $progress]);
	?>

    <div class="row">
    	<div id="image-editor-container" class="col-md-4">
    		<?php

    			$id = Yii::$app->user->identity->id;
    			$module = 'users';
				$placeholder = "img/no-user-img.png";
				$editorText = 'Upload Image';
				$filepath = $imageUrl."/".$placeholder."?rand=" . rand(0, 1000);
				$editImage = '';

				if(!empty($model->imagename)) {
					$imagename = $model->getUserImage(true);
					$filepath = $imagename."?rand=" . rand(0, 1000);
					$editImage = $filepath;
					$editorText = 'Change Image';
				}

			?>

			<?php $form = ActiveForm::begin(['id' => 'image-editor-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
			<?= Html::hiddenInput("id", $id); ?>
			<?= Html::hiddenInput("module", $module); ?>
			<div id="image-editor-preview-container">
				<div id="image-editor-preview" style="background-image:url('<?php echo $filepath; ?>')">
					<div id="image-editor-preview-overlay" data-toggle="modal" data-target="#image-editor-modal"><span><?php echo $editorText; ?></span></div>
				</div>
			</div>

	        <div id="image-editor-button">
	            <button data-toggle="modal" data-target="#image-editor-modal" type="button" class="btn btn-default btn-block"><?php echo $editorText; ?></button>
	        </div>

	        <p class='small text-center' style='margin-top: 10px;font-weight: 600;'>This must be a clear photo of your face. Not a picture of a Pet or your Business Logo
			</br>
			<a href="javascript:;" data-toggle="tooltip" title="Care booked via PetCloud takes place in private homes.
We have a duty of care to collect this information from
Parties who interact with Sitters to make our community safe.">Why do I need to provide this?</a>
			</p>
			
			<div class="modal fade" id="image-editor-modal" tabindex="-1" role="dialog" aria-labelledby="uploadImageLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<div id="image-editor-modal-content" class="html5imageupload" data-resize="true" data-originalsize="false" data-width="600" data-height="600" data-url="<?php echo Url::to(["/imageeditor/savehtml"]);?>" style="width: 100%; height: 100%; min-width: 500" data-ghost='true' data-id='<?php echo $id; ?>' data-module='<?php echo $module; ?>'>
								<input type="file" name="thumb" />
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php ActiveForm::end(); ?>
        </div>

        <hr class="visible-xs" />

	    <div class="col-md-8">
		    <?php

		    $form = ActiveForm::begin([
		        'id' => 'profile-form',
		        'layout' => 'horizontal',
		        'fieldConfig' => [
		            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
		            'horizontalCssClasses' => [
		                'label' => 'col-sm-4',
		                'wrapper' => 'col-sm-8',
		            ],
		        ],
		    ]);
		    ?>

	    	<?= $form->field($model, 'user_type')->radioList(
	    			[
		    			'1' => Yii::t("app", "Find Pet Care Services"),
		    			'2' => Yii::t("app", "Offer Pet Care Services"),
		    			'3' => Yii::t("app", "Both")
	    			]
	    		)->label('Can you tell us, why have you joined PetCloud?'); ?>
			<?= $form->field($model, 'ndis_participant',['template'=>"{label}\n{beginWrapper}\n <span class='ndis_participant'>{input} Yes </span>\n{hint}\n{error}\n{endWrapper}"])->textInput(['class'=>"",'type'=>'checkbox','value'=>1,'checked'=>($model->ndis_participant) ? true : false])->label('Are you an NDIS participant?')?>
			
			<?= $form->field($model, 'plan_managed')->radioList(
	    			[
		    			'1' => Yii::t("app", "Self Managed"),
		    			'2' => Yii::t("app", "By a Plan Manager"),
		    			'3' => Yii::t("app", "NDIA-managed")
	    			]
	    		)->label('how is your Plan managed?'); ?>
			<?= $form->field($model, 'plan_manager_email')->textInput(); ?>
			<?= $form->field($model, 'first_name')->textInput(); ?>
			<?= $form->field($model, 'last_name')->textInput(); ?>
			<?= $form->field($model, 'gender',['inputOptions' => ['id' => 'gender_imm'],
										'hintOptions' => ['class' => 'c'],
										'inlineRadioListTemplate'=>"{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"])->inline()->radioList(['M' => Yii::t("app", "Male"), 'F' => Yii::t("app", "Female")])->hint('<a href="javascript:;" data-toggle="tooltip" data-html="true" title="<p align=\'left\'>Our Payment Gateway Provider asks for this info for them to approve your account.</p>">Why do I need to provide this?</a>'); ?>

			<span class="format_imm">dd/mm/yyyy</span>
			<?= $form->field($model, 'dob',[
										'inputOptions' => ['id' => 'dob_imm'],
										'hintOptions' => ['class' => 'c'],
										"template" => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"
									])->textInput()->hint('<a href="javascript:;" data-toggle="tooltip" data-html="true" title="<p align=\'left\'>Our Payment Gateway Provider requires us to collect your DOB in order to approve your account.</p>">Why do I need to provide this?</a>'); ?>
			<div class="help-block help-block-error imm_err" style="display:none;"></div>
			

            <?= $form->field($model, 'latitude',['options' => ['tag' => false]])->input('hidden')->label(false); ?>
            <?= $form->field($model, 'longitude', ['options' => ['tag' => false]])->input('hidden')->label(false); ?>

            <?= $form->field($model, 'street_address',[
										'hintOptions' => ['class' => 'c'],
										"template" => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}"
									])->textInput()->hint('<a href="javascript:;" data-toggle="tooltip" title="Sitters exact street address will never be displayed on our maps.
Owners addresses are never displayed on our maps.">My address privacy</a>'); ?>
			<div class="form-group field-users-address has-success" style="padding-bottom:0px;margin-bottom:0px;">
                <label class="control-label col-sm-4" for="users-address">&nbsp;</label>
                <div class="col-sm-8" style="font-size:12px;">
                    Please select an address from the dropdown
                </div>
            </div>

            <?= $form->field($model, 'address')->input('text')->label('Suburb'); ?>

            <?= $form->field($model, 'state')->dropDownList($stateList); ?>

            <?= $form->field($model, 'zipcode')->input('text')->label("Postcode"); ?>

			<?= $form->field($model, 'email',['inputOptions'=> ['id' => 'email_chk']])->input('email')->textInput(['readonly'=> true]); ?>

			<?= $form->field($model, 'phone')->textInput(); ?>
			
			<?= $form->field($model, 'mobile')->textInput(); ?>
			
	        <hr class="full-width" />
			<div class="text-right">
			<?=  Html::submitButton('Save', ['class' => 'btn btn-aqua', 'name' => 'save-button']) ?>
			<!--<button type="button" class="btn btn-aqua" name="save-button" id="save_btn">Save</button>-->
			<?= Html::a("Go to my Pet's Profile >", ['/pet'], ['class' => 'pet-profile-link btn btn-aqua']) ?>
			</div>

	    </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
