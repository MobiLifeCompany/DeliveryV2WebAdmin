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
                        'actions' => ['login', 'error','language'],
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
                return $this->goBack();
            }else {
                return $this->redirect('index.php?r=dashboards/dashboard1');
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
               $cookie = new yii\web\Cookie([
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
}
