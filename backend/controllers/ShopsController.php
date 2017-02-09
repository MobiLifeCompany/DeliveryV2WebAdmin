<?php

namespace backend\controllers;

use backend\models\OpeningHours;
use Yii;
use backend\models\Shops;
use backend\models\ShopsSearch;
use backend\models\ShopDeliveryAreas;
use backend\models\Areas;
use backend\models\Cities;
use backend\models\ImageUpload;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use yii\web\ForbiddenHttpException;

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
     * Lists all Shops models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->can('show_shops') && !(Yii::$app->session['realUser']['user_type']=='CR_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN'))
        {
            throw new ForbiddenHttpException;
        }
        else
        {
            $searchModel = new ShopsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
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
       if(!empty($shop->shopDeliveryAreas)){
            foreach ($shop->shopDeliveryAreas as $deliveryArea) {
                array_push($deliveryAreas, Areas::find()->where(['id' => $deliveryArea->area_id])->one());
            }
          }
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
            'deliveryAreas' => $deliveryAreas,
        ]);
    }

    public function actionDetails($id)
    {
        $areaShops = ShopDeliveryAreas::find()->joinWith(['shop'])->where(['shop_delivery_areas.area_id' => $id])->all();
        $result = [];
        foreach($areaShops as $shop){
            $result[$shop['shop']->id] = $shop['shop'];
         }
        return $this->renderAjax('details', [
            'areaShops' => $result,
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
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->photo = $imageModel->imageFile->baseName . '.' . $imageModel->imageFile->extension;
           if($model->save())
            {
                $last_id = $model->id;
                // Add Opening Hours
                $days = ['sat' => 'sat', 'sun' => 'sun' , 'mon' => 'mon', 'tue' => 'tue', 'wed' => 'wed', 'thu' => 'thu', 'fri' => 'fri'];
                foreach($days as $key=>$value){
                    $openingHours = new OpeningHours();
                    $openingHours->shop_id = $last_id;
                    $openingHours->full_day = 0;
                    $openingHours->day_name = $key;
                    $openingHours->from_hour = 11;
                    $openingHours->to_hour = 18;
                    $openingHours->created_at = date('Y-m-d H:i:s');
                    $openingHours->save();
                }
                //Upload image
                FileHelper::createDirectory('images/shops/'. $last_id);
                $imageModel->upload($last_id, 'images/shops/');
                echo 1;
            }
            else
            {
                echo 0;
            }
            return $this->redirect(['index']);
        }
        else {
            return $this->render('create', [
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
        $photoTemp = $model->photo;

        $imageModel = new ImageUpload();
        $imageModel->imageFile = UploadedFile::getInstance($model, 'photo');

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = date('Y-m-d H:i:s');
            if(isset($imageModel->imageFile))
                $model->photo = $imageModel->imageFile->baseName . '.' . $imageModel->imageFile->extension;
            else
                $model->photo = $photoTemp;
            if($model->save())
            {
                //Upload image
                if(isset($imageModel->imageFile)){
                    FileHelper::createDirectory('images/shops/'.$model->id);
                    $imageModel->upload($model->id,'images/shops/');
                }
                echo 1;
            }
            else
            {
                echo 0;
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
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
                if(!empty($selectedAreas)){
                     $shop = new Shops();
                     $shop = $shop->getShopById($id);
                     $deliveryCharge = $shop->getModels()[0]['delivery_charge'];
                    foreach($selectedAreas as $area){
                        $model = new ShopDeliveryAreas();
                        $model->area_id = $area;
                        $model->shop_id = $id;
                        $model->deleted = 0;
                        $model->delivery_charge = $deliveryCharge;
                        $model->created_at = date('Y-m-d H:i:s');
                        $model->updated_at = date('Y-m-d H:i:s');
                        $model->save();
                    }
                }
            }

            return $this->redirect(['index']);

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
        $shop = $this->findModel($id);
        $shop->updated_at = date('Y-m-d H:i:s');
        $shop->deleted = 1;
        $shop->is_avilable = '0';
        $shop->update(['updated_at','deleted','is_avilable']);
        $shop->save(false);
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

    public function actionMap($id)
    {
       $model = $this->findModel($id);
       
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $shops = $this->findModel($id);
            $shops->updated_at = date('Y-m-d H:i:s');
            $shops->latitude = $data['Shops']['latitude'];
            $shops->longitude= $data['Shops']['longitude'];
            $shops->update(['updated_at','latitude','longitude']);
            $model->save();
           // print_r($model->getErrors());
            //die();
            $deliveryAreas = array();
            if(!empty($shops->shopDeliveryAreas)){
                foreach ($shops->shopDeliveryAreas as $deliveryArea) {
                    array_push($deliveryAreas, Areas::find()->where(['id' => $deliveryArea->area_id])->one());
                }
            }
          
          return $this->render('viewWithMap', [
            'model' => $this->findModel($id),
            'deliveryAreas' => $deliveryAreas,
         ]);
        } else {
            return $this->render('mapUpdate', [
                'model' => $model,
            ]);
        }

    }
    public function actionVmap($id)
    {
       $model = $this->findModel($id);
          //die();
        $deliveryAreas = array();
        if(!empty($model->shopDeliveryAreas)){
            foreach ($model->shopDeliveryAreas as $deliveryArea) {
                array_push($deliveryAreas, Areas::find()->where(['id' => $deliveryArea->area_id])->one());
            }
         }
        
        return $this->render('viewWithMap', [
            'model' => $this->findModel($id),
            'deliveryAreas' => $deliveryAreas,
         ]);
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
}
