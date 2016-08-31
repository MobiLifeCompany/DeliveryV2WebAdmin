<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OrderMapTrace */

$this->title = Yii::t('app', 'Create Order Map Trace');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Map Traces'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-map-trace-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
