<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopRates */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shop Rates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shop-rates-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'customer_id',
             'value'=>$model->customer->full_name
            ],
            ['attribute' => 'shop_id',
             'value'=>$model->shop->name
            ],
            ['attribute' => 'order_id',
             'value'=>$model->order->id
            ],
            'rate',
        ],
    ]) ?>

</div>
