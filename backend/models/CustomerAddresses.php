<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_addresses".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property integer $city_id
 * @property integer $area_id
 * @property string $street
 * @property string $building
 * @property string $floor
 * @property string $details
 * @property string $phone
 * @property string $email
 * @property string $latitude
 * @property string $longitude
 * @property integer $is_default
 * @property integer $deleted
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Customers $customer
 */
class CustomerAddresses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customer_addresses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'city_id', 'area_id', 'phone', 'email'], 'required'],
            [['customer_id', 'city_id', 'area_id', 'is_default', 'deleted'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['street', 'building', 'floor', 'details', 'latitude', 'longitude'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customers::className(), 'targetAttribute' => ['customer_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer ID'),
            'city_id' => Yii::t('app', 'City ID'),
            'area_id' => Yii::t('app', 'Area ID'),
            'street' => Yii::t('app', 'Street'),
            'building' => Yii::t('app', 'Building'),
            'floor' => Yii::t('app', 'Floor'),
            'details' => Yii::t('app', 'Details'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'latitude' => Yii::t('app', 'Latitude'),
            'longitude' => Yii::t('app', 'Longitude'),
            'is_default' => Yii::t('app', 'Is Default'),
            'deleted' => Yii::t('app', 'Deleted'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }
}
