<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\CustomerAddresses;

/**
 * CustomerAddressesSearch represents the model behind the search form about `backend\models\CustomerAddresses`.
 */
class CustomerAddressesSearch extends CustomerAddresses
{
    /**
     * @inheritdoc
     */

    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'customer_id', 'city_id', 'area_id', 'is_default', 'deleted'], 'integer'],
            [['globalSearch','street', 'building', 'floor', 'details', 'phone', 'email', 'latitude', 'longitude', 'created_at', 'updated_at'], 'safe'],
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
        $query = CustomerAddresses::find();

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

        $query->joinWith('area');
        $query->joinWith('city');
        $query->joinWith('customer');

        $query->orFilterWhere(['like', 'cities.name', $this->globalSearch])
            ->orFilterWhere(['like', 'areas.name', $this->globalSearch])
            ->orFilterWhere(['like', 'customers.full_name', $this->globalSearch])
            ->orFilterWhere(['like', 'street', $this->globalSearch])
            ->orFilterWhere(['like', 'building', $this->globalSearch])
            ->orFilterWhere(['like', 'floor', $this->globalSearch])
            ->orFilterWhere(['like', 'details', $this->globalSearch])
            ->orFilterWhere(['like', 'customer_addresses.phone', $this->globalSearch])
            ->orFilterWhere(['like', 'customer_addresses.email', $this->globalSearch])
            ->orFilterWhere(['like', 'latitude', $this->globalSearch])
            ->orFilterWhere(['like', 'longitude', $this->globalSearch]);

        return $dataProvider;
    }
}
