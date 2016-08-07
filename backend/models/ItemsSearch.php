<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Items;

/**
 * ItemsSearch represents the model behind the search form about `backend\models\Items`.
 */
class ItemsSearch extends Items
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
        $query = Items::find();

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

        $query->andFilterWhere(['like', 'name', $this->globalSearch])
            ->andFilterWhere(['like', 'description', $this->globalSearch])
            ->andFilterWhere(['like', 'price', $this->globalSearch])
            ->andFilterWhere(['like', 'photo', $this->globalSearch])
            ->andFilterWhere(['like', 'lang', $this->globalSearch])
            ->andFilterWhere(['like', 'ar_name', $this->globalSearch])
            ->andFilterWhere(['like', 'ar_description', $this->globalSearch]);

        return $dataProvider;
    }
}
