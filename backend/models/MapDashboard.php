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
        
        $shopStatment = "";
       // $shopStatment = "and shop_id = 2";
        
        $connection = Yii::$app->getDb();
        $query = "SELECT `orders`.`id` order_id,`orders`.`order_status`,`orders`.show_on_map,`user`.`username` delivery_user , `shops`.id shop_id, `shops`.`name` shop_name,`shops`.`longitude` shop_longitude, `shops`.`latitude` shop_latitude, `customers`.id customer_id,                                                               `customers`.`full_name`customer_fullname,`customer_addresses`.`id` customer_address_id, concat('[',`cities`.`name`,' - ',`areas`.`name`,' - ',`customer_addresses`.`street`,' - ',
                                                `customer_addresses`.`building`,' - ', `customer_addresses`.`floor`,']') customer_address , `customer_addresses`.`longitude` customer_addresses_longitude, `customer_addresses`.`latitude` customer_addresses_latitude, `user`.id user_id,`user`.username FROM `orders` LEFT OUTER JOIN `user` on (`user`.`id` = `orders`.`delivery_user_id`), `customers`, `shops`, `customer_addresses`, `cities`, `areas`
                                                where `orders`.`customer_id` = `customers`.`id`
                                                and   `orders`.`shop_id` = `shops`.`id`
                                                and   `orders`.`customer_address_id` = `customer_addresses`.`id`
                                                and   `customer_addresses`.`city_id` = `cities`.`id`
                                                and   `customer_addresses`.`area_id` = `areas`.`id`
                                                and   `orders`.`order_status` in ('OPEN', 'RE-OPEN', 'PENDING')";

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