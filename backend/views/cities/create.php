<?php

use yii\helpers\Html;
use backend\assets\AppAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\Cities */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CITIES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cities-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
