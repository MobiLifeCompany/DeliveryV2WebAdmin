<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\AuthItem;

/**
 * AuthItemSearch represents the model behind the search form about `backend\models\AuthItem`.
 */
class AuthItemSearch extends AuthItem
{
    /**
     * @inheritdoc
     */

    public $permissionGlobalSearch;

    public function rules()
    {
        return [
            [['name', 'description', 'permissionGlobalSearch'], 'safe'],
            [['type', 'created_at', 'updated_at'], 'integer'],
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
        $query = AuthItem::find();

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

  

        $query->orFilterWhere(['like', 'name', $this->permissionGlobalSearch])
            ->orFilterWhere(['like', 'description', $this->permissionGlobalSearch])
            ->orFilterWhere(['like', 'rule_name', $this->permissionGlobalSearch])
            ->orFilterWhere(['like', 'data', $this->permissionGlobalSearch]);

        return $dataProvider;
    }
}
