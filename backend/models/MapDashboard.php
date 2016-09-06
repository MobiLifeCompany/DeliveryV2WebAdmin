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
class MapDashboard 
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

    public function getCurrentOrdersForMapDashboard(){
        
        $queryStatment = "";
       // $shopStatment = "and shop_id = 2";
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
        $query = "SELECT `orders`.`id` order_id,`orders`.`order_status`,`orders`.show_on_map,`user`.`username` delivery_user , `shops`.id shop_id,`shops`.subscribed_in_delivery subscribed_in_delivery, `shops`.`name` shop_name,`shops`.`longitude` shop_longitude, `shops`.`latitude` shop_latitude, `customers`.id customer_id,                                                               `customers`.`full_name`customer_fullname,`customer_addresses`.`id` customer_address_id, concat('[',`cities`.`name`,' - ',`areas`.`name`,' - ',`customer_addresses`.`street`,' - ',
                                                `customer_addresses`.`building`,' - ', `customer_addresses`.`floor`,']') customer_address , `customer_addresses`.`longitude` customer_addresses_longitude, `customer_addresses`.`latitude` customer_addresses_latitude, `user`.id user_id,`user`.username,`user`.`longitude` user_longitude, `user`.`latitude` user_latitude FROM `orders` LEFT OUTER JOIN `user` on (`user`.`id` = `orders`.`delivery_user_id`), `customers`, `shops`, `customer_addresses`, `cities`, `areas`
                                                where `orders`.`customer_id` = `customers`.`id`
                                                and   `orders`.`shop_id` = `shops`.`id`
                                                and   `orders`.`customer_address_id` = `customer_addresses`.`id`
                                                and   `customer_addresses`.`city_id` = `cities`.`id`
                                                and   `customer_addresses`.`area_id` = `areas`.`id`
                                                and   `orders`.`order_status` in ('OPEN', 'RE-OPEN', 'PENDING') ".$queryStatment;

                              

        $count=Yii::$app->db->createCommand($query)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 100,
                ],
            ]);

      
        return $dataProvider;


    }

   
}
