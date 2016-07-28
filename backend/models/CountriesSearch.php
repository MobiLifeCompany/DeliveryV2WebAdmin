<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Countries;

/**
 * CountriesSearch represents the model behind the search form about `backend\models\Countries`.
 */
class CountriesSearch extends Countries
{

    public $globalSearch;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [[ 'globalSearch'], 'safe'],
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
        $query = Countries::find();

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

       

        $query->orFilterWhere(['like', 'name', $this->globalSearch])
            ->orFilterWhere(['like', 'country_code', $this->globalSearch])
            ->orFilterWhere(['like', 'iso_code', $this->globalSearch])
            ->orFilterWhere(['like', 'deleted', $this->globalSearch])
            ->orFilterWhere(['like', 'lang', $this->globalSearch])
            ->orFilterWhere(['like', 'ar_name', $this->globalSearch]);

        return $dataProvider;
    }
}
