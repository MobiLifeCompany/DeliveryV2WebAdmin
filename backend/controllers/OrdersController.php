<?php

namespace backend\controllers;

use Yii;
use backend\models\OrderItems;
use backend\models\Orders;
use backend\models\OrdersSearch;
use backend\models\Customers;
use backend\models\Shops;
use backend\models\PushNotification;
use backend\models\EmailModel;
use backend\models\OrderHistories;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\ForbiddenHttpException;
use backend\models\WorkingOrders;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
             'access' =>[
                'class' => AccessControl::className(),
                'only' => ['index','update','create','delete','view','details','workingorders'],
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
     * Lists all Orders models.
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
            $searchModel = new OrdersSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Orders model.
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
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $previousStatus =  $model->order_status;

        if ($model->load(Yii::$app->request->post())) {

            $model->updated_at= date('Y-m-d H:i:s');

            $userId = Yii::$app->session['realUser']['id'];
            $orderHistories = new OrderHistories();
            $orderHistories->user_id = $userId;
            $orderHistories->order_id = $id;
            $orderHistories->order_status=$previousStatus;
            $orderHistories->created_at = date('Y-m-d H:i:s');
            $orderHistories->updated_at = date('Y-m-d H:i:s');
            $orderHistories->save();

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
     * Deletes an existing Orders model.
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
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne($id)) !== null) {
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
        $model = $id===null ? new Orders : Orders::findOne($id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()))
        {
            Yii::$app->response->format='json';
            return ActiveForm::validate($model);
        }
    }

    public function actionDetails($id)
    {
        $orders = new Orders();
        $dataProvider = $orders->getOrdersByCustomerId(Yii::$app->request->queryParams);
        $customer = $orders->getCustomerById(Yii::$app->request->queryParams);

        return $this->render('details', [
            'dataProvider' => $dataProvider,
            'customerModel' =>$customer,
        ]);
    }

    public function actionWorkingorders()
    {
        $workingOrdersModel = new WorkingOrders();
        $workingOrdersDataProvider = $workingOrdersModel->getWorkingOrders();
        return $this->render('workingorders',[
            'workingOrdersDataProvider' => $workingOrdersDataProvider,
        ]);
    }

    public function actionSetdelivery($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $data = Yii::$app->request->post();
            $model->updated_at = date('Y-m-d H:i:s');
            $model->delivery_user_id = $data['Orders']['delivery_user_id'];
            $model->update(['updated_at','delivery_user_id','cancel_reason']);
            if($model->save(false))
            {
                echo 1;
            }else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('updateDeliveryUser', [
                'model' => $model,
            ]);
        }
    }

    public function actionSetorderstatus($id)
    {
        $model = $this->findModel($id);
        $previousStatus =  $model->order_status;

        if ($model->load(Yii::$app->request->post())) {

            $data = Yii::$app->request->post();
            $model->updated_at = date('Y-m-d H:i:s');
            $model->order_status = $data['Orders']['order_status'];
            $order_status = $model->order_status;
            $cancel_reason = $model->cancel_reason;
            $model->update(['updated_at','order_status','cancel_reason']);
            if($model->save(false))
            {
                $userId = Yii::$app->session['realUser']['id'];
                $orderHistories = new OrderHistories();
                $orderHistories->user_id = $userId;
                $orderHistories->order_id = $id;
                $orderHistories->order_status=$previousStatus;
                $orderHistories->created_at = date('Y-m-d H:i:s');
                $orderHistories->updated_at = date('Y-m-d H:i:s');
                $orderHistories->save();

                $title = Yii::t('app', 'DELIVERY_EXPRESS');
                $message = "";
                $customer = Customers::findOne($model->customer_id);
                $gcm_id = $customer->gcm_id;
                $lang = $customer->lang;
                $customerEmail = $customer->email;

                $shop = Shops::findOne($model->shop_id);
                $shop_email = $shop->email;
                $shop_enable_email_notification = $shop->enable_email_notification;
                
                if($lang=='ar'){
                    $message = "تم تحديث الطلبية ذات الرقم #".$id." لتصبح بحالة  ".Yii::t('app', $model->order_status,[],'ar');
                }else{
                    $message = "Your Order #".$id." changed and became with new status ".$model->order_status;
                }

                if($order_status=='CANCEL' && $lang=='ar')
                {
                     $message = $message.' للسبب التالي '.$cancel_reason;
                }
                else if($order_status=='CANCEL' && $lang=='en' )
                {
                     $message = $message.' ,for the following reason: '.$cancel_reason;
                }

                $pushNotification = new PushNotification();
                $pushNotification->sendPush($gcm_id,$title,$message);
               
               if(!empty($shop_email) && $shop_enable_email_notification=='Yes')
                {
                    $emailModel = new EmailModel();
                    $emailModel->fromEmail = Yii::$app->params['company_email'];
                    $emailModel->receiverEmail = $shop_email;
                    $emailModel->subject = "Delivery Express";
                    $emailModel->content = $message;
                    print_r($emailModel);

                    $value = Yii::$app->mailer->compose()
                    ->setFrom( [$emailModel->fromEmail => 'Delivery Express'])
                    ->setTo( $emailModel->receiverEmail) 
                    ->setSubject( $emailModel->subject) 
                    ->setHtmlBody( $emailModel->content)  
                    ->send();
                }

                if(!empty($customerEmail) && $shop_enable_email_notification=='Yes')
                {
                    $emailModel = new EmailModel();
                    $emailModel->fromEmail = Yii::$app->params['company_email'];
                    $emailModel->receiverEmail = $customerEmail;
                    $emailModel->subject = "Delivery Express";
                    $emailModel->content = $message;
                    print_r($emailModel);

                    $value = Yii::$app->mailer->compose()
                    ->setFrom( [$emailModel->fromEmail => 'Delivery Express'])
                    ->setTo( $emailModel->receiverEmail) 
                    ->setSubject( $emailModel->subject) 
                    ->setHtmlBody( $emailModel->content)  
                    ->send();
                }

                echo 1;
            }else
            {
                echo 0;
            }
        } else {
            return $this->renderAjax('updateOrderStatus', [
                'model' => $model,
            ]);
        }
    }

    public function actionSetworkingorderstatus()
    {
        $data = Yii::$app->request->post();
        $id = $data['id'];
        $status = $data['status'];
        $ready_time =  $data['item_in_m'];
        $model = $this->findModel($id);
        $previousStatus =  $model->order_status;


            $model->updated_at = date('Y-m-d H:i:s');
            $model->order_status = $status;
            $model->ready_time = $ready_time;
            $order_status = $model->order_status;
            $cancel_reason = $model->cancel_reason;
            $model->update(['updated_at','order_status','cancel_reason']);
            if($model->save(false))
            {
                $userId = Yii::$app->session['realUser']['id'];
                $orderHistories = new OrderHistories();
                $orderHistories->user_id = $userId;
                $orderHistories->order_id = $id;
                $orderHistories->order_status=$previousStatus;
                $orderHistories->created_at = date('Y-m-d H:i:s');
                $orderHistories->updated_at = date('Y-m-d H:i:s');
                $orderHistories->save();

                $title = Yii::t('app', 'DELIVERY_EXPRESS');
                $message = "";
                $customer = Customers::findOne($model->customer_id);
                $gcm_id = $customer->gcm_id;
                $lang = $customer->lang;
                if($lang=='ar'){
                    $message = "تم تحديث الطلبية ذات الرقم #".$id." لتصبح بحالة  ".Yii::t('app', $model->order_status,[],'ar');
                }else{
                    $message = "Your Order #".$id." changed and became with new status ".$model->order_status;
                }

                if($order_status=='CANCEL' && $lang=='ar')
                {
                    $message = $message.' للسبب التالي '.$cancel_reason;
                }
                else if($order_status=='CANCEL' && $lang=='en' )
                {
                    $message = $message.' ,for the following reason: '.$cancel_reason;
                }

                if($order_status=='PENDING' && $lang=='ar')
                {
                    $message = $message.'والوقت المتوقع للتحضير هو :'.$ready_time;
                }
                else if($order_status=='PENDING' && $lang=='en' )
                {
                    $message = $message.' ,and the estimated time to prepare order is: '.$ready_time;
                }

                $pushNotification = new PushNotification();
                $pushNotification->sendPush($gcm_id,$title,$message);

                echo 'ok';
            }else
            {
                echo 'not ok';
            }
        }

}
