<?php

namespace app\controllers;

use app\models\Users;
use Yii;
use app\models\CustomerReview;
use app\models\Vehicles;
use app\models\BuyersSalesSearch;
use app\models\CustomerReviewSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CustomerReviewController implements the CRUD actions for CustomerReview model.
 */
class CustomerReviewController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    Yii::$app->controller->enableCsrfValidation = false
                ],
            ],
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index','view','create','update','delete'],
                'ruleConfig'=>['class'=>'app\components\CAccessRule'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => [
                            Users::ROLE_ADMIN,
                            Users::ROLE_MANAGER,
                            Users::ROLE_USER,
                        ],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => [
                            Users::ROLE_ADMIN,
                            Users::ROLE_MANAGER
                        ],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => [
                            Users::ROLE_USER,
                        ],
                        'matchCallback' => function ($rule, $action) {
                            $review = CustomerReview::findOne(Yii::$app->request->queryParams['id']);
                            return $review->sales_rep_id == Yii::$app->user->identity->id;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view','update','delete'],
                        'roles' => [
                            Users::ROLE_MANAGER
                        ],
                        'matchCallback' => function ($rule, $action) {
                            $review = CustomerReview::findOne(Yii::$app->request->queryParams['id']);
                            $user = Users::findOne($review->sales_rep_id);
                            return $user->company_id == Yii::$app->user->identity->company_id;
                        }
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index','view','update','delete'],
                        'roles' => [
                            Users::ROLE_ADMIN
                        ],
                    ],
                    // everything else is denied
                ],
            ],
        ];
    }

    /**
     * Lists all CustomerReview models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerReviewSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $totalreviewsount = CustomerReview::getTotalreviewsCount();
        // $dataProvider = new ActiveDataProvider([
        //     'query' => CustomerReview::find(),
        // ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'totalreviewsount'=> $totalreviewsount
        ]);
    }

    /*** Added By Arpit */
    
    public function actionReviewscountsbyfilter(){
        ob_start();
        $filter_val = Yii::$app->request->post('filterval');
        if(!empty($filter_val)){
            $filtercount = CustomerReview::getfiltercounts($filter_val);
        }
        echo json_encode($filtercount);
        return ob_get_clean();

    }

    public function actionReviewsbyseller(){
        // die('djfgsdfsg');
        ob_start();
        $seller_val = Yii::$app->request->post('sellerval');
        if(!empty($seller_val)){
            $filtercount = CustomerReview::getreviewsbysellers($seller_val);
        }
        echo json_encode($filtercount);

        return ob_get_clean();
    }
    
    /** End */

    /**
     * Displays a single CustomerReview model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CustomerReview model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerReview();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CustomerReview model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CustomerReview model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerReview model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerReview the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerReview::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
