<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ShopDeliveryAreas */

$this->title = Yii::t('app', 'Create Shop Delivery Areas');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shop Delivery Areas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-delivery-areas-create">

    <?= $this->render('_form', [
        'model' => $model,
        'remainAreas' =>  $remainAreas,
    ]) ?>

</div>
