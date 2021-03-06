<?php

namespace backend\controllers;

use Yii;
use backend\models\StatisticsDashboard;
use backend\models\MapOrder;
use backend\models\MapDashboard;
use backend\models\TopTenDashboard;
use backend\models\Orders;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class DashboardsController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
public function actionDashboard1()
{

    if(!Yii::$app->user->can('show_dashboard1') && Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN')
     {
        return $this->redirect('index.php?r=orders');
     }
    else if(!Yii::$app->user->can('show_dashboard1') || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' )
     {
         throw new ForbiddenHttpException;
     }
     else
     {  
        $statisticsDashboardModel = new StatisticsDashboard();
        $latestOrderdataProvider = $statisticsDashboardModel->getLatestOrders();
        $latestItemsdataProvider = $statisticsDashboardModel->getRecentlyAddedProducts();
        $lastDeliveryManOrdersStatus = $statisticsDashboardModel->getDeliveryManOrdersStatus();
        $dailyAmountSeries = $statisticsDashboardModel->getDailyAmountSeries();
        $monthlyAmountSeries = $statisticsDashboardModel->getMonthlyAmountSeries();
        $dailyItemsAmountSeries = $statisticsDashboardModel->getDailyItemsAmountSeries();
        $monthlyOrdersCount = $statisticsDashboardModel->getMonthlyOrderCount();
        $dailyOrdersCount = $statisticsDashboardModel->getDailyOrderCount();

        return $this->render('dashboard1', [
            'latestOrderdataProvider' => $latestOrderdataProvider,
            'latestItemsdataProvider' => $latestItemsdataProvider,
            'lastDeliveryManOrdersStatus' => $lastDeliveryManOrdersStatus,
            'dailyAmountSeries' => $dailyAmountSeries,
            'monthlyAmountSeries' =>$monthlyAmountSeries,
            'dailyItemsAmountSeries' => $dailyItemsAmountSeries,
            'monthlyOrdersCount' =>$monthlyOrdersCount,
            'dailyOrdersCount' =>$dailyOrdersCount,

        ]);
    }
}

    public function actionDashboard2()
    {
       if(!Yii::$app->user->can('show_dashboard2') || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' )
        {
            throw new ForbiddenHttpException;
        }
        else
        {  
            $statisticsDashboardModel = new MapDashboard();
            $currentOrdersForMapDashboard = $statisticsDashboardModel->getCurrentOrdersForMapDashboard();

            $data = Yii::$app->request->post();
            if (array_key_exists('selection', $data)) {
                    $selection = $data['selection'];
                    foreach ($selection as $value) {
                        $value = substr($value ,4);
                        $order = Orders::find()->where(['id' => $value])->one();
                        $order->show_on_map = 1;
                        $order->updated_at = date('Y-m-d H:i:s');
                        $order->update(['updated_at','show_on_map']);
                        $order->save();
                    }

                    $model = $currentOrdersForMapDashboard->getModels();
                    foreach ($model as  $modelValue) {
                        if($modelValue['show_on_map'] ==1 && !in_array('chk_'.$modelValue['order_id'], $selection)){
                                $order = Orders::find()->where(['id' => $modelValue['order_id']])->one();
                                $order->show_on_map = 0;
                                $order->updated_at = date('Y-m-d H:i:s');
                                $order->update(['updated_at','show_on_map']);
                                $order->save();
                        }
                }
            }
        }

        $currentOrdersForMapDashboard = $statisticsDashboardModel->getCurrentOrdersForMapDashboard();
        return $this->render('dashboard2',[
            'currentOrdersForMapDashboard'=>$currentOrdersForMapDashboard,
        ]);

    }

    public function actionDashboard3()
    {
        if(!Yii::$app->user->can('show_dashboard3') || Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' )
        {
            throw new ForbiddenHttpException;
        }
        else
        {  
            $topTenDashboard = new TopTenDashboard();

            $topTenItemsAmount = $topTenDashboard->getTopTenItemsAmount();
            $topTenShopsAmount = $topTenDashboard->getTopTenShopsAmount();
            $topTenCustomersAmount = $topTenDashboard->getTopTenCustomersAmount();
            $topTenMonthDaysAmount = $topTenDashboard->getTopTenMonthDaysAmount();
            $topTenMonthlyAmount = $topTenDashboard->getTopTenMonthlyAmount();
            

            return $this->render('dashboard3',[
                'topTenItemsAmount' =>$topTenItemsAmount,
                'topTenShopsAmount' =>$topTenShopsAmount,
                'topTenCustomersAmount'=>$topTenCustomersAmount,
                'topTenMonthDaysAmount' =>$topTenMonthDaysAmount,
                'topTenMonthlyAmount' =>$topTenMonthlyAmount,
            ]);
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
