<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "message".
 *
 * @property string $id
 * @property string $toUserId
 * @property string $message
 * @property integer $new
 */
class Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'message';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['toUserId', 'message'], 'required'],
            [['toUserId', 'new'], 'integer'],
            [['message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'toUserId' => Yii::t('app', 'To User ID'),
            'message' => Yii::t('app', 'Message'),
            'new' => Yii::t('app', 'New'),
        ];
    }

    public function actionMessage()
    {
        $sse = new \app\components\SSE();
        $counter = rand(1, 10);
        $t = time();

        //$sse->retry(3000);
        while ((time() - $t) < 15) {
            // Every second, sent a "ping" event.

            $curDate = date(DATE_ISO8601);
            $sse->event('ping',['time' => $curDate]);

            // Send a simple message at random intervals.

            $counter--;
            if (!$counter) {
                $sse->message("This is a message at time $curDate");
                $counter = rand(1, 10);
            }

            $sse->flush();
            sleep(1);
        }
        exit();
    }
}
