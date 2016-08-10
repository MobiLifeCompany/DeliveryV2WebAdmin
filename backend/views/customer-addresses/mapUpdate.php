<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerAddresses */

$this->title = Yii::t('app', 'UPDATE') . ' ' . Yii::t('app', 'CUSTOMER_ADDRESS_COORDINATES'). ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CUSTOMER_ADDRESSES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'View Address #'.$model->id, 'url' => 'index.php?r=customer-addresses/vmap&id='.$model->id];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="customer-addresses-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_mapForm', [
        'model' => $model,
    ]) ?>

</div>
