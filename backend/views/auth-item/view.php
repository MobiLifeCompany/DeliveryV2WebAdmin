<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItem */

$this->title = 'View Permission';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Items'), 'url' => ['index']];
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
                'value' =>  $model->type == 1 ? 'Group Permission' : 'User Permission'
            ],   
            'description:ntext',
           // 'rule_name',
           // 'data:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
