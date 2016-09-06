<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Businesses */

$this->title = Yii::t('app', 'CREATE_BUSINESSES');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Businesses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="businesses-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
