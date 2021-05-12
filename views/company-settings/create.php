<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CompanySettings */

$this->title = 'Create Company Settings';
$this->params['breadcrumbs'][] = ['label' => 'Company Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
