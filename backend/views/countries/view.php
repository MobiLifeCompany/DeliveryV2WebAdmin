<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Countries */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'COUNTRIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="countries-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'country_code',
            'iso_code',
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 1 ? Yii::t('app', 'NO') : Yii::t('app', 'YES')
            ],
            'lang',
            'created_at',
            'updated_at',
            'ar_name',
        ],
    ]) ?>

</div>
