<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\Users;
use app\models\CarmailproductionCompanies as Companies;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Customer Reviews';
$this->params['breadcrumbs'][] = $this->title;

$template = '{view}{update}{delete}';

$user = Yii::$app->user->identity;
if ($user->isCrmUser){
    $template = '{view}';
}

$companies = Companies::find()->orderBy(['name' => SORT_ASC]);

if ($user->company_id != 0 || $user->company_id > 0) {
    $companies->where(['id' => $user->company_id]);
}
$companies = $companies->asArray()->all();
$filter = ArrayHelper::map($companies, 'id', 'name');

?>
<div class="customer-review-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="section-1">
       
        <div class="col-md-8">
             <div class="row">
                <div class="col-md-6  ">
                    <div class="revies-div bodr">
                    <h4>Total Reviews</h4>
                    <p id="reviewscount"><?php echo $totalreviewsount[0]['total_reviews'];?></p>
                    </div> 
                </div>
                 <!-- <div class="col-md-6  ">
                        <div class="sale-div bodr">
                            <h4>Sales</h4>
                            <p><?php //echo $totalreviewsount[0]['total_reviews'];?></p>
                        </div>
                </div>   -->          
            </div>  
    </div>
    <div class="col-md-4">
            <div class="chrrrt">
                    <form class="form-group form-inline" method="post">
                        <!-- <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken; ?>"> -->
                      <label for="sel1">Reviews Filter</label>
                      <select class="form-control" id="sel1">
                        <!-- <option>Filter Reviews</option> -->
                        <option>Today</option>
                        <option>Yesterday</option>
                        <option>Week</option>
                        <option>Month</option>
                      </select>
                    </form>
            </div>
    </div>
        <div class="clearfix"></div>
    </div>


    <?php if (!Yii::$app->user->identity->isCrmUser) : ?>
        <div class="section-2">
                <div class="col-md-4">
                        <div class="csmtr-rw-btn">
                            <p>
                              <?= Html::a('Create Customer Review', ['create'], ['class' => 'btn btn-success']) ?>
                            </p>
                        </div>
                </div>
                <div class="clearfix"></div>
        </div>
    <?php endif; ?>

    

    <div>
        
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered custmr-rvw'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            [
                'label' => 'Company',
                'format' => 'raw',
                'attribute' => 'sales_id',
                'filter' => $filter,
                'value' => function ($model) {
                    $user = Users::findOne($model->sales_rep_id);
                    if (isset($user->role) && $user->role > 1) {
                        if (isset($user->company_id) && !is_null($user->company_id) && $user->company_id != 0) {
                            $company = Companies::findOne($user->company_id);
                            return $company->name;
                        }
                        return '';
                    }
                }
            ],

            array('attribute' => 'Vehicle',
                    'format' => 'html', 
                    'value' => function ($data) {
                        set_time_limit(60);
                        $image = $data->buyersSales['vehicle_img'] != '' && @getimagesize($data->buyersSales['vehicle_img'])
                            ? $data->buyersSales['vehicle_img']
                            : $data->vehicleImage;
                        return Html::img($image, ['width' => '50px']);
                },
            ),
            // 'customer_id',
            // 'sales_rep_id',
            ['attribute' => 'buyerName',
                'contentOptions' => ['class' => 'rvwbyrname'],
            ],
            ['attribute' => 'sellerName',
                'contentOptions' => ['class' => 'rvwslrnme']
            ],
            ['attribute' => 'created_at',
                'contentOptions' => ['class' => 'rvwdate'],
                'content'=>function($data){
                if($data->created_at != '')
                    return date("M-d-Y h:i A",strtotime($data->created_at));
                }
            ],
            // 'rating',
            ['attribute' => 'rating', 
            'contentOptions' => ['class' => 'rvw-rating'],
            'format' => 'raw', 
            'value' => function ($data) {

               $html = ($data->rating > 0)?'<i class="fa fa-star" style="color:#d3af53"></i>':'<i class="fa fa-star-o" style="color:#d3af53"></i>';
               $html .= ($data->rating > 1)?'<i class="fa fa-star" style="color:#d3af53"></i>':'<i class="fa fa-star-o" style="color:#d3af53"></i>';
               $html .= ($data->rating > 2)?'<i class="fa fa-star" style="color:#d3af53"></i>':'<i class="fa fa-star-o" style="color:#d3af53"></i>';
               $html .= ($data->rating > 3)?'<i class="fa fa-star" style="color:#d3af53"></i>':'<i class="fa fa-star-o" style="color:#d3af53"></i>';
               $html .= ($data->rating > 4)?'<i class="fa fa-star" style="color:#d3af53"></i>':'<i class="fa fa-star-o" style="color:#d3af53"></i>';

                return $html;
            }],
            // 'title',
            // 'details:ntext',
            [
                'attribute' => 'details',
                'contentOptions' => ['class' => 'detailss']
                ], 
            //'created_at',
            //'updated_at',
            //'is_thumbs_up',
            // 'sales_id',
            //'vin',
            // 'review_image',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $template
            ],
        ],
    ]); ?>
</div>
