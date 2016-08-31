<?php

namespace backend\controllers;

use Yii;
use backend\models\ShopOffers;
use backend\models\ShopOffersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ImageUpload;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\web\ForbiddenHttpException;
/**
 * ShopOffersController implements the CRUD actions for ShopOffers model.
 */
class ShopOffersController extends Controller
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
     * Lists all ShopOffers models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
        {
            throw new ForbiddenHttpException;
        }else
        {
            $searchModel = new ShopOffersSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single ShopOffers model.
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
     * Creates a new ShopOffers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ShopOffers();
        $imageModel = new ImageUpload();
        $imageModel->imageFile = UploadedFile::getInstance($model, 'photo');

        if ($model->load(Yii::$app->request->post())) {
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->photo = $imageModel->imageFile->baseName . '.' . $imageModel->imageFile->extension;
            if($model->save())
            {
                $last_id = $model->id;
                //Upload image
                FileHelper::createDirectory('images/offers/'. $last_id);
                $imageModel->upload($last_id, 'images/offers/');
                echo 1;
            }
            else
            {
                echo 0;
            }

            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ShopOffers model.
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
                    FileHelper::createDirectory('images/offers/'.$model->id);
                    $imageModel->upload($model->id,'images/offers/');
                }
                echo ss1;
            }
            else
            {
                echo 0;
            }
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ShopOffers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = date('Y-m-d H:i:s');
        $model->active = 1;
        $model->update(['updated_at','deleted']);
        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the ShopOffers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ShopOffers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ShopOffers::findOne($id)) !== null) {
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
}
