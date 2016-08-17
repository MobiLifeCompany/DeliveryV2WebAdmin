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
class TopTenDashboard 
{

    

    public function getTopTenItemsAmount(){
        
        $shopStatment = "";
       // $shopStatment = "and shop_id = 2";
        
        $query =  "SELECT sum(total) total,name item_name 
                    FROM `order_items`, `items`  
                    WHERE items.id = item_id 
                    and  date(`order_items`.created_at) = CURDATE()
                    group by name
                    order by 1 DESC
                    limit 10";

        $count=Yii::$app->db->createCommand($query)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 0,
                ],
            ]);
        
        return $dataProvider;

    }

     public function getTopTenShopsAmount(){
        
        $shopStatment = "";
       // $shopStatment = "and shop_id = 2";
        
        $query =  "SELECT sum(total) total,`shops`.name shop_name 
                    FROM `orders`, `shops` 
                    WHERE shop_id = `shops`.`id`
                    and date(`orders`.created_at) = CURDATE()
                    group by `shops`.name
                    order by 1 DESC
                    LIMIT 10";

        $count=Yii::$app->db->createCommand($query)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 0,
                ],
            ]);
        
        return $dataProvider;

    }

    public function getTopTenCustomersAmount(){
        
        $shopStatment = "";
       // $shopStatment = "and shop_id = 2";
        
        $query =  "SELECT sum(total) total,`customers`.`full_name` customer_name 
                    FROM `orders`, `customers`
                    WHERE customer_id = `customers`.`id`
                    and date(`orders`.created_at) = CURDATE()
                    group by `customers`.full_name
                    order by 1 DESC
                    LIMIT 10";

        $count=Yii::$app->db->createCommand($query)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 0,
                ],
            ]);
        
        return $dataProvider;

    }

    public function getTopTenMonthDaysAmount(){
        
        $shopStatment = "";
       // $shopStatment = "and shop_id = 2";
        
        $query =  "SELECT sum(total) total,concat(EXTRACT(DAY FROM `created_at`),'-',EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)) monthDate FROM `orders`
                    WHERE EXTRACT(MONTH FROM `created_at`) = date_format(now(), '%m')
                    and EXTRACT(YEAR FROM `created_at`) = date_format(now(), '%Y')
                    group by concat(EXTRACT(DAY FROM `created_at`),'-',EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`))
                    order by 1 DESC
                    LIMIT 10";

        $count=Yii::$app->db->createCommand($query)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 0,
                ],
            ]);
        
        return $dataProvider;

    }

    public function getTopTenMonthlyAmount(){
        
        $shopStatment = "";
       // $shopStatment = "and shop_id = 2";
        
        $query =  "SELECT sum(total) total,concat(EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`)) month 
                    FROM `orders` WHERE  EXTRACT(YEAR FROM `created_at`) = date_format(now(), '%Y') 
                    group by concat(EXTRACT(MONTH FROM `created_at`),'-', EXTRACT(YEAR FROM `created_at`))               
                    order by 1 DESC 
                    LIMIT 10";

        $count=Yii::$app->db->createCommand($query)->queryScalar();
        $dataProvider = new SqlDataProvider([
            'sql' => $query,
            'totalCount'=>$count,
            'pagination' => [
                'pageSize' => 0,
                ],
            ]);
        
        return $dataProvider;

    }

   
}
