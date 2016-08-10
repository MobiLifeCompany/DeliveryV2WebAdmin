<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Items */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ITEMS'), 'url' => ['index']];
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
            ['attribute' => 'shop_id',
             'value'=>$model->shopItemCategory->shop->name
            ],
            ['attribute' => 'item_category_id',
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
                'value' =>  $model->active == 1 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 1 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            'lang',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
