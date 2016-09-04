<?php

namespace backend\controllers;

use Yii;
use backend\models\OrderItems;
use backend\models\OrderItemsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * OrderItemsController implements the CRUD actions for OrderItems model.
 */
class OrderItemsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' =>[
                'class' => AccessControl::className(),
                'only' => ['index','update','create','delete','view','details'],
                'rules' =>[
                    [
                        'allow' =>true,
                        'roles' =>['@'],
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all OrderItems models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || !Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN')
        {
             throw new ForbiddenHttpException;
        }
        else
        {
            $searchModel = new OrderItemsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single OrderItems model.
     * @param integer $id
     * @param integer $order_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionView($id, $order_id, $item_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $order_id, $item_id),
        ]);
    }

    /**
     * Creates a new OrderItems model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderItems();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'order_id' => $model->order_id, 'item_id' => $model->item_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OrderItems model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $order_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionUpdate($id, $order_id, $item_id)
    {
        $model = $this->findModel($id, $order_id, $item_id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at= date('Y-m-d H:i:s');
            if($model->save())
            {
                echo 1;
            }else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrderItems model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $order_id
     * @param integer $item_id
     * @return mixed
     */
    public function actionDelete($id, $order_id, $item_id)
    {
        $this->findModel($id, $order_id, $item_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderItems model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $order_id
     * @param integer $item_id
     * @return OrderItems the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $order_id, $item_id)
    {
        if (($model = OrderItems::findOne(['id' => $id, 'order_id' => $order_id, 'item_id' => $item_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

 public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }

        // Check only when the user is logged in
        if ( !Yii::$app->user->isGuest)  {
            if (Yii::$app->session['userSessionTimeout'] < time()) {
                Yii::$app->user->logout();
                $this->redirect(['site/login']);
            } else {
                Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
                return true; 
            }
        } else {
            return true;
        }
    }
      // Ajax Validation 
    public function actionValidation($id = null){
        $model = $id===null ? new OrderItems : OrderItems::findOne($id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format='json';
            return ActiveForm::validate($model);
        }
    }

    public function actionDetails($id)
    {
        $orderItems = new OrderItems();
        $dataProvider = $orderItems->getOrderItems($id);
        $order = $orderItems->getOrderById($id);
        $deliveryUser = $orderItems->getDeliveryUserByOrderId($id);

        return $this->render('details', [
            'dataProvider' => $dataProvider,
            'orderModel' =>$order,
            'deliveryUser' => $deliveryUser,
        ]);
    }


}
