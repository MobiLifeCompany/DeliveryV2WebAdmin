<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property integer $shop_item_category_id
 * @property string $name
 * @property string $description
 * @property string $price
 * @property string $photo
 * @property integer $active
 * @property integer $deleted
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property string $ar_name
 * @property string $ar_description
 *
 * @property ShopItemCategories $shopItemCategory
 * @property OrderItems[] $orderItems
 * @property ShopOffers[] $shopOffers
 */
class Items extends \yii\db\ActiveRecord
{
    public $shop_id;
    public $item_category_id;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_item_category_id'], 'required'],
            [['shop_item_category_id', 'active', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'item_category_id', 'shop_id'], 'safe'],
            [['name', 'description', 'price', 'photo', 'ar_name', 'ar_description'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 5],
            [['shop_item_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ShopItemCategories::className(), 'targetAttribute' => ['shop_item_category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop_item_category_id' => Yii::t('app', 'Shop Item Category ID'),
            'name' => Yii::t('app', 'Name'),
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'photo' => Yii::t('app', 'Photo'),
            'active' => Yii::t('app', 'Active'),
            'deleted' => Yii::t('app', 'Deleted'),
            'lang' => Yii::t('app', 'Language'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ar_name' => Yii::t('app', 'Arabic Name'),
            'ar_description' => Yii::t('app', 'Arabic Description'),
            'shop_id' => Yii::t('app', 'Shop'),
            'item_category_id' => Yii::t('app', 'Category'),
        ];
    }

    public function getShopId() {
        return $this->shopItemCategory->shop->id;
    }

    public function getItemCategoryId() {
        return $this->shopItemCategory->itemCategory->id;
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopItemCategory()
    {
        return $this->hasOne(ShopItemCategories::className(), ['id' => 'shop_item_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItems::className(), ['item_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOffers()
    {
        return $this->hasMany(ShopOffers::className(), ['item_id' => 'id']);
    }
}
