<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customers".
 *
 * @property integer $id
 * @property string $username
 * @property string $password_digest
 * @property string $confirmation_token
 * @property string $auth_token
 * @property string $full_name
 * @property string $phone
 * @property string $mobile
 * @property string $photo
 * @property string $gender
 * @property integer $is_allowed
 * @property string $unlock_token
 * @property string $confirmed_at
 * @property string $locked_at
 * @property integer $sms_count
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property string $email
 *
 * @property CustomerAddresses[] $customerAddresses
 * @property Orders[] $orders
 */
class Customers extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_allowed', 'sms_count'], 'integer'],
            [['username','full_name','phone', 'mobile', 'gender'], 'required'],
            [['created_at', 'updated_at', 'username','full_name','phone', 'mobile', 'gender','email'], 'safe'],
            [['username'], 'string', 'max' => 150],
            [['password_digest', 'confirmation_token', 'auth_token', 'full_name', 'phone', 'mobile', 'photo', 'gender', 'unlock_token', 'email'], 'string', 'max' => 255],
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
            'username' => Yii::t('app', 'USERNAME'),
            'password_digest' => Yii::t('app', 'PASSWORD'),
            'confirmation_token' => Yii::t('app', 'Confirmation Token'),
            'auth_token' => Yii::t('app', 'AUTH_TOKEN'),
            'full_name' => Yii::t('app', 'FULL_NAME'),
            'phone' => Yii::t('app', 'PHONE'),
            'mobile' => Yii::t('app', 'MOBILE'),
            'photo' => Yii::t('app', 'PHOTO'),
            'gender' => Yii::t('app', 'GENDER'),
            'is_allowed' => Yii::t('app', 'ACTIVE'),
            'unlock_token' => Yii::t('app', 'Unlock Token'),
            'confirmed_at' => Yii::t('app', 'CONFIRMED_AT'),
            'locked_at' => Yii::t('app', 'LOCKED_AT'),
            'sms_count' => Yii::t('app', 'SMS_COUNT'),
            'lang' => Yii::t('app', 'LANGUAGE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
            'email' => Yii::t('app', 'EMAIL'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomerAddresses()
    {
        return $this->hasMany(CustomerAddresses::className(), ['customer_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['customer_id' => 'id']);
    }
}
