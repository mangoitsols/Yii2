<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ip_address',
            'username',
            'password',
            'salt',
            'paypal_email:email',
            'email:email',
            'longitude',
            'latitude',
            'verifycode',
            'fbaccesstoken:ntext',
            'activation_code',
            'forgotten_password_code',
            'forgotten_password_time:datetime',
            'remember_code',
            'created_on',
            'last_login',
            'active',
            'verified',
            'first_name',
            'last_name',
            'phone',
            'mobile',
            'user_type',
            'gender',
            'dob',
            'zipcode',
            'areacode',
            'address:ntext',
            'street_address',
            'state',
            'primary_income',
            'hear_about',
            'good_minder:ntext',
            'pets',
            'pets_count',
            'about_pet:ntext',
            'imagename',
            'plan',
            'payment_received',
            'startdate',
            'promo_code',
            'enddate',
            'document_image',
            'verify_code',
            'verify_phoneflag',
            'verify_phone_number',
            'createdate',
            'experiencePets',
            'experienceYears',
            'qualifications',
            'hasQualifications',
        ],
    ]) ?>

</div>
