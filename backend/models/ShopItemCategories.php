<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shop_item_categories".
 *
 * @property integer $id
 * @property integer $item_category_id
 * @property integer $shop_id
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Items[] $items
 * @property ItemCategories $itemCategory
 * @property Shops $shop
 */
class ShopItemCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_item_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_category_id', 'shop_id'], 'required'],
            [['item_category_id', 'shop_id', 'deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['item_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ItemCategories::className(), 'targetAttribute' => ['item_category_id' => 'id']],
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
            'item_category_id' => Yii::t('app', 'Item Category ID'),
            'shop_id' => Yii::t('app', 'Shop ID'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['shop_item_category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemCategory()
    {
        return $this->hasOne(ItemCategories::className(), ['id' => 'item_category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }
}
