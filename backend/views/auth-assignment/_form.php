<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($userPermissionmodel, 'userPermissions_ids')->checkboxList($model1); ?>

    <?= $form->field($userPermissionGroupsmodel, 'userPermissionGroups_ids')->checkboxList($model2); ?>

    <div class="form-group">
        <?= Html::submitButton( Yii::t('app', 'Update'), ['class' =>  'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
