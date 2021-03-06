<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "{{%areas}}".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $name
 * @property integer $deleted
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property string $ar_name
 *
 * @property Cities $city
 * @property ShopDeliveryAreas[] $shopDeliveryAreas
 */
class Areas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id','name', 'ar_name','lang','deleted'], 'required'],
            [['city_id','name', 'ar_name','lang','deleted'], 'safe'],
            [['name', 'ar_name'], 'unique'],
            [['city_id', 'deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'ar_name'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 5],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city_id' => Yii::t('app', 'CITY'),
            'name' => Yii::t('app', 'AREA_NAME'),
            'deleted' => Yii::t('app', 'ACTIVE'),
            'lang' => Yii::t('app', 'LANGUAGE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'ar_name' => Yii::t('app', 'ARABIC_NAME'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public function getCityAreas($id)
    {
        $query = Areas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['city_id'=> $id]);

        return $dataProvider;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDeliveryAreas()
    {
        return $this->hasMany(ShopDeliveryAreas::className(), ['area_id' => 'id']);
    }
}
