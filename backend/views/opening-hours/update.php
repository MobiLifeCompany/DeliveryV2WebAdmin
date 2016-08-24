<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OpeningHours */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Opening Hours',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Opening Hours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="opening-hours-update">

    <?= $this->render('_form', [
        'model' => $model,
        'hours' => $hours,
    ]) ?>

</div>
