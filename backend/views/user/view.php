<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('app', 'USER_DETAILS').': '. $model->first_name.' '.$model->last_name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'USERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'username',
            'shop_id',
            'email:email',
            'phone',
            'user_type',
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 1 ? Yii::t('app', 'NO') : Yii::t('app', 'YES')
            ],
            'gender',
           // 'is_fired',
           // 'lang',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
