<?php

namespace backend\controllers;

use Yii;
use backend\models\OpeningHours;
use backend\models\Shops;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * OpeningHoursController implements the CRUD actions for OpeningHours model.
 */
class OpeningHoursController extends Controller
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
     * Lists all OpeningHours models.
     * @return mixed
     */
    public function actionIndex($id)
    {
        $shop = new Shops();
        $shopModel = $shop->getShopById($id);
        $openingHours = new OpeningHours();
        $dataProvider = $openingHours->getShopOpeningHours($id);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'shopModel' => $shopModel,
        ]);
    }

    /**
     * Displays a single OpeningHours model.
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
     * Creates a new OpeningHours model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($shop_id)
    {
        $model = new OpeningHours();

        if ($model->load(Yii::$app->request->post())) {
            $model->shop_id = $shop_id;
            $model->full_day = 0;
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
           if($model->save())
            {
                echo 1;
                
            }
            else
            {
                echo 0;
            }
            return $this->redirect(['index', 'id' => $model->shop_id]);
            
        } else {
            $days = ['sat' => 'sat', 'sun' => 'sun' , 'mon' => 'mon', 'tue' => 'tue', 'wed' => 'wed', 'thu' => 'thu', 'fri' => 'fri'];
            $savedDays = ArrayHelper::map(OpeningHours::find()->where(['shop_id' => $shop_id])->all(), 'day_name', 'day_name');
            $remainDays = array_diff($days, $savedDays);
            $hours = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20, 21 => 21, 22 => 22, 23 => 23, 24 => 24];
            if(count($remainDays) > 0)
                return $this->renderAjax('create', [
                    'model' => $model,
                    'remainDays' => $remainDays,
                    'hours' => $hours,
                ]);
            else
                return $this->renderAjax('full-days');
        }
    }

    /**
     * Updates an existing OpeningHours model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = date('Y-m-d H:i:s');
           if($model->save())
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
            return $this->redirect(['index', 'id' => $model->shop_id]);
        } 
        else {
            $hours = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10, 11 => 11, 12 => 12, 13 => 13, 14 => 14, 15 => 15, 16 => 16, 17 => 17, 18 => 18, 19 => 19, 20 => 20, 21 => 21, 22 => 22, 23 => 23, 24 => 24];
            return $this->renderAjax('update', [
                'model' => $model,
                'hours' => $hours,
            ]);
        }
    }

    /**
     * Deletes an existing OpeningHours model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->delete();

        return $this->redirect(['index', 'id' => $model->shop_id]);
    }

    /**
     * Finds the OpeningHours model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return OpeningHours the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OpeningHours::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
