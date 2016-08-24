<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\OpeningHours */

$this->title = Yii::t('app', 'Create Opening Hours');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Opening Hours'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="opening-hours-create">

    <?= $this->renderAjax('_form', [
        'model' => $model,
        'remainDays' => $remainDays,
        'hours' => $hours,
    ]) ?>

</div>
