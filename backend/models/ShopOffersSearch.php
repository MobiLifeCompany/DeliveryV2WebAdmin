<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\ShopOffers;

/**
 * ShopOffersSearch represents the model behind the search form about `backend\models\ShopOffers`.
 */
class ShopOffersSearch extends ShopOffers
{
    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'item_id', 'active', 'clickable'], 'integer'],
            [['name', 'short_description', 'photo', 'from_date', 'to_date', 'offer_type', 'lang', 'created_at', 'updated_at', 'ar_name', 'ar_short_description'], 'safe'],
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
        $query = ShopOffers::find();

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
        $query->orFilterWhere(['like', 'name', $this->globalSearch])
            ->orFilterWhere(['like', 'short_description', $this->globalSearch])
            ->orFilterWhere(['like', 'ar_name', $this->globalSearch])
            ->orFilterWhere(['like', 'ar_short_description', $this->globalSearch])
            ->orFilterWhere(['like', 'shop_id', $this->globalSearch])
            ->orFilterWhere(['like', 'item_id', $this->globalSearch])
            ->orFilterWhere(['like', 'offer_type', $this->globalSearch]);

        return $dataProvider;
    }
}
