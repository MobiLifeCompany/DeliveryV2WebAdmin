<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerAddresses */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Customer Addresses',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customer Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="customer-addresses-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
