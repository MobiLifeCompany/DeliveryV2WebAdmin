<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use backend\models\Report;

/**
 * AreasSearch represents the model behind the search form about `backend\models\Areas`.
 */
class SalesReport extends Report
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id'], 'integer'],
            [[ 'from_date','to_date','shop_id'], 'safe'],
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
    public function searchShops($params)
    {
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => 1000),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
       
        $shop_id_val = -1;
        $from_date_val=date('Y-m-d');
        $to_date_val = date('Y-m-d');
        $order_status='ALL';
        $delivery_user_id = -1;

        
        foreach ($params as $k => $v) {
            if($k=='SalesReport'){
                $shop_id_val = $params['SalesReport']['shop_id'];
                $from_date_val=$params['SalesReport']['from_date'];
                $to_date_val = $params['SalesReport']['to_date'];
                $order_status = $params['SalesReport']['order_status'];
                $delivery_user_id = $params['SalesReport']['delivery_user_id'];
                break;
            }
        }
          if($shop_id_val!=-1){
             if($from_date_val==$to_date_val){
                $query->andFilterWhere(['shop_id'=> $shop_id_val]);
                $query->andFilterWhere(['>=','created_at', $from_date_val]);
             }else{
                $query->andFilterWhere(['shop_id'=> $shop_id_val]);
                $query->andFilterWhere(['>=','created_at', $from_date_val]);
                $query->andFilterWhere(['<=','created_at', $to_date_val]);
             } 
         }else{
             $query->andFilterWhere(['>=','created_at', $from_date_val]);
         }

        if($delivery_user_id!=-1){
            $query->andFilterWhere(['delivery_user_id'=> $delivery_user_id]);
        }

        if($order_status!='ALL'){
            $query->andFilterWhere(['order_status'=> $order_status]);
        }

     
         // print_r($query->createCommand()->getRawSql());
        //  print_r('----------');

        return $dataProvider;
    }

    public function searchItems($params)
    {
         $shopStatment = "";
       // $shopStatment = "and shop_id = 2";

        

        $item_id_val = -1;
        $from_date_val=date('Y-m-d');
        $to_date_val = date('Y-m-d');
        $order_status='OPEN';

        $sqlStatment = "";

        
        foreach ($params as $k => $v) {
            if($k=='SalesReport'){
                $item_id_val = $params['SalesReport']['item_id'];
                $from_date_val=$params['SalesReport']['from_date'];
                $to_date_val = $params['SalesReport']['to_date'];
                $order_status = $params['SalesReport']['order_status'];
                break;
            }
        }

         if($item_id_val!=-1){
             if($from_date_val==$to_date_val){
                $sqlStatment = $sqlStatment." and `items`.`id` = '".$item_id_val."'";
                $sqlStatment = $sqlStatment." and `orders`.`created_at` '".$from_date_val."'";
             }else{
                $sqlStatment = $sqlStatment." and `items`.`id` = '".$item_id_val."'";
                $sqlStatment = $sqlStatment." and `orders`.`created_at` >= '".$from_date_val."'";
                $sqlStatment = $sqlStatment." and `orders`.`created_at` <= '".$to_date_val."'";
             } 
         }else{
             $sqlStatment = $sqlStatment." and `orders`.`created_at` >= '".$from_date_val."'";
         }

         $sqlStatment = $sqlStatment." and `orders`.`order_status` = '".$order_status."'";

        
        if(!Yii::$app->user->can('full_items_admin')){
            $shop_ids = "";
            $userShops = Yii::$app->session['userShops'];
                if(!empty($userShops)){
                    $shop_ids = " and shop_item_categories.shop_id in (";
                    foreach ($userShops as $var) {
                        $shop_ids =$shop_ids.$var.',';
                    }
                    $shop_ids =$shop_ids .'-1) ';
                }
            $sqlStatment = $sqlStatment.$shop_ids;
        }
        
         $query =  "SELECT `orders`.id,`orders`.order_status,`item_categories`.`name` category_name,`items`.`name` item_name,`order_items`.`qty`, `items`.`price`,(`order_items`.`qty`* `items`.`price`) total, `orders`.`created_at` 
                    FROM `orders`, `order_items`, `items`, `item_categories` , `shop_item_categories`
                    where `orders`.`id` = `order_items`.`order_id`
                    and `order_items`.`item_id` = `items`.`id`
                    and `items`.`shop_item_category_id` = `shop_item_categories`.`id`
                    and  `shop_item_categories`.`item_category_id` = `item_categories`.`id` ".$sqlStatment ;

        $count=Yii::$app->db->createCommand($query)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 1000,
                ],
            ]);
        
        return $dataProvider;
    }
}
