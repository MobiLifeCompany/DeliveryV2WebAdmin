<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shop_offers".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property integer $item_id
 * @property string $name
 * @property string $short_description
 * @property string $photo
 * @property string $from_date
 * @property string $to_date
 * @property integer $active
 * @property string $offer_type
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property integer $clickable
 * @property string $ar_name
 * @property string $ar_short_description
 *
 * @property Items $item
 * @property Shops $shop
 */
class ShopOffers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shop_offers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'item_id','active','clickable','from_date', 'to_date', 'name','short_description', 'ar_name', 'ar_short_description', 'photo', 'offer_type'], 'required'],
            [['shop_id', 'item_id', 'active', 'clickable'], 'integer'],
            [['from_date', 'to_date', 'created_at', 'updated_at'], 'safe'],
            [['name',], 'string', 'max' => 100],
            [['photo',],'required','on'=>['create','update']],
            [['photo'], 'file','skipOnEmpty' => 'false', 'extensions' => 'png, jpg'],
            [['short_description', 'ar_name', 'ar_short_description'], 'string', 'max' => 255],
            [['offer_type'], 'string', 'max' => 45],
            [['lang'], 'string', 'max' => 5],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Items::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'shop_id' => Yii::t('app', 'SHOP_NAME'),
            'item_id' => Yii::t('app', 'ITEM_NAME'),
            'name' => Yii::t('app', 'NAME'),
            'short_description' => Yii::t('app', 'DESCRIPTION'),
            'photo' => Yii::t('app', 'PHOTO'),
            'from_date' => Yii::t('app', 'FROM_DATE'),
            'to_date' => Yii::t('app', 'TO_DATE'),
            'active' => Yii::t('app', 'ACTIVE'),
            'offer_type' => Yii::t('app', 'OFFER_TYPE'),
            'lang' => Yii::t('app', 'LANGUAGE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'clickable' => Yii::t('app', 'CLICKABLE'),
            'ar_name' => Yii::t('app', 'ARABIC_NAME'),
            'ar_short_description' => Yii::t('app', 'ARABIC_DESCRIPTION'),
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
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }
}
