<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AuthItemChild;

/**
 * AuthItemChildSearch represents the model behind the search form about `backend\models\AuthItemChild`.
 */
class AuthItemChildSearch extends AuthItemChild
{
    
     public $globalSearch;

    /**
     * @inheritdoc
     */

    public function rules()
    {
        return [
            [['parent', 'child','globalSearch'], 'safe'],
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
        $query = AuthItemChild::find();

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
        $query->orFilterWhere(['like', 'parent',$this->globalSearch])
              ->orFilterWhere(['like', 'child', $this->globalSearch]);


        return $dataProvider;
    }
}
