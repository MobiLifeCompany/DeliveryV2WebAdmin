<?php

namespace backend\controllers;

use Yii;
use backend\models\Shops;
use backend\models\ShopsSearch;
use backend\models\ShopDeliveryAreas;
use backend\models\Areas;
use backend\models\ImageUpload;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use yii\Helpers\Url;

/**
 * ShopsController implements the CRUD actions for Shops model.
 */
class ShopsController extends Controller
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
     * Lists all Shops models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ShopsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Shops model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $shop = Shops::find()->where(['id' => $id])->one();

        $deliveryAreas = array();
        foreach ($shop->shopDeliveryAreas as $deliveryArea) {
            array_push($deliveryAreas, Areas::find()->where(['id' => $deliveryArea->area_id])->one());
        }
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'deliveryAreas' => $deliveryAreas,
        ]);
    }

    /**
     * Displays all Shops delivering to selected area.
     * @param integer $id
     * @return mixed
     */
    public function actionDetails($id)
    {
        $cities = new Cities();
        $dataProvider = $cities->getCountryCities(Yii::$app->request->queryParams);

        return $this->render('details', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Shops model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Shops();
        $imageModel = new ImageUpload();
        $imageModel->imageFile = UploadedFile::getInstance($model, 'photo');
        //
        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = date('Y-m-d h:m:s');
            $model->updated_at = date('Y-m-d h:m:s');
            $model->photo = $imageModel->imageFile->baseName . '.' . $imageModel->imageFile->extension;
           if($model->save())
            {
                $last_id = $model->id;
                //Upload image
                FileHelper::createDirectory('images/shops/'. $last_id);
                $imageModel->upload($last_id);
                echo 1;
            }
            else
            {
                echo 0;
            }
        }
        else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Shops model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             $model->updated_at = date('Y-m-d h:m:s');
            if($model->save())
            {
                echo 1;
            }
            else
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
     * Update shop delivery areas.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionAreas($id)
    {
        $model = new ShopDeliveryAreas();
        
        if ($model->load(Yii::$app->request->post())) {
            $selectedAreas = $model->area_id;
            if(isset($selectedAreas))
            {
                ShopDeliveryAreas::deleteAll(['shop_id' => $id]);
                foreach($selectedAreas as $area){
                    $model = new ShopDeliveryAreas();
                    $model->area_id = $area;
                    $model->shop_id = $id;
                    $model->deleted = 0;
                    $model->created_at = date('Y-m-d h:m:s');
                    $model->updated_at = date('Y-m-d h:m:s');
                    $model->save();
                }
            }

            return $this->redirect(Url::to('index.php?r=shops'));

        } else {
            $deliveryAreas = ArrayHelper::map($this->findDeliveryAreas($id),'area_id','area_id');
            $model->area_id = $deliveryAreas;
            return $this->renderAjax('areas', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Shops model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Shops model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shops the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Shops::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the delivery areas according to shop id.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Shops the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findDeliveryAreas($id)
    {
        $model = ShopDeliveryAreas::find()->where(['shop_id' => $id])->orderBy('id')->all();
        return $model;
    }
}
