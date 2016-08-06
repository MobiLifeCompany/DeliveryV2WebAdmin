<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerAddresses */


$this->title = $model->name.' Shop No# '.$model->id;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shop Addresses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => ''.$model->name.' No# '.$model->id, 'url' => 'index.php?r=shops/vmap&id='.$model->id];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="customer-addresses-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_mapForm', [
        'model' => $model,
    ]) ?>

</div>
