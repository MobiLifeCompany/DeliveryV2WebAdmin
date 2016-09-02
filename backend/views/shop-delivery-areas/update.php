<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopDeliveryAreas */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Shop Delivery Areas',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shop Delivery Areas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shop-delivery-areas-update">

    <?= $this->render('_form', [
        'model' => $model,
        'allAreas' => $allAreas,
    ]) ?>

</div>
