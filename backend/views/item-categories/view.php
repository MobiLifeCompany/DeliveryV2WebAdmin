<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemCategories */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ITEM_CATEGORIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="item-categories-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'ar_name',
            [
                'attribute'=>'photo',
                'value' =>  "images/categories/".$model->id."/".$model->photo."",
                'format' => ['image',['height'=>'100']],
            ],
            'lang',
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 0 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
