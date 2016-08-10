<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Areas */

$this->title = Yii::t('app', 'UPDATE') .' '.Yii::t('app', 'AREAS') .' '  . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Areas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="areas-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
