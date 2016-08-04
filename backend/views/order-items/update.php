<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OrderItems */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Order Items',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'order_id' => $model->order_id, 'item_id' => $model->item_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="order-items-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
