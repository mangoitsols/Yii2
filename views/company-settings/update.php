<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySettings */

$this->title = 'Update Company Settings: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Company Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
