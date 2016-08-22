<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\OrderItems;

/**
 * OrderItemsSearch represents the model behind the search form about `backend\models\OrderItems`.
 */
class OrderItemsSearch extends OrderItems
{
    /**
     * @inheritdoc
     */
    public $orderItemsGlobalSearch; 

    public function rules()
    {
        return [
            [['id', 'order_id', 'item_id', 'qty', 'item_price', 'is_canceled'], 'integer'],
            [['total', 'created_at', 'updated_at','orderItemsGlobalSearch','item_id'], 'safe'],
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
        $query = OrderItems::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => Yii::$app->params['pageSize']),
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('item');

        if(!Yii::$app->user->can('full_shops_admin')){
             $query->joinWith('order');
             $userShops = Yii::$app->session['userShops'];
             $query->andFilterWhere( ['in','orders.shop_id',$userShops]);
        }

        $query->orFilterWhere(['like', 'total', $this->orderItemsGlobalSearch])
              ->orFilterWhere(['like', 'items.name', $this->orderItemsGlobalSearch]);
        
        // print_r($query->createCommand()->getRawSql());
        return $dataProvider;
    }
}
