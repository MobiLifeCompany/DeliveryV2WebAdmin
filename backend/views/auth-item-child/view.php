<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItemChild */

$this->title = $model->parent;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Item Children'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-child-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'parent',
            'child',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
