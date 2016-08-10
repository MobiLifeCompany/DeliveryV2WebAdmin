<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CustomerAddresses */

$this->title = Yii::t('app', 'CREATE') . ' ' . Yii::t('app', 'CUSTOMER_ADDRESSES');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CUSTOMER_ADDRESSES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-addresses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
