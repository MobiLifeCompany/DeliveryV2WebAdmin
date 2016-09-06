<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Businesses */

$this->title = Yii::t('app', 'UPDATE_BUSINESSES');

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="businesses-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
