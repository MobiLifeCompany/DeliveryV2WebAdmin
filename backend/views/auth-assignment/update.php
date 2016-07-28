<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */

$this->title = 'User Permissions';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Auth Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="auth-assignment-update">

    <?= $this->render('_form', [
        'userPermissionmodel'=>$userPermissionmodel,
        'userPermissionGroupsmodel'=>$userPermissionGroupsmodel,
        'model1'=>$userPermissionAuthItemModel,
        'model2'=>$userPermissionAuthItemGroupModel,
    ]) ?>

</div>
