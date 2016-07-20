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
            'name' => Yii::t('app', 'Name'),
            'country_code' => Yii::t('app', 'Country Code'),
            'iso_code' => Yii::t('app', 'Iso Code'),
            'deleted' => Yii::t('app', 'Active'),
            'lang' => Yii::t('app', 'Language'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ar_name' => Yii::t('app', 'Arabic Name'),
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
