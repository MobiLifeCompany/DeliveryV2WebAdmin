<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ContactUs */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CONTACT_US'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-us-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'email:email',
            'phone',
            'message:ntext',
        ],
    ]) ?>

</div>
