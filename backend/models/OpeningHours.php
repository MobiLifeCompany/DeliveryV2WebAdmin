<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "opening_hours".
 *
 * @property integer $id
 * @property integer $shop_id
 * @property string $day_name
 * @property integer $from_hour
 * @property integer $to_hour
 * @property integer $full_day
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Shops $shop
 */
class OpeningHours extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'opening_hours';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['shop_id', 'from_hour', 'to_hour'], 'required'],
            [['shop_id', 'from_hour', 'to_hour', 'full_day'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['day_name'], 'string', 'max' => 255],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shops::className(), 'targetAttribute' => ['shop_id' => 'id']],
            [['to_hour'], 'compare', 'compareAttribute' => 'from_hour', 'operator' => '>'],
            [['from_hour'], 'compare', 'compareAttribute' => 'to_hour', 'operator' => '<'],
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
            'day_name' => Yii::t('app', 'DAY'),
            'from_hour' => Yii::t('app', 'FROM_HOUR'),
            'to_hour' => Yii::t('app', 'TO_HOUR'),
            'full_day' => Yii::t('app', 'Full Day'),
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOpeningHours($shopId)
    {
        $query = OpeningHours::find()->where(['shop_id' => $shopId]);
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;

    }
}
