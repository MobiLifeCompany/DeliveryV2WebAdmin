<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\UserShops */

$this->title = Yii::t('app', 'Create User Shops');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Shops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-shops-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
