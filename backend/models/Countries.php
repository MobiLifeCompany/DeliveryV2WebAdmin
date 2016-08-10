<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "countries".
 *
 * @property integer $id
 * @property string $name
 * @property string $country_code
 * @property string $iso_code
 * @property integer $deleted
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property string $ar_name
 *
 * @property Cities[] $cities
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'countries';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted'], 'integer'],
            [['name', 'ar_name','country_code', 'iso_code','deleted','lang'], 'required'],
            [['name', 'ar_name','country_code', 'iso_code','deleted','lang'], 'safe'],
             [['name', 'ar_name','country_code', 'iso_code'], 'unique'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'ar_name'], 'string', 'max' => 255],
            [['country_code', 'iso_code'], 'string', 'max' => 3],
            [['lang'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'COUNTRY_NAME'),
            'country_code' => Yii::t('app', 'COUNTRY_CODE'),
            'iso_code' => Yii::t('app', 'ISO_CODE'),
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
    public function getCities()
    {
        return $this->hasMany(Cities::className(), ['country_id' => 'id']);
    }
}
