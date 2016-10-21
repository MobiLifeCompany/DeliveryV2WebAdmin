<?php

namespace backend\controllers;

use Yii;
use backend\models\Items;
use backend\models\ItemsSearch;
use backend\models\ShopItemCategories;
use backend\models\Shops;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\ImageUpload;
use yii\web\UploadedFile;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\helpers\FileHelper;
use yii\helpers\ArrayHelper;
use yii\Helpers\Url;
use yii\web\ForbiddenHttpException;

/**
 * ItemsController implements the CRUD actions for Items model.
 */
class ItemsController extends Controller
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
     * Lists all Items models.
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
            $searchModel = new ItemsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Items model.
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
     * Displays a shop items.
     * @param integer $id
     * @return mixed
     */
    public function actionDetails($id)
    {
        $userShops = Yii::$app->session['userShops'];
        if(!in_array($id,$userShops))
        {
            throw new ForbiddenHttpException;
        }
        else
        {
            $items = new Items();
            $dataProvider = $items->getShopItems($id);
            $searchModel = new ItemsSearch();
            $shop = new Shops();
            $shopModel = $shop->getShopById($id);

            return $this->render('details', [
                'dataProvider' => $dataProvider,
                'shopModel' => $shopModel,
                'searchModel' => $searchModel,
            ]);
        }
    }

    /**
     * Creates a new Items model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Items();
        $shopItemCategory = new ShopItemCategories();

        $photoTemp = $model->photo;
        $imageModel = new ImageUpload();
        $imageModel->imageFile = UploadedFile::getInstance($model, 'photo');
        //
        if ($model->load(Yii::$app->request->post())) {
            $shopItemCategory = ShopItemCategories::findOne(['item_category_id'=> $model->item_category_id,'shop_id' =>$model->shop_id]);
            if(empty($shopItemCategory)) {
                //Insert into shop_item_categories first
                $shopItemCategory = new ShopItemCategories();
                $shopItemCategory->shop_id = $model->shop_id;
                $shopItemCategory->item_category_id = $model->item_category_id;
                $shopItemCategory->deleted = 0;
                $shopItemCategory->created_at = date('Y-m-d h:m:s');
                $shopItemCategory->updated_at = date('Y-m-d h:m:s');
                $shopItemCategory->save();
            }

            if(!empty($shopItemCategory))
            {
                $shopItemCategoryLastId = $shopItemCategory->id;
                $model->shop_item_category_id = $shopItemCategoryLastId;
                $model->created_at = date('Y-m-d h:m:s');
                $model->updated_at = date('Y-m-d h:m:s');

                if(isset($imageModel->imageFile))
                    $model->photo = $imageModel->imageFile->baseName . '.' . $imageModel->imageFile->extension;
                else
                    $model->photo = $photoTemp;

                if($model->save())
                {
                    $last_id = $model->id;
                    //Upload image
                    FileHelper::createDirectory('images/items/'. $last_id);
                    $imageModel->upload($last_id, 'images/items/');
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
             return $this->redirect(['index']);
        }
        else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Items model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->shop_id = ShopItemCategories::findOne($model->shop_item_category_id)->shop_id;
        $model->item_category_id = ShopItemCategories::findOne($model->shop_item_category_id)->item_category_id;

        $photoTemp = $model->photo;

        $imageModel = new ImageUpload();
        $imageModel->imageFile = UploadedFile::getInstance($model, 'photo');

        if ($model->load(Yii::$app->request->post())) {
            $shopItemCategory = ShopItemCategories::findOne($model->shop_item_category_id);
            $shopItemCategory->shop_id = $model->shop_id;
            $shopItemCategory->item_category_id = $model->item_category_id;
            $shopItemCategory->updated_at = date('Y-m-d h:m:s');
            if($shopItemCategory->save())
            {
                $model->updated_at = date('Y-m-d h:m:s');

                if(isset($imageModel->imageFile))
                    $model->photo = $imageModel->imageFile->baseName . '.' . $imageModel->imageFile->extension;
                else
                    $model->photo = $photoTemp;
                if($model->save())
                {
                    //Upload image
                    if(isset($imageModel->imageFile)){
                        FileHelper::createDirectory('images/items/'.$model->id);
                        $imageModel->upload($model->id,'images/items/');
                    }
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }

            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Items model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $item = $this->findModel($id);
        $item->updated_at = date('Y-m-d H:i:s');
        $item->deleted = 1;
        $item->active = 0;
        $item->update(['updated_at','deleted','active']);
        $item->save(false);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Items model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Items the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Items::findOne($id)) !== null) {
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
