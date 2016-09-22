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
            return $dataProvider;
        }

        $query->joinWith('shop');
        $userShops = Yii::$app->session['userShops'];
        if(!Yii::$app->user->can('full_shops_admin')){
            if(Yii::$app->session['realUser']['user_type']=='SHOP_ADMIN'){
                $query->andFilterWhere( ['in','user.shop_id',$userShops]);
            }else if(Yii::$app->session['realUser']['user_type']=='CR_ADMIN'){
                $query->joinWith('userShops');
                $query->andFilterWhere([
                    'or',
                        ['in','user.shop_id',$userShops],
                        ['in','user_shops.shop_id',$userShops],
                ]);
            }
        }

        $query->andFilterWhere(['or',['like', 'first_name', $this->userGlobalSearch],
                                     ['like', 'last_name', $this->userGlobalSearch],
                                     ['like', 'username', $this->userGlobalSearch],
                                     ['like', 'user.email', $this->userGlobalSearch],
                                     ['like', 'user_type', $this->userGlobalSearch],
                                     ['like', 'user.deleted', $this->userGlobalSearch],
                                     ['like', 'gender', $this->userGlobalSearch],
                                     ['like', 'user.phone', $this->userGlobalSearch],
                                     ['like', 'is_fired', $this->userGlobalSearch],
                                     ['like', 'shops.name', $this->userGlobalSearch]]);

       // print_r($query->createCommand()->getRawSql());

        return $dataProvider;
    }
}
