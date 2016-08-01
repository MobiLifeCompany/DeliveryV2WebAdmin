<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customers;

/**
 * CustomersSearch represents the model behind the search form about `backend\models\Customers`.
 */
class CustomersSearch extends Customers
{
    /**
     * @inheritdoc
     */

    public $globalCustomerSearch;

    public function rules()
    {
        return [
            [['id', 'is_allowed', 'sms_count'], 'integer'],
            [['globalCustomerSearch','username', 'password_digest', 'confirmation_token', 'auth_token', 'full_name', 'phone', 'mobile', 'photo', 'gender', 'unlock_token', 'confirmed_at', 'locked_at', 'lang', 'created_at', 'updated_at', 'email'], 'safe'],
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
        $query = Customers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => array('pageSize' => Yii::$app->params['pageSize']),
        ]);

        $this->load($params);


        $query->orFilterWhere(['like', 'username', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'password_digest', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'confirmation_token', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'auth_token', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'full_name', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'phone', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'mobile', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'photo', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'gender', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'unlock_token', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'lang', $this->globalCustomerSearch])
            ->orFilterWhere(['like', 'email', $this->globalCustomerSearch]);

        return $dataProvider;
    }
}
