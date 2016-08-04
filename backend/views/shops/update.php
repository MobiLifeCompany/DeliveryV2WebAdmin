<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Shops */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Shops',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shops-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
