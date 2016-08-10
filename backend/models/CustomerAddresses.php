<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
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
 * @property Areas $area
 * @property Cities $city
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
            [['customer_id', 'city_id', 'area_id', 'phone', 'email','street', 'building', 'floor', 'latitude', 'longitude'], 'required'],
            [['customer_id', 'city_id', 'area_id', 'is_default', 'deleted'], 'integer'],
            [['created_at', 'updated_at','customer_id', 'city_id', 'area_id', 'phone', 'email','street', 'building', 'floor', 'latitude', 'longitude'], 'safe'],
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
            'customer_id' => Yii::t('app', 'CUSTOMER'),
            'city_id' => Yii::t('app', 'CITY'),
            'area_id' => Yii::t('app', 'AREA'),
            'street' => Yii::t('app', 'STREET'),
            'building' => Yii::t('app', 'BUILDING'),
            'floor' => Yii::t('app', 'FLOOR'),
            'details' => Yii::t('app', 'DETAILS'),
            'phone' => Yii::t('app', 'PHONE'),
            'email' => Yii::t('app', 'EMAIL'),
            'latitude' => Yii::t('app', 'LATITUDE'),
            'longitude' => Yii::t('app', 'LONGITUDE'),
            'is_default' => Yii::t('app', 'IS_DEFAULT'),
            'deleted' => Yii::t('app', 'ACTIVE'),
            'created_at' => Yii::t('app', 'CREATED_AT'),
            'updated_at' => Yii::t('app', 'UPDATED_AT'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customers::className(), ['id' => 'customer_id']);
    }
    public function getArea()
    {
        return $this->hasOne(Areas::className(), ['id' => 'area_id']);
    }
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'city_id']);
    }

    public function getCustomerAddresses($id)
    {
        $query = CustomerAddresses::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['customer_id'=> $id]);

        return $dataProvider;
    }
    public function getCustomerById($id)
    {
        $query = Customers::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['id'=> $id]);

        return $dataProvider;
    }
}
