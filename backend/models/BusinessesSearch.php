<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Businesses;

/**
 * BusinessesSearch represents the model behind the search form about `backend\models\Businesses`.
 */
class BusinessesSearch extends Businesses
{
    /**
     * @inheritdoc
     */
    public $globalSearch;

    public function rules()
    {
        return [
            [['id', 'deleted'], 'integer'],
            [['name', 'photo', 'lang', 'created_at', 'updated_at', 'ar_name','globalSearch'], 'safe'],
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
        $query = Businesses::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        $query->orFilterWhere(['like', 'name', $this->globalSearch])
            ->orFilterWhere(['like', 'photo', $this->globalSearch])
            ->orFilterWhere(['like', 'lang', $this->globalSearch])
            ->orFilterWhere(['like', 'ar_name', $this->globalSearch]);

        return $dataProvider;
    }
}
