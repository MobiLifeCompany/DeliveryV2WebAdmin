<?php

namespace backend\models;
use yii\data\ActiveDataProvider;


use Yii;

/**
 * This is the model class for table "order_items".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $item_id
 * @property integer $qty
 * @property integer $item_price
 * @property string $total
 * @property integer $is_canceled
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Items $item
 * @property Orders $order
 */
class OrderItems extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'item_id', 'qty', 'item_price','is_canceled'], 'required'],
            [['order_id', 'item_id', 'qty', 'item_price', 'is_canceled'], 'integer'],
            [['created_at', 'updated_at','order_id', 'item_id', 'qty', 'item_price'], 'safe'],
            [['total'], 'string', 'max' => 255],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'Order#'),
            'item_id' => Yii::t('app', 'Item Name'),
            'qty' => Yii::t('app', 'Qty'),
            'item_price' => Yii::t('app', 'Item Price'),
            'total' => Yii::t('app', 'Total'),
            'is_canceled' => Yii::t('app', 'Is Canceled'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'order_id']);
    }

    public function getOrderItems($id)
    {
        $query = OrderItems::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        

        $query->andWhere(['order_id'=> $id]);

        return $dataProvider;
    }
    public function getOrderById($id)
    {
        $query = Orders::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('shop');
        $query->joinWith('customerAddresses');

        $query->andWhere(['orders.id'=> $id]);

        return $dataProvider;
    }
}
