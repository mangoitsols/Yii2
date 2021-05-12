<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySettings */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 24px;
    }

    .switch input {display:none;}

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 19px;
        width: 19px;
        left: 3px;
        bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    .field-companysettings-tracking_enabled,
    .field-companysettings-chat_enabled{
        display: inline-block;
        float: left;
    }
    .field-companysettings-chat_enabled{
        margin-left: 7px;
    }
    .divider{
        clear:both;
    }
</style>
<div class="company-settings-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'company_id')
        ->dropDownList(\app\models\CarmailproductionCompanies::getCompanyNames()) ?>

    <?= $form->field($model, 'tracking_enabled',[
            'template'=>'<div><span>Tracking Enabled</span></div><label class="switch">{input}</span><span class="slider round"></span></label>{hint}{error}'
    ])->checkbox([],false) ?>

    <?= $form->field($model, 'chat_enabled',[
        'template'=>'<div><span>Chat Enabled</span></div><label class="switch">{input}</span><span class="slider round"></span></label>{hint}{error}'
    ])->checkbox([],false) ?>

    <div class="divider"></div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
