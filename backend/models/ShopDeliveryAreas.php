<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shop_delivery_areas".
 *
 * @property integer $id
 * @property integer $area_id
 * @property integer $shop_id
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Areas $area
 * @property Shops $shop
 */
class ShopDeliveryAreas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_delivery_areas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['area_id', 'shop_id'], 'required'],
            [['area_id', 'shop_id', 'deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['area_id'], 'exist', 'skipOnError' => true, 'targetClass' => Areas::className(), 'targetAttribute' => ['area_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'area_id' => Yii::t('app', 'Area ID'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Areas::className(), ['id' => 'area_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }
}
