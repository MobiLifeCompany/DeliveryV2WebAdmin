<?php

namespace backend\controllers;

use Yii;
use backend\models\OrderHistories;
use backend\controllers\OrderHistoriesSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrderHistoriesController implements the CRUD actions for OrderHistories model.
 */
class OrderHistoriesController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' =>[
                'class' => AccessControl::className(),
                'only' => ['index','update','create','delete','view'],
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
     * Lists all OrderHistories models.
     * @return mixed
     */
    public function actionIndex($id)
    {

        $orderHistories = new OrderHistories();
        $dataProvider = $orderHistories->getOrderHistory($id);


        return $this->renderAjax('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrderHistories model.
     * @param integer $id
     * @param integer $order_id
     * @return mixed
     */
    public function actionView($id, $order_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $order_id),
        ]);
    }

    /**
     * Creates a new OrderHistories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new OrderHistories();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'order_id' => $model->order_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing OrderHistories model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $order_id
     * @return mixed
     */
    public function actionUpdate($id, $order_id)
    {
        $model = $this->findModel($id, $order_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'order_id' => $model->order_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing OrderHistories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $order_id
     * @return mixed
     */
    public function actionDelete($id, $order_id)
    {
        $this->findModel($id, $order_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OrderHistories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $order_id
     * @return OrderHistories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $order_id)
    {
        if (($model = OrderHistories::findOne(['id' => $id, 'order_id' => $order_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
