<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use backend\models\ShopItemCategories;

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
            [['item_category_id','shop_item_category_id','name', 'description', 'price', 'ar_name','active', 'ar_description','deleted'], 'required'],
            [['shop_item_category_id', 'active', 'deleted'], 'integer'],
            [['created_at', 'updated_at', 'item_category_id', 'shop_id'], 'safe'],
            [['name', 'description', 'price', 'ar_name', 'ar_description'], 'string', 'max' => 255],
            [['photo',],'required','on'=>['create','update']],
            [['photo'], 'file','skipOnEmpty' => 'false', 'extensions' => 'png, jpg'],
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
            'shop_item_category_id' => Yii::t('app', 'ITEM_CATEGORY'),
            'name' => Yii::t('app', 'NAME'),
            'description' => Yii::t('app', 'DESCRIPTION'),
            'price' => Yii::t('app', 'PRICE'),
            'photo' => Yii::t('app', 'PHOTO'),
            'active' => Yii::t('app', 'ACTIVE'),
            'deleted' => Yii::t('app', 'DELETED'),
            'lang' => Yii::t('app', 'LANGUAGE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'ar_name' => Yii::t('app', 'ARABIC_NAME'),
            'ar_description' => Yii::t('app', 'ARABIC_DESCRIPTION'),
            'shop_id' => Yii::t('app', 'SHOP'),
            'item_category_id' => Yii::t('app', 'ITEM_CATEGORY'),
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
    public function getShopItems($shopId)
    {
        $result = ArrayHelper::map(ShopItemCategories::find()->where(['shop_id' => $shopId])->all(),'id','id');
        $query = Items::find()->where(['shop_item_category_id' => $result]);
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;

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
