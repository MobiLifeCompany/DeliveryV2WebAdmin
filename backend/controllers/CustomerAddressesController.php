<?php

namespace backend\controllers;

use Yii;
use backend\models\CustomerAddresses;
use backend\models\CustomerAddressesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;

/**
 * CustomerAddressesController implements the CRUD actions for CustomerAddresses model.
 */
class CustomerAddressesController extends Controller
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
     * Lists all CustomerAddresses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CustomerAddressesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CustomerAddresses model.
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
     * Creates a new CustomerAddresses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CustomerAddresses();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CustomerAddresses model.
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
     * Deletes an existing CustomerAddresses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $customerAddresses = $this->findModel($id);
        $customerAddresses->updated_at = date('Y-m-d h:m:s');
        $customerAddresses->deleted = 1;
        $customerAddresses->update(['updated_at','deleted']);
        return $this->redirect(['index']);
    }

    /**
     * Finds the CustomerAddresses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustomerAddresses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustomerAddresses::findOne($id)) !== null) {
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
        $model = $id===null ? new CustomerAddresses : CustomerAddresses::findOne($id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format='json';
            return ActiveForm::validate($model);
        }
    }

    public function actionDetails($id)
    {
        $customerAddresses = new CustomerAddresses();
        $dataProvider = $customerAddresses->getCustomerAddresses($id);
        $customer = $customerAddresses->getCustomerById($id);

        return $this->render('details', [
            'dataProvider' => $dataProvider,
            'customerModel' =>$customer,
        ]);
    }

    public function actionMap($id)
    {
       $model = $this->findModel($id);
       
        if ($model->load(Yii::$app->request->post())) {
            $data = Yii::$app->request->post();
            $customerAddresses = $this->findModel($id);
            $customerAddresses->updated_at = date('Y-m-d h:m:s');
            $customerAddresses->latitude = $data['CustomerAddresses']['latitude'];
            $customerAddresses->longitude= $data['CustomerAddresses']['longitude'];
            $customerAddresses->update(['updated_at','latitude','longitude']);
            $model->save();
           // print_r($model->getErrors());
            //die();
            return $this->render('viewWithMap', [
             'model' => $this->findModel($id),
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
       return $this->render('viewWithMap', [
             'model' => $this->findModel($id),
             ]);
    }


}
