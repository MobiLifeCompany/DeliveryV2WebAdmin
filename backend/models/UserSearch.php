<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\User;

/**
 * UserSearch represents the model behind the search form about `backend\models\User`.
 */
class UserSearch extends User
{
    /**
     * @inheritdoc
     */

    public $userGlobalSearch;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['userGlobalSearch'], 'safe'],
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
        $query = User::find();

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

        $query->joinWith('shop');

        $query->orFilterWhere(['like', 'first_name', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'last_name', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'username', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'email', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'user_type', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'user.deleted', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'gender', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'user.phone', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'is_fired', $this->userGlobalSearch])
            ->orFilterWhere(['like', 'shops.name', $this->userGlobalSearch]);

        return $dataProvider;
    }
}
