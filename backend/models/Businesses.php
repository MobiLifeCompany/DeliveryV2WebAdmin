<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "businesses".
 *
 * @property integer $id
 * @property string $name
 * @property string $photo
 * @property integer $deleted
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property string $ar_name
 *
 * @property Shops[] $shops
 */
class Businesses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'businesses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'ar_name','deleted'], 'required'],
            [['deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'photo', 'ar_name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'NAME'),
            'photo' => Yii::t('app', 'PHOTO'),
            'deleted' => Yii::t('app', 'ACTIVE'),
            'lang' => Yii::t('app', 'LANG'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'ar_name' => Yii::t('app', 'ARABIC_NAME'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shops::className(), ['business_id' => 'id']);
    }
}
