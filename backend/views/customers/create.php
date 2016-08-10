<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Customers */

$this->title = Yii::t('app', 'CREATE') . ' ' . Yii::t('app', 'CUSTOMRS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CUSTOMERS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
