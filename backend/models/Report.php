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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_date', 'from_date'], 'required'],
            [['shop_id'], 'integer'],
            [['from_date', 'from_date'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'shop_id' => Yii::t('app', 'Shop'),
            'from_date' => Yii::t('app', 'From Date'),
            'to_date' => Yii::t('app', 'To Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopItemCategories()
    {
        return $this->hasMany(ShopItemCategories::className(), ['item_category_id' => 'id']);
    }
}
