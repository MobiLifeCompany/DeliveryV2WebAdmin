<?php

namespace backend\controllers;

use Yii;
use backend\models\ShopRates;
use backend\models\ShopRatesSearch;
use backend\models\Shops;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ShopRatesController implements the CRUD actions for ShopRates model.
 */
class ShopRatesController extends Controller
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
                ],
            ],
        ];
    }

    /**
     * Lists all ShopRates models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopRatesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ShopRates model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Cities model.
     * @param integer $id
     * @return mixed
     */
    public function actionDetails($id)
    {
        $shopRates = new ShopRates();
        $dataProvider = $shopRates->getShopRates($id);
        $searchModel = new ShopRatesSearch();
        $shop = new Shops();
        $shopModel = $shop->getShopById($id);

        return $this->render('details', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'shopModel' => $shopModel,
        ]);
    }

    /**
     * Finds the ShopRates model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopRates the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopRates::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
