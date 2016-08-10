<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = 'VIEW';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'AUTH_ITEMS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
             [
                'attribute'=>'Type',
                'value' =>  $model->type == 1 ? Yii::t('app', 'GROUP_PERMISSION') : Yii::t('app', 'USER_PERMISSION')
            ],   
            'description:ntext',
           // 'rule_name',
           // 'data:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
