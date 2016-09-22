<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Items;
use backend\models\shopItemCategory;



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
            return $dataProvider;
        }

        $userShops = Yii::$app->session['userShops'];
        if(!Yii::$app->user->can('full_items_admin')){
            $query->joinWith('shopItemCategory');
            $query->andFilterWhere(['in','shop_item_categories.shop_id',$userShops]);
        }

        $query->andFilterWhere(['or',['like', 'name', $this->globalSearch]
              ,['like', 'description', $this->globalSearch]
              ,['like', 'price', $this->globalSearch]
              ,['like', 'photo', $this->globalSearch]
              ,['like', 'lang', $this->globalSearch]
              ,['like', 'ar_name', $this->globalSearch]
              ,['like', 'ar_description', $this->globalSearch]]);

            //print_r($query->createCommand()->getRawSql());
        //  print_r('----------');
        //die();
        $query->orderBy('id DESC');     
        return $dataProvider;
    }
}
