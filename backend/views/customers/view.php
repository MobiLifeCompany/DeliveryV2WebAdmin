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
            'password_digest',
            'confirmation_token',
            'auth_token',
            'full_name',
            'phone',
            'mobile',
            'photo',
            'gender',
            'is_allowed',
            'unlock_token',
            'confirmed_at',
            'locked_at',
            'sms_count',
            'lang',
            'created_at',
            'updated_at',
            'email:email',
        ],
    ]) ?>

</div>
