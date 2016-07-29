<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Areas */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="areas-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'city_id',
             'value'=> $city_name
            ],
            'name',
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 1 ? 'Yes' : 'No'
            ],
            'lang',
            'created_at',
            'updated_at',
            'ar_name',
        ],
    ]) ?>

</div>
