<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "item_categories".
 *
 * @property integer $shop_id
 * @property string  $from_date
 * @property string  $to_date
 *
 */
class Report extends Model 
{
    

    public $shop_id;
    public $from_date;
    public $to_date;
    public $order_status;
    public $item_id;
    public $delivery_user_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_date', 'to_date'], 'required'],
            [['shop_id'], 'integer'],
            [['from_date', 'to_date'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shop_id' => Yii::t('app', 'SHOPS'),
            'from_date' => Yii::t('app', 'FROM_DATE'),
            'to_date' => Yii::t('app', 'TO_DATE'),
            'item_id' => Yii::t('app', 'ITEMS'),
            'order_status' => Yii::t('app', 'ORDER_STATUS'),
            'delivery_user_id'  => Yii::t('app', 'DELIVERY_USER'),
        ];
    }

}
