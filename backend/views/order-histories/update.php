<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderHistories */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Order Histories',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Histories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'order_id' => $model->order_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="order-histories-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
