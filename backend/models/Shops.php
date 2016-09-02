<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

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
 * @property Area $area
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
            [['business_id','area_id','city_id'], 'required'],
            [['business_id', 'is_avilable', 'min_amount', 'delivery_charge', 'deleted', 'rating', 'subscribed','city_id'], 'integer'],
            [['promotion_note', 'warning_note', 'masteries'], 'string'],
            [['created_at', 'updated_at','city_id','area_id','email','enable_email_notification'], 'safe'],
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
            'business_id' => Yii::t('app', 'BUSINESS_NAME'),
            'area_id' => Yii::t('app', 'AREA'),
            'city_id' => Yii::t('app', 'CITY'),
            'name' => Yii::t('app', 'NAME'),
            'short_description' => Yii::t('app', 'DESCRIPTION'),
            'address' => Yii::t('app', 'ADDRESS'),
            'is_avilable' => Yii::t('app', 'IS_AVAILABLE'),
            'longitude' => Yii::t('app', 'LONGITUDE'),
            'latitude' => Yii::t('app', 'LATITUDE'),
            'estimation_time' => Yii::t('app', 'ESTIMATED_TIME'),
            'min_amount' => Yii::t('app', 'MIN_AMOUNT'),
            'delivery_expected_time' => Yii::t('app', 'DELIVERY_EXPECTED_TIME'),
            'delivery_charge' => Yii::t('app', 'DELIVERY_CHARGE'),
            'promotion_note' => Yii::t('app', 'PROMOTION_NOTE'),
            'warning_note' => Yii::t('app', 'WARNING_NOTE'),
            'photo' => Yii::t('app', 'PHOTO'),
            'masteries' => Yii::t('app', 'MASTERIES'),
            'deleted' => Yii::t('app', 'ACTIVE'),
            'lang' => Yii::t('app', 'LANGUAGE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'rating' => Yii::t('app', 'RATING'),
            'country' => Yii::t('app', 'COUNTRY'),
            'subscribed' => Yii::t('app', 'SUBSCRIBED'),
            'ar_name' => Yii::t('app', 'ARABIC_NAME'),
            'ar_short_description' => Yii::t('app', 'ARABIC_DESCRIPTION'),
            'ar_address' => Yii::t('app', 'ARABIC_ADDRESS'),
            'phone' => Yii::t('app', 'PHOTO'),
            'email' => Yii::t('app', 'EMAIL'),
            'enable_email_notification' => Yii::t('app', 'ENABLE_EMAIL_NOTIFICATION'),
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
    public function getArea()
    {
        return $this->hasOne(Areas::className(), ['id' => 'area_id']);
    }

    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public function getShopById($id)
    {
        $query = Shops::find()->where(['id'=> $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        return $dataProvider;
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
