<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Shops;

/**
 * ShopsSearch represents the model behind the search form about `backend\models\Shops`.
 */
class ShopsSearch extends Shops
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
        $query = Shops::find();

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
            ->orFilterWhere(['like', 'deleted', $this->globalSearch])
            ->orFilterWhere(['like', 'lang', $this->globalSearch])
            ->orFilterWhere(['like', 'ar_name', $this->globalSearch]);

        return $dataProvider;

        $query->orFilterWhere(['like', 'name', $this->name])
            ->orFilterWhere(['like', 'short_description', $this->short_description])
            ->orFilterWhere(['like', 'address', $this->address])
            ->orFilterWhere(['like', 'longitude', $this->longitude])
            ->orFilterWhere(['like', 'latitude', $this->latitude])
            ->orFilterWhere(['like', 'estimation_time', $this->estimation_time])
            ->orFilterWhere(['like', 'delivery_expected_time', $this->delivery_expected_time])
            ->orFilterWhere(['like', 'promotion_note', $this->promotion_note])
            ->orFilterWhere(['like', 'warning_note', $this->warning_note])
            ->orFilterWhere(['like', 'masteries', $this->masteries])
            ->orFilterWhere(['like', 'lang', $this->lang])
            ->orFilterWhere(['like', 'country', $this->country])
            ->orFilterWhere(['like', 'ar_name', $this->ar_name])
            ->orFilterWhere(['like', 'ar_short_description', $this->ar_short_description])
            ->orFilterWhere(['like', 'ar_address', $this->ar_address])
            ->orFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
