<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $shop_id
 * @property string $customer_address_id
 * @property string $order_status
 * @property string $total
 * @property integer $qty
 * @property string $cancel_reason
 * @property string $note
 * @property string $created_at
 * @property string $updated_at
 * @property integer $delivery_charge
 *
 * @property OrderHistories[] $orderHistories
 * @property OrderItems[] $orderItems
 * @property Customers $customer
 * @property Shops $shop
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'order_status', 'qty', 'delivery_charge'], 'required'],
            [['customer_id', 'shop_id', 'qty', 'delivery_charge'], 'integer'],
            [['note'], 'string'],
            [['created_at', 'updated_at','customer_address_id'], 'safe'],
            [['customer_address_id', 'order_status', 'total', 'cancel_reason'], 'string', 'max' => 255],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID#'),
            'customer_id' => Yii::t('app', 'Customer'),
            'shop_id' => Yii::t('app', 'Shop'),
            'customer_address_id' => Yii::t('app', 'Customer Address'),
            'order_status' => Yii::t('app', 'Order Status'),
            'total' => Yii::t('app', 'Total'),
            'qty' => Yii::t('app', 'Qty'),
            'cancel_reason' => Yii::t('app', 'Cancel Reason'),
            'note' => Yii::t('app', 'Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'delivery_charge' => Yii::t('app', 'Delivery Charge'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderHistories()
    {
        return $this->hasMany(OrderHistories::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['order_id' => 'id']);
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
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }
}
