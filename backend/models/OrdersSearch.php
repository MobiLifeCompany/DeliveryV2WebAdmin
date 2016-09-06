<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `backend\models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */

    public $ordersGlobalSearch;
    public function rules()
    {
        return [
            [['id', 'customer_id', 'shop_id', 'qty', 'delivery_charge'], 'integer'],
            [['ordersGlobalSearch','customer_address_id', 'order_status', 'total', 'cancel_reason', 'note', 'created_at', 'updated_at'], 'safe'],
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

        $query->joinWith('shop');
        $userShops = Yii::$app->session['userShops'];
        if(!Yii::$app->user->can('full_shops_admin')){
           $query->andFilterWhere( ['in','shops.id',$userShops]);
        }
        $query->joinWith('customer');


        $query->orFilterWhere(['like', 'customer_address_id', $this->ordersGlobalSearch])
            ->orFilterWhere(['like', 'order_status', $this->ordersGlobalSearch])
            ->orFilterWhere(['like', 'shops.name', $this->ordersGlobalSearch])
            ->orFilterWhere(['like', 'customers.full_name', $this->ordersGlobalSearch])
            ->orFilterWhere(['like', 'total', $this->ordersGlobalSearch])
            ->orFilterWhere(['like', 'qty', $this->ordersGlobalSearch])
            ->orFilterWhere(['like', 'cancel_reason', $this->ordersGlobalSearch])
            ->orFilterWhere(['like', 'note', $this->ordersGlobalSearch]);

       $query->orderBy('id DESC');     

        return $dataProvider;
    }
}
