<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Items */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SHOPS_ITEMS'), 'url' => ['items/details','id'=>$_GET['id']]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="items-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
