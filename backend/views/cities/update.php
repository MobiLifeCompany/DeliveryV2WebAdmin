<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Cities */

$this->title = Yii::t('app', 'UPDATE') . ' ' . Yii::t('app', 'CITIES'). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CITIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="cities-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
