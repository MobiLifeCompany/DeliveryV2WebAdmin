<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ShopRates;

/**
 * ShopRatesSearch represents the model behind the search form about `backend\models\ShopRates`.
 */
class ShopRatesSearch extends ShopRates
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'customer_id', 'shop_id', 'order_id', 'rate', 'deleted'], 'integer'],
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
        $query = ShopRates::find();

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

        // grid filtering conditions
        $query->orFilterWhere(['like', 'customer_id', $this->globalSearch])
            ->orFilterWhere(['like', 'shop_id', $this->globalSearch])
            ->orFilterWhere(['like', 'order_id', $this->globalSearch])
            ->orFilterWhere(['like', 'rate', $this->globalSearch]);

        return $dataProvider;
    }
}
