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
            [['confirmed_at', 'locked_at', 'created_at', 'updated_at'], 'safe'],
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
            'username' => Yii::t('app', 'Username'),
            'password_digest' => Yii::t('app', 'Password'),
            'confirmation_token' => Yii::t('app', 'Confirmation Token'),
            'auth_token' => Yii::t('app', 'Auth Token'),
            'full_name' => Yii::t('app', 'Full Name'),
            'phone' => Yii::t('app', 'Phone'),
            'mobile' => Yii::t('app', 'Mobile'),
            'photo' => Yii::t('app', 'Photo'),
            'gender' => Yii::t('app', 'Gender'),
            'is_allowed' => Yii::t('app', 'Is Allowed'),
            'unlock_token' => Yii::t('app', 'Unlock Token'),
            'confirmed_at' => Yii::t('app', 'Confirmed At'),
            'locked_at' => Yii::t('app', 'Locked At'),
            'sms_count' => Yii::t('app', 'SMS Count'),
            'lang' => Yii::t('app', 'Lang'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'email' => Yii::t('app', 'Email'),
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
