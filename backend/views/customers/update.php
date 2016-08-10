<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Customers */

$this->title = Yii::t('app', 'UPDATE') . ' ' . Yii::t('app', 'CUSTOMERS') . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CUSTOMERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="customers-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
