<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Items */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description',
            'ar_name',
            'ar_description',
            ['attribute' => 'shop',
             'value'=>$model->shopItemCategory->shop->name
            ],
            ['attribute' => 'category',
             'value'=>$model->shopItemCategory->itemCategory->name
            ],
            'price',
            [
                'attribute'=>'photo',
                'value' =>  "images/items/".$model->id."/".$model->photo."",
                'format' => ['image',['height'=>'100']],
            ],
            [
                'attribute'=>'is_avilable',
                'value' =>  $model->active == 1 ? 'Yes' : 'No'
            ],
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 1 ? 'Yes' : 'No'
            ],
            'lang',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
