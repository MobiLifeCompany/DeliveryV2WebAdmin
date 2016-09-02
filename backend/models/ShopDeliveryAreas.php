<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

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
            [['area_id', 'shop_id','delivery_charge'], 'required'],
            [['area_id', 'shop_id', 'deleted','delivery_charge'], 'integer'],
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
            'area_id' => Yii::t('app', 'AREA'),
            'shop_id' => Yii::t('app', 'SHOP'),
            'delivery_charge' => Yii::t('app', 'DELIVERY_CHARGE'),
            'deleted' => Yii::t('app', 'ACTIVE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDeliveryAreas($shopId)
    {
        $query = ShopDeliveryAreas::find()->where(['shop_id' => $shopId]);
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;

    }
}
