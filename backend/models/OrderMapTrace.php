<?php

namespace backend\models;

use Yii;
use yii\data\ActiveDataProvider;
/**
 * This is the model class for table "order_map_trace".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $order_id
 * @property double $Longitude
 * @property double $Latitude
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 * @property Orders $order
 */
class OrderMapTrace extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_map_trace';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'Latitude'], 'required'],
            [['user_id'], 'integer'],
            [['Longitude', 'Latitude'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'Longitude' => Yii::t('app', 'Longitude'),
            'Latitude' => Yii::t('app', 'Latitude'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getUserMapTrace($userId)
    {
        $query = OrderMapTrace::find()->where(['user_id' => $userId]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $dataProvider;

    }

}
