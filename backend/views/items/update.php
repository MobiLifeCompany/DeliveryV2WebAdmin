<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Items */

$this->title = Yii::t('app', 'UPDATE') .' ' .Yii::t('app', 'ITEMS'). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ITEMS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="items-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
