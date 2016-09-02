<?php

namespace backend\controllers;

use Yii;
use backend\models\ShopDeliveryAreas;
use backend\models\ShopDeliveryAreasSearch;
use backend\models\Shops;
use backend\models\Areas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;


/**
 * ShopDeliveryAreasController implements the CRUD actions for ShopDeliveryAreas model.
 */
class ShopDeliveryAreasController extends Controller
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
     * Lists all ShopDeliveryAreas models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $shop = new Shops();
        $shopModel = $shop->getShopById($id);
        $shopDeliveryAreas = new ShopDeliveryAreas();
        $dataProvider = $shopDeliveryAreas->getShopDeliveryAreas($id);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'shopModel' => $shopModel,
        ]);
    }

    /**
     * Displays a single ShopDeliveryAreas model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ShopDeliveryAreas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopDeliveryAreas();
        $shopId = Yii::$app->request->queryParams['id'];
        if ($model->load(Yii::$app->request->post()) ) {
            $model->created_at= date('Y-m-d H:i:s');
            $model->updated_at= date('Y-m-d H:i:s');
            $model->shop_id= $shopId;
            if($model->save())
            {
                echo 1;
            }else
            {
                echo 0;
            }
            return $this->redirect(['index', 'id' => $shopId]);
        } else {
            $shop = new Shops();
            $shop = $shop->getShopById($shopId);
            $cityId = $shop->getModels()[0]['city_id'];
            $allAreas = ArrayHelper::map(Areas::find()->where(['city_id'=>$cityId])->all(),'id','name');
            $savedAreasTemp = ShopDeliveryAreas::find()->where(['shop_id' => $shopId])->all();
            $savedAreas = ArrayHelper::map(Areas::find()->where(['in','id',ArrayHelper::getColumn($savedAreasTemp, 'area_id')])->all(),'id','name');
            $remainAreas = array_diff($allAreas, $savedAreas);
            return $this->renderAjax('create', [
                'model' => $model,
                'remainAreas' =>  $remainAreas,
            ]);
        }
    }

    /**
     * Updates an existing ShopDeliveryAreas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $shopId = Yii::$app->request->queryParams['shop_id'];
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->updated_at= date('Y-m-d H:i:s');
            if($model->save())
            {
                echo 1;
            }else
            {
                echo 0;
            }
            return $this->redirect(['index', 'id' => $shopId]);
        } else {
            $shop = new Shops();
            $shop = $shop->getShopById($shopId);
            $cityId = $shop->getModels()[0]['city_id'];
            $allAreas = ArrayHelper::map(Areas::find()->where(['city_id'=>$cityId])->all(),'id','name');
            return $this->renderAjax('update', [
                'model' => $model,
                'allAreas' => $allAreas,
            ]);
        }
    }

    /**
     * Deletes an existing ShopDeliveryAreas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        $shopId = Yii::$app->request->queryParams['shop_id'];
        return $this->redirect(['index', 'id' => $shopId]);
    }

    /**
     * Finds the ShopDeliveryAreas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopDeliveryAreas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopDeliveryAreas::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
