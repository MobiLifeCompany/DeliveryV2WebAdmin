<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "contact_us".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property string $lang
 * @property integer $is_new
 */
class ContactUs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contact_us';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['message'], 'string'],
            [['is_new'], 'integer'],
            [['name'], 'string', 'max' => 145],
            [['email'], 'string', 'max' => 70],
            [['phone'], 'string', 'max' => 15],
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
            'name' => Yii::t('app', 'CUSTOMER'),
            'email' => Yii::t('app', 'EMAIL'),
            'phone' => Yii::t('app', 'PHONE'),
            'message' => Yii::t('app', 'MESSAGE'),
            'lang' => Yii::t('app', 'LANGUAGE'),
            'is_new' => Yii::t('app', 'STATUS'),
        ];
    }
}
