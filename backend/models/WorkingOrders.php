<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MapOrder;
use yii\helpers\ArrayHelper;
use yii\data\SqlDataProvider;

/**
 * AreasSearch represents the model behind the search form about `backend\models\Areas`.
 */
class WorkingOrders
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['order_id'], 'safe'],
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

    public function getWorkingOrders(){
        
        $queryStatment = "";
        if(Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' )
        {
            $queryStatment = " and (`orders`.`delivery_user_id` = '".Yii::$app->session['realUser']['id']."' || `orders`.`delivery_user_id` is null) ";
        }else{
            $shopStatment = "";
            $userShops = Yii::$app->session['userShops'];

            $shop_ids = "";
            if(!empty($userShops)){
                $shop_ids = " and orders.shop_id in (";
                foreach ($userShops as $var) {
                    $shop_ids =$shop_ids.$var.',';
                }
                $shop_ids =$shop_ids .'-1) ';
                $queryStatment = $queryStatment.$shop_ids;
            }                 
        }
        
        $connection = Yii::$app->getDb();
        $query = "SELECT `orders`.`id` order_id,`orders`.`note` order_note,`orders`.ready_time ready_time,`orders`.`created_at` order_date,`orders`.`order_status`,`orders`.total,`orders`.delivery_charge,`orders`.qty,`user`.`username` delivery_user , `shops`.id shop_id,`shops`.subscribed_in_delivery subscribed_in_delivery, `shops`.`name` shop_name,`shops`.`ar_name` ar_shop_name, `customers`.id customer_id,`customers`.full_name customer_full_name,
                                                `customer_addresses`.`id` customer_address_id, `cities`.`name` city_name ,`cities`.`ar_name` ar_city_name,`areas`.`name` area_name,`areas`.`ar_name` ar_area_name, concat(`customer_addresses`.`street`,' - ',
                                                `customer_addresses`.`building`,' - ', `customer_addresses`.`floor`) customer_address , `customer_addresses`.`phone` customer_phone, `user`.id user_id,`user`.username,
                                                `items`.name item_name,`order_items`.qty order_item_qty , `order_items`.item_price order_items_price ,`order_items`.total order_items_total
                                                FROM `orders` LEFT OUTER JOIN `user` on (`user`.`id` = `orders`.`delivery_user_id`), `customers`, `shops`, `customer_addresses`, `cities`, `areas`,  `order_items`,`items`
                                                where `orders`.`customer_id` = `customers`.`id`
                                                and   `orders`.`shop_id` = `shops`.`id`
                                                and   `orders`.`customer_address_id` = `customer_addresses`.`id`
                                                and   `customer_addresses`.`city_id` = `cities`.`id`
                                                and   `customer_addresses`.`area_id` = `areas`.`id`
                                                and   `orders`.id = `order_items`.order_id
                                                and   `order_items`.item_id = `items`.id
                                                and   `orders`.`order_status` not in ('CLOSED', 'CANCEL') ".$queryStatment." order by order_id desc";



        $count=Yii::$app->db->createCommand($query)->queryScalar();
      // print_r(Yii::$app->db->createCommand($query)->getRawSql());
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
