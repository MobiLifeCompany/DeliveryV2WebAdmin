<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopOffers */

$this->title = Yii::t('app', 'UPDATE') . ' ' . Yii::t('app', 'OFFER') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shop Offers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shop-offers-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
