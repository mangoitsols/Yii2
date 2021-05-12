<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CustomerReview */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Customer Reviews', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-review-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->identity->isCrmUser): ?>
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
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'customer_id',
            'sales_rep_id',
            'rating',
            'title',
            'details:ntext',
            'created_at',
            'updated_at',
            'is_thumbs_up',
            'sales_id',
            'vin',
            'review_image',
        ],
    ]) ?>

</div>
