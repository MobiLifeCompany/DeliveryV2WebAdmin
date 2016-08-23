<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Report;
use yii\helpers\ArrayHelper;
use backend\models\UserShops;


/**
 * AreasSearch represents the model behind the search form about `backend\models\Areas`.
 */
class StatisticsDashboard extends Report
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id'], 'integer'],
            [[ 'shop_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function getLatestOrders()
    {
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 7),
        ]);
       
         $userShops = Yii::$app->session['userShops'];

         $query->andFilterWhere(['in','shop_id', $userShops]);
         $query->orderBy('id DESC');
         //$query->limit(7);
     
         // print_r($query->createCommand()->getRawSql());
        //  print_r('----------');

        return $dataProvider;
    }

    public function getRecentlyAddedProducts(){

        $query = Items::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 4),
        ]);
       
         $userShops = Yii::$app->session['userShops'];
        
         $query->joinWith('shopItemCategory');

         $query->andFilterWhere(['in','shop_id', $userShops]);
         $query->orderBy('id DESC');

        return $dataProvider;

    }

    public function getDeliveryManOrdersStatus(){

        $shopStatment = "";
        $userShops = Yii::$app->session['userShops'];
        $shop_ids = "";
        if(!empty($userShops)){
            $shop_ids = " and orders.shop_id in (";
            foreach ($userShops as $var) {
                $shop_ids =$shop_ids.$var.',';
            }
            $shop_ids =$shop_ids .'-1) ';
            $shopStatment = $shopStatment.$shop_ids;
        }

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT count(*) as countNum,username,photo,order_status FROM `orders`, user WHERE user.id = `delivery_user_id` ".$shopStatment." group by username,photo,order_status");
        $result = $command->queryAll();
        
        return $result;

    }

     public function getDailyAmountSeries(){

        $shopStatment = "";
        $userShops = Yii::$app->session['userShops'];
        $shop_ids = "";
        if(!empty($userShops)){
            $shop_ids = " and shop_id in (";
            foreach ($userShops as $var) {
                $shop_ids =$shop_ids.$var.',';
            }
            $shop_ids =$shop_ids .'-1) ';
            $shopStatment = $shopStatment.$shop_ids;
        }

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT concat(EXTRACT(day FROM `created_at`),'-',EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)) monthDate,sum(total) sumTotal FROM orders 
                                              where EXTRACT(MONTH FROM `created_at`) = date_format(now(), '%m')-2 ".$shopStatment."
                                              group by concat(EXTRACT(day FROM `created_at`),'-',EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)) order by created_at");
        $result = $command->queryAll();
        
        return $result;

    }

    public function getMonthlyAmountSeries(){

        $shopStatment = "";
        $userShops = Yii::$app->session['userShops'];
        $shop_ids = "";
        if(!empty($userShops)){
            $shop_ids = " and shop_id in (";
            foreach ($userShops as $var) {
                $shop_ids =$shop_ids.$var.',';
            }
            $shop_ids =$shop_ids .'-1) ';
            $shopStatment = $shopStatment.$shop_ids;
        }

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand(" SELECT concat(EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)) monthDate,sum(total) sumTotal,sum(qty) sumQty 
                                                FROM orders where EXTRACT(YEAR FROM `created_at`) = date_format(now(), '%Y')".$shopStatment.
                                                "group by concat(EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)) order by created_at");
        $result = $command->queryAll();
        
        return $result;

    }

    public function getDailyItemsAmountSeries(){
        
        $shopStatment = "";

        $userShops = Yii::$app->session['userShops'];
        $shop_ids = "";
        if(!empty($userShops)){
            $shop_ids = " and orders.shop_id in (";
            foreach ($userShops as $var) {
                $shop_ids =$shop_ids.$var.',';
            }
            $shop_ids =$shop_ids .'-1) ';
            $shopStatment = $shopStatment.$shop_ids;
        }
        
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT sum(order_items.total) sumTotal,name,ar_name FROM `order_items`, items, orders 
                                                WHERE orders.id = order_items.order_id 
                                                and items.id = item_id ".$shopStatment."
                                                and date(order_items.created_at) = CURDATE() 
                                                group by name,ar_name");
        $result = $command->queryAll();
        
        return $result;

    }

    public function getMonthlyOrderCount(){
        
        $shopStatment = "";
        $userShops = Yii::$app->session['userShops'];
        $shop_ids = "";
        if(!empty($userShops)){
            $shop_ids = " and shop_id in (";
            foreach ($userShops as $var) {
                $shop_ids =$shop_ids.$var.',';
            }
            $shop_ids =$shop_ids .'-1) ';
            $shopStatment = $shopStatment.$shop_ids;
        }
        
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT concat(EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)) monthDate,order_status,count(*) countNum ,sum(total) sumNum FROM orders 
                                               where EXTRACT(MONTH FROM `created_at`) = date_format(now(), '%m') 
                                               ".$shopStatment." group by concat(EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)),order_status");
        $result = $command->queryAll();
        
        return $result;

    }

    public function getDailyOrderCount(){
        
        $shopStatment = "";

        $userShops = Yii::$app->session['userShops'];
        $shop_ids = "";
        if(!empty($userShops)){
            $shop_ids = " and shop_id in (";
            foreach ($userShops as $var) {
                $shop_ids =$shop_ids.$var.',';
            }
            $shop_ids =$shop_ids .'-1) ';
            $shopStatment = $shopStatment.$shop_ids;
        }
        
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT concat(EXTRACT(DAY FROM `created_at`),'-',EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)) monthDate,order_status,count(*) countNum,sum(total) sumNum  FROM orders
                                                where date(created_at) = CURDATE() ".$shopStatment."
                                                group by concat(EXTRACT(DAY FROM `created_at`),'-',EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)),order_status");
        $result = $command->queryAll();
        
        return $result;

    }

    public function getGeneralOrderCount(){
        
        $queryStatment = " where 1=1 ";

        $userShops = Yii::$app->session['userShops'];
        $shop_ids = "";
        if(!empty($userShops)){
            $shop_ids = " and shop_id in (";
            foreach ($userShops as $var) {
                $shop_ids =$shop_ids.$var.',';
            }
            $shop_ids =$shop_ids .'-1) ';
        }
        
        if(Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ){
            $queryStatment = $queryStatment.' and delivery_user_id = '.Yii::$app->session['realUser']['id'];
            $queryStatment = $queryStatment.' and shop_id = '.Yii::$app->session['realUser']['shop_id'];
        }else if(Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN'){
            $queryStatment = $queryStatment.' and delivery_user_id = '.Yii::$app->session['realUser']['id'];
            $queryStatment = $queryStatment.$shop_ids;
        }if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN'){
            $queryStatment = $queryStatment.$shop_ids;
        }

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT order_status,count(*) countNum  FROM orders ".$queryStatment." group by order_status");
        $result = $command->queryAll();
        
        return $result;

    }
    
    
   
}
