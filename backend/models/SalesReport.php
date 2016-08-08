<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
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
    public function search($params)
    {
        $query = Orders::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => Yii::$app->params['pageSize']),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }
       
        $shop_id_val = -1;
        $from_date_val=date('Y-m-d');
        $to_date_val = date('Y-m-d');
        $order_status='CLOSED';
        
        foreach ($params as $k => $v) {
            if($k=='SalesReport'){
                $shop_id_val = $params['SalesReport']['shop_id'];
                $from_date_val=$params['SalesReport']['from_date'];
                $to_date_val = $params['SalesReport']['to_date'];
                $order_status = $params['SalesReport']['order_status'];
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

         $query->andFilterWhere(['order_status'=> $order_status]);
     
         // print_r($query->createCommand()->getRawSql());
        //  print_r('----------');

        return $dataProvider;
    }
}
