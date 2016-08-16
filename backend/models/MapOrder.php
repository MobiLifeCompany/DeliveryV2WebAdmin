<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * This is the model class for table "item_categories".
 *
 * @property integer $order_id
 * @property string  $description
 *
 */
class MapOrder extends Model 
{
    

    public $order_id;
    public $order_status;
    public $shop_id;
    public $shop_longitude;
    public $shop_latitude;
    public $customer_id;
    public $customer_fullname;
    public $customer_address_id;
    public $customer_address;
    public $customer_addresses_longitude;
    public $customer_addresses_latitude;
    public $full_name;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'required'],
            [['order_id'], 'integer'],
            [['order_status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => Yii::t('app', 'ORDER_ID'),
            'description' => Yii::t('app', 'Description'),
            'customer_fullname' => Yii::t('app', 'Customer'),
        ];
    }

}
