<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Businesses */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'BUSINESSES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'ar_name',
            [
                'attribute'=>'photo',
                'value' =>  "images/businesses/".$model->id."/".$model->photo."",
                'format' => ['image',['height'=>'100']],
            ],
             [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 1 ? Yii::t('app', 'NO') : Yii::t('app', 'YES')
            ],
            'lang',
            'created_at',
            'updated_at',
            
        ],
    ]) ?>

</div>
