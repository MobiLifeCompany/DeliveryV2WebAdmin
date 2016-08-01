<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\CustomerAddresses;
/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-view">

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
            ['attribute' => 'customer_address_id',
             'value'=>'['.CustomerAddresses::findOne($model->customer_address_id)->city->name.'] - '
                     .'['.CustomerAddresses::findOne($model->customer_address_id)->area->name.'] - '
                     .'['.CustomerAddresses::findOne($model->customer_address_id)->street.'] - '
                     .'['.CustomerAddresses::findOne($model->customer_address_id)->building.'] - '
                     .'['.CustomerAddresses::findOne($model->customer_address_id)->floor.']',
            ],
            'order_status',
            'qty',
            'delivery_charge',
            'total',
            'cancel_reason',
            'note:ntext',
            'created_at',
            'updated_at',
            
        ],
    ]) ?>

</div>
