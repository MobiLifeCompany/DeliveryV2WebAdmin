<?php

namespace backend\models;

use Yii;

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
        return '{{%areas}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id'], 'required'],
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
            'city_id' => Yii::t('app', 'City ID'),
            'name' => Yii::t('app', 'Name'),
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
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDeliveryAreas()
    {
        return $this->hasMany(ShopDeliveryAreas::className(), ['area_id' => 'id']);
    }
}
