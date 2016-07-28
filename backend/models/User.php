<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $phone
 * @property string $user_type
 * @property string $deleted
 * @property string $gender
 * @property string $is_fired
 * @property string $lang
 * @property string $subscribed
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Shops $shop
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'first_name', 'last_name', 'username', 'password_hash', 'email', 'phone','user_type','deleted', 'gender'], 'safe'],
            [['shop_id', 'first_name', 'last_name', 'username', 'password_hash', 'email', 'phone','user_type','deleted', 'gender'], 'required'],
            [['shop_id', 'status', 'phone'], 'integer'],
            [['user_type', 'deleted', 'gender'], 'string'],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['username','phone','email'], 'unique'],
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
            'shop.name' => Yii::t('app', 'Shop Name'),
            'shop_id' => Yii::t('app', 'Shop Name'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'phone' => Yii::t('app', 'Phone'),
            'user_type' => Yii::t('app', 'User Type'),
            'deleted' => Yii::t('app', 'Active'),
            'gender' => Yii::t('app', 'Gender'),
            'is_fired' => Yii::t('app', 'Is Fired'),
            'lang' => Yii::t('app', 'Lang'),
            'subscribed' => Yii::t('app', 'Subscribed'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }
}
