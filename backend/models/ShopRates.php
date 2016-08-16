<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "shop_rates".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $shop_id
 * @property integer $order_id
 * @property integer $rate
 * @property integer $deleted
 *
 * @property Customers $customer
 * @property Orders $order
 * @property Shops $shop
 */
class ShopRates extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_rates';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'shop_id', 'order_id'], 'required'],
            [['customer_id', 'shop_id', 'order_id', 'rate', 'deleted'], 'integer'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'customer_id' => Yii::t('app', 'CUSTOMER'),
            'shop_id' => Yii::t('app', 'SHOP_NAME'),
            'order_id' => Yii::t('app', 'ORDER_NO'),
            'rate' => Yii::t('app', 'RATING'),
            'deleted' => Yii::t('app', 'DELETED'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
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
    public function getShopRates($shopId)
    {
        $query = ShopRates::find()->where(['shop_id' => $shopId]);
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;

    }
}
