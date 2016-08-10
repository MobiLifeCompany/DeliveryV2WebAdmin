<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Countries */

$this->title = Yii::t('app', 'Update') . ' ' . Yii::t('app', 'COUNTRIES'). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'COUNTRIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="countries-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
