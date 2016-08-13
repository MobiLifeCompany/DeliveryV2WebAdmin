<?php

namespace backend\controllers;

use Yii;
use backend\models\StatisticsDashboard;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;

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

    public function actionDashboard2()
    {
    
        return $this->render('dashboard2');
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
