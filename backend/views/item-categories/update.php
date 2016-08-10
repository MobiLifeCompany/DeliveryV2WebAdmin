<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemCategories */

$this->title = Yii::t('app', 'UPDATE') . ' '. Yii::t('app', 'ITEM_CATEGORIES'). ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ITEM_CATEGORIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'UPDATE');
?>
<div class="item-categories-update">

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
