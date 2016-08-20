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
            [['first_name', 'last_name', 'username', 'password_hash', 'email', 'phone','user_type','deleted', 'gender'], 'safe'],
            [['first_name', 'last_name', 'username', 'password_hash', 'email', 'phone','user_type','deleted', 'gender'], 'required'],
            [['shop_id', 'status', 'phone'], 'integer'],
            [['user_type', 'deleted', 'gender'], 'string'],
            ['shop_id','required','when'=>function($model){
                return ($model->user_type == 'SHOP_ADMIN' || $model->user_type =='SHOP_DELIVERY_MAN') ? true : false;
            },'whenClient' => "function(){
                if($('#user_type').val()=='SHOP_ADMIN' || $('#user_type').val()=='SHOP_DELIVERY_MAN'){
                    true;
                }else
                {
                    false;
                }
            }"],
            [['first_name', 'last_name'], 'string', 'max' => 100],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['username','phone','email'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'shop.name' => Yii::t('app', 'ٍSHOP_NAME'),
            'shop_id' => Yii::t('app', 'SHOP_NAME'),
            'first_name' => Yii::t('app', 'FIRST_NAME'),
            'last_name' => Yii::t('app', 'LAST_NAME'),
            'username' => Yii::t('app', 'USERNAME'),
            'auth_key' => Yii::t('app', 'AUTH_KEY'),
            'password_hash' => Yii::t('app', 'PASSWORD'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'EMAIL'),
            'status' => Yii::t('app', 'STATUS'),
            'phone' => Yii::t('app', 'PHONE'),
            'user_type' => Yii::t('app', 'USER_TYPE'),
            'deleted' => Yii::t('app', 'ACTIVE'),
            'gender' => Yii::t('app', 'GENDER'),
            'is_fired' => Yii::t('app', 'IS_FIRED'),
            'lang' => Yii::t('app', 'LANGUAGE'),
            'subscribed' => Yii::t('app', 'Subscribed'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shops::className(), ['id' => 'shop_id']);
    }

    public function getUserShops()
    {
        return $this->hasMany(UserShops::className(), ['user_id' => 'id']);
    }
}
