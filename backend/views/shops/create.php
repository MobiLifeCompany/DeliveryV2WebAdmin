<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Shops */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SHOPS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="shops-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
