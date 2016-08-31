<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Orders */

$this->title = Yii::t('app', 'UPDATE_ORDER_STATUS#: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ORDERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="order-status-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_changeOrderStatusForm', [
        'model' => $model,
    ]) ?>
</div>
