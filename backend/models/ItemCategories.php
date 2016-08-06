<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "item_categories".
 *
 * @property integer $id
 * @property string $name
 * @property string $photo
 * @property string $lang
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 * @property string $ar_name
 *
 * @property ShopItemCategories[] $shopItemCategories
 */
class ItemCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'item_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['deleted','name', 'ar_name'], 'required'],
            [['deleted'], 'integer'],
            [['created_at', 'updated_at','photo'], 'safe'],
            [['photo'], 'file',],
            [['name', 'ar_name'], 'string', 'max' => 255],
            [['lang'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'photo' => Yii::t('app', 'Photo'),
            'lang' => Yii::t('app', 'Language'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'ar_name' => Yii::t('app', 'Arabic Name'),
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
