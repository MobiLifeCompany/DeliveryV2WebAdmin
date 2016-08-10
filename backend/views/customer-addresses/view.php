<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerAddresses */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CUSTOMER_ADDRESSES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-addresses-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'customer_id',
             'value'=>$model->customer->full_name
            ],
             ['attribute' => 'city_id',
             'value'=>$model->city->name
            ],
             ['attribute' => 'area_id',
             'value'=>$model->area->name
            ],
            'street',
            'building',
            'floor',
            'details',
            'phone',
            'email:email',
            'latitude',
            'longitude',
            [
                'attribute'=>'is_default',
                'value' =>  $model->deleted == 0 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 0 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
