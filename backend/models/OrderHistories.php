<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "order_histories".
 *
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property string $order_status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Orders $order
 * @property User $user
 */
class OrderHistories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_histories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'order_status'], 'required'],
            [['order_id', 'user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['order_status'], 'string', 'max' => 100],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_id' => Yii::t('app', 'ORDER_ID'),
            'user_id' => Yii::t('app', 'USERNAME'),
            'order_status' => Yii::t('app', 'ORDER_STATUS'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
        ];
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getOrderHistory($orderId)
    {
        $query = OrderHistories::find()->where(['order_id' => $orderId]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' =>false,
        ]);

        return $dataProvider;

    }
}
