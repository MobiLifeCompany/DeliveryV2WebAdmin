<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
          //  'password_digest',
          //  'confirmation_token',
         //   'auth_token',
            'full_name',
            'phone',
            'mobile',
            'email:email',
           // 'photo',
             [
                'attribute'=>'gender',
                'value' =>  $model->gender == 'M' ? 'Male' : 'Female'
              ],
              [
                'attribute'=>'is_allowed',
                'value' =>  $model->is_allowed == 1 ? 'Yes' : 'No'
              ],
        //    'unlock_token',
        //    'confirmed_at',
       //     'locked_at',
        //    'sms_count',
       //     'lang',
            'created_at',
            'updated_at',
           
        ],
    ]) ?>

</div>
