<?php

namespace backend\models;


use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "cities".
 *
 * @property integer $id
 * @property integer $country_id
 * @property string $name
 * @property integer $deleted
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property string $ar_name
 *
 * @property Areas[] $areas
 * @property Countries $country
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id','name', 'ar_name','lang','deleted'], 'required'],
            [['country_id','name', 'ar_name','lang','deleted'], 'safe'],
            [['country_id', 'deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'ar_name'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 5],
             [['name', 'ar_name'], 'unique'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Countries::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_id' => Yii::t('app', 'COUNTRY_NAME'),
            'name' => Yii::t('app', 'CITY_NAME'),
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
    public function getAreas()
    {
        return $this->hasMany(Areas::className(), ['city_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    public function getCountryCities($id)
    {
        $query = Cities::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['country_id'=> $id]);

        return $dataProvider;
    }

}
