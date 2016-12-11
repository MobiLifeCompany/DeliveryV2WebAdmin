<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\User;
use backend\models\StatisticsDashboard;
use backend\models\MapDashboard;
use backend\models\Shops;
use backend\models\Orders;
use backend\models\Customers;
use backend\models\PushNotification;
use yii\data\ActiveDataProvider;





/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','language','gcm','gcmweb','checkorders','checktopmenuorders','push-notification'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' )
        {
            $statisticsDashboardModel = new MapDashboard();
            $currentOrdersForMapDashboard = $statisticsDashboardModel->getCurrentOrdersForMapDashboard();
            return $this->render('index',[
                'currentOrdersForMapDashboard'=>$currentOrdersForMapDashboard,
            ]);
        }else{
            return $this->render('index');
        }    
    }

    
    public function actionCheckorders(){
        $userShops = Yii::$app->session['userShops'];
        $openOrdersRestults = Orders::find()->where(['in','shop_id',$userShops])->andWhere(['or',
            ['order_status' => 'OPEN'],
            ['order_status' => 'RE-OPEN']])->all(); /* I remove the pending status, only open order should notify the user*/
        $data = "NO_DATA";
        if(!empty($openOrdersRestults)){
            $data ="";
            $count = 0;
            foreach ($openOrdersRestults as $order) {
              $data = $data. ' #'.$order->id;
              $count++;
            }
            $data = "You have ".$count." Open Orders (".$data.")";
            return $data;
        }else{
            return $data;
        }
        
    }

    public function actionChecktopmenuorders()
    {
        $openOrdersRestults = 0;
        $pendingOrdersRestults = 0;

        $statisticsDashboard =  new StatisticsDashboard();
        $result = $statisticsDashboard->getGeneralOrderCount();
        foreach ($result as $record){
            if($record['order_status']==='OPEN'){
                $openOrdersRestults = $record['countNum'];
            }else if($record['order_status']==='PENDING'){
                $pendingOrdersRestults = $record['countNum'];
            }
        }
        return $openOrdersRestults.'-'.$pendingOrdersRestults;
    }

    
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this->layout='loginLayout';

        Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
        
       

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = new User();
            $username = Yii::$app->request->post()['LoginForm']['username'];
            $realUser = $user->findByUsername(Yii::$app->request->post()['LoginForm']['username']);
            Yii::$app->session->set('realUser',$realUser);
            Yii::$app->session->set('userShops',$user->getUserShopsIds());
            if($realUser['user_type']=='SHOP_DELIVERY_MAN' || $realUser['user_type']=='CR_DELIVERY_MAN'){
                return $this->redirect('index.php?r=orders/workingorders');
                //return $this->goBack();
            }else {
               // return $this->redirect('index.php?r=dashboards/dashboard1');
                 return $this->redirect('index.php?r=orders/workingorders');
                // 
            }
            
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    
    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionLanguage()
        {
           if(isset($_POST['lang'])){
               Yii::$app->language = $_POST['lang'];
               $cookie = new \yii\web\Cookie([
                   'name' => 'lang',
                   'value' => $_POST['lang'],
               ]);
               Yii::$app->getResponse()->getCookies()->add($cookie);
               
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
                $this->redirect(['login']);
            } else {
                Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
                return true; 
            }
        } else {
            return true;
        }
    }

    public function actionPushNotification()
    {

        $model =  new PushNotification();
 
       if(!Yii::$app->user->can('show_push_notification') || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' )
        {
            throw new ForbiddenHttpException;
        }
        else
        {  
            $data = Yii::$app->request->post();
            if (array_key_exists('selection', $data)) {
                $selection = $data['selection'];
                foreach ($selection as $value) {
                    $value = substr($value ,4);
                    $pushNotification =  new PushNotification();
                    $pushNotification->sendPush($value,$data['PushNotification']['title'],$data['PushNotification']['message']);
                }
            Yii::$app->session->setFlash('success',Yii::t('app', 'NOTIFICATION_SUCCESS_MSG'));
        }else{
             Yii::$app->session->setFlash('error',Yii::t('app', 'NOTIFICATION_ERROR_MSG'));
        }
    }
        $query = Customers::find();
        $customers = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => Yii::$app->params['pageSize']),
        ]);

        return $this->render('push-notification',[
            'customers'=>$customers,
            'model' => $model,
        ]);
    }

}
