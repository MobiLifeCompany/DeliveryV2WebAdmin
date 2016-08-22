<?php

namespace backend\controllers;

use Yii;
use backend\models\ItemCategories;
use backend\models\ItemCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ImageUpload;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;
/**
 * ItemCategoriesController implements the CRUD actions for ItemCategories model.
 */
class ItemCategoriesController extends Controller
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
     * Lists all ItemCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!Yii::$app->session['realUser']['user_type']=='CR_ADMIN')
         {
              throw new ForbiddenHttpException;
         }
         else 
         {
            $searchModel = new ItemCategoriesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
         }
    }

    /**
     * Displays a single ItemCategories model.
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
     * Creates a new ItemCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ItemCategories();
        $imageModel = new ImageUpload();
        $imageModel->imageFile = UploadedFile::getInstance($model, 'photo');
     //   print_r($_POST);
     //  die();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->created_at = date('Y-m-d H:i:s');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->photo = $imageModel->imageFile->baseName . '.' . $imageModel->imageFile->extension;
            if($model->save())
            {
                $last_id = $model->id;
                //Upload image
                FileHelper::createDirectory('images/categories/'. $last_id);
                $imageModel->upload($last_id,'images/categories/');
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
     * Updates an existing ItemCategories model.
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
            echo $model->photo;
            if(isset($imageModel->imageFile))
                $model->photo = $imageModel->imageFile->baseName . '.' . $imageModel->imageFile->extension;
            else
                $model->photo = $photoTemp;
            if($model->save())
            {
                //Upload image
                if(isset($imageModel->imageFile)){
                    FileHelper::createDirectory('images/categories/'.$model->id);
                    $imageModel->upload($model->id,'images/categories/');
                }
                echo 1;
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
     * Deletes an existing ItemCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->updated_at = date('Y-m-d H:i:s');
        $model->deleted = 1;
        $model->update(['updated_at','deleted']);
        $model->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the ItemCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ItemCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ItemCategories::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

     // Ajax Validation 
    public function actionValidation($id = null){
        $model = $id===null ? new ItemCategories : ItemCategories::findOne($id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format='json';
            return ActiveForm::validate($model);
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
