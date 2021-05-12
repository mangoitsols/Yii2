<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CompanySettings */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Company Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-settings-view">
    <p>
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-info']) ?>
        <?php if (Yii::$app->user->identity->isAdmin): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            [
              'attribute'=>'company.name',
//              'value'=>'',
              'label'=>'Company Name',
            ],
            [
                'attribute' => 'tracking_enabled',
                'value' => function ($model) {
                    return ($model->tracking_enabled) ? 'Yes' : 'No';
                }
            ],
            [
                'attribute' => 'chat_enabled',
                'value' => function ($model) {
                    return ($model->chat_enabled) ? 'Yes' : 'No';
                }
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
