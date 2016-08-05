<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $shop_id
 * @property integer $delivery_user_id
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
 * @property CustomerAddresses $customerAddresses
 * @property User $deliveryUser
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
            [['customer_id', 'order_status','total', 'qty', 'delivery_charge','customer_address_id'], 'required'],
            [['customer_id', 'shop_id', 'qty', 'delivery_charge'], 'integer'],
            [['note'], 'string'],
            [['created_at', 'updated_at','customer_address_id'], 'safe'],
            ['cancel_reason','required','when'=>function($model){
                return ($model->order_status == 'CANCEL')? true : false;
            },'whenClient' => "function(){
                if($('#order_status').val()=='CANCEL'){
                    true;
                }else
                {
                    false;
                }
            }"],
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
            'delivery_user_id' => Yii::t('app', 'Delivery User'),
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

    public function getDeliveryUser()
    {
        return $this->hasOne(User::className(), ['id' => 'delivery_user_id']);
    }

    public function getCustomerAddresses()
    {
        return $this->hasOne(CustomerAddresses::className(), ['id' => 'customer_address_id']);
    }

   
    public function getOrdersByCustomerId($id)
    {
        $query = Orders::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['customer_id'=> $id]);

        return $dataProvider;
    }

    public function getCustomerById($id)
    {
        $query = Customers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['id'=> $id]);

        return $dataProvider;
    }
}
