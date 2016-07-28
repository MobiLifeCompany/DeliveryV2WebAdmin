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
            'name' => Yii::t('app', 'Name'),
            'photo' => Yii::t('app', 'Photo'),
            'deleted' => Yii::t('app', 'Deleted'),
            'lang' => Yii::t('app', 'Lang'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ar_name' => Yii::t('app', 'Ar Name'),
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
