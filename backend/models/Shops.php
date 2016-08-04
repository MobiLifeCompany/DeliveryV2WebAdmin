<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "shops".
 *
 * @property integer $id
 * @property integer $business_id
 * @property integer $area_id
 * @property string $name
 * @property string $short_description
 * @property string $address
 * @property integer $is_avilable
 * @property string $longitude
 * @property string $latitude
 * @property string $estimation_time
 * @property integer $min_amount
 * @property string $delivery_expected_time
 * @property integer $delivery_charge
 * @property string $promotion_note
 * @property string $warning_note
 * @property string $photo
 * @property string $masteries
 * @property integer $deleted
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property integer $rating
 * @property string $country
 * @property integer $subscribed
 * @property string $ar_name
 * @property string $ar_short_description
 * @property string $ar_address
 * @property string $phone
 *
 * @property OpeningHours[] $openingHours
 * @property ShopDeliveryAreas[] $shopDeliveryAreas
 * @property ShopItemCategories[] $shopItemCategories
 * @property ShopOffers[] $shopOffers
 * @property Businesses $business
 * @property User[] $users
 * @property Users[] $users0
 */
class Shops extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'shops';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['business_id'], 'required'],
            [['business_id', 'is_avilable', 'min_amount', 'delivery_charge', 'deleted', 'rating', 'subscribed'], 'integer'],
            [['promotion_note', 'warning_note', 'masteries'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'short_description', 'address', 'estimation_time', 'ar_name', 'ar_short_description', 'ar_address'], 'string', 'max' => 255],
            [['longitude', 'latitude', 'photo'], 'string', 'max' => 100],
            [['delivery_expected_time'], 'string', 'max' => 11],
            [['lang'], 'string', 'max' => 5],
            [['country'], 'string', 'max' => 3],
            [['phone'], 'string', 'max' => 20],
            [['business_id'], 'exist', 'skipOnError' => true, 'targetClass' => Businesses::className(), 'targetAttribute' => ['business_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'business_id' => Yii::t('app', 'Business ID'),
            'area_id' => Yii::t('app', 'Area ID'),
            'name' => Yii::t('app', 'Name'),
            'short_description' => Yii::t('app', 'Short Description'),
            'address' => Yii::t('app', 'Address'),
            'is_avilable' => Yii::t('app', 'Is Avilable'),
            'longitude' => Yii::t('app', 'Longitude'),
            'latitude' => Yii::t('app', 'Latitude'),
            'estimation_time' => Yii::t('app', 'Estimation Time'),
            'min_amount' => Yii::t('app', 'Min Amount'),
            'delivery_expected_time' => Yii::t('app', 'Delivery Expected Time'),
            'delivery_charge' => Yii::t('app', 'Delivery Charge'),
            'promotion_note' => Yii::t('app', 'Promotion Note'),
            'warning_note' => Yii::t('app', 'Warning Note'),
            'photo' => Yii::t('app', 'Photo'),
            'masteries' => Yii::t('app', 'Masteries'),
            'deleted' => Yii::t('app', 'Deleted'),
            'lang' => Yii::t('app', 'Language'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'rating' => Yii::t('app', 'Rating'),
            'country' => Yii::t('app', 'Country'),
            'subscribed' => Yii::t('app', 'Subscribed'),
            'ar_name' => Yii::t('app', 'Arabic Name'),
            'ar_short_description' => Yii::t('app', 'Arabic Short Description'),
            'ar_address' => Yii::t('app', 'Arabic Address'),
            'phone' => Yii::t('app', 'Phone'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOpeningHours()
    {
        return $this->hasMany(OpeningHours::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopDeliveryAreas()
    {
        return $this->hasMany(ShopDeliveryAreas::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopItemCategories()
    {
        return $this->hasMany(ShopItemCategories::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOffers()
    {
        return $this->hasMany(ShopOffers::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBusiness()
    {
        return $this->hasOne(Businesses::className(), ['id' => 'business_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['shop_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers0()
    {
        return $this->hasMany(Users::className(), ['shop_id' => 'id']);
    }
}
