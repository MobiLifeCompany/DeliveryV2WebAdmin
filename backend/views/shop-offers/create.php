<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\ShopOffers */

$this->title = Yii::t('app', 'CREATE') . ' ' . Yii::t('app', 'SHOP_OFFERS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SHOP_OFFERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-offers-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
