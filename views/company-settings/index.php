<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompanySettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Company Settings';
$this->params['breadcrumbs'][] = $this->title;

$template = "{view}";
if (Yii::$app->user->identity->isManager) {
    $template = "{view}{update}";
}
if (Yii::$app->user->identity->isAdmin) {
    $template = "{view}{update}{delete}";
}
?>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <section class="content-header">
                <h1><?= Html::encode($this->title) ?></h1>
                <ol class="breadcrumb">
                    <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </section>
            <div class="company-settings-index" style="padding:15px 15px 0 15px">
                <?php if (!Yii::$app->user->identity->isCrmUser): ?>
                    <p>
                        <?= Html::a('Create Company Settings', ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                <?php endif; ?>
                <div class="table-responsive">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],

//                            'id',
                            [
                                'attribute' => 'company_id',
                                'value' => function ($model) {
                                    return $model->company->name;
                                },
                                'label' => 'Company Name',
                                'filter' => \app\models\CarmailproductionCompanies::getCompanyNames()
                            ],
                            [
                                'attribute' => 'tracking_enabled',
                                'value' => function ($model) {
                                    return ($model->tracking_enabled) ? 'Yes' : 'No';
                                },
                                'filter' =>['No','Yes'],
                            ],
                            [
                                'attribute' => 'chat_enabled',
                                'value' => function ($model) {
                                    return ($model->chat_enabled) ? 'Yes' : 'No';
                                },
                                'filter' =>['No','Yes'],
                            ],
                            [
                                'attribute'=>'created_at',
                                'format'=>'dateTime',
                                'label'=>'Date'
                            ],
                            //'updated_at',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => $template
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>