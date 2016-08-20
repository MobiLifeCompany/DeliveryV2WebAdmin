<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthAssignment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-assignment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userPermissions_ids')->listBox(
                    ArrayHelper::map(AuthItem::find()->where(['type' => 2])->all(),'name','name'), 
                    ['multiple' => 'true']);
     ?>

     <?= $form->field($model, 'userPermissionGroups_ids')->listBox(
                    ArrayHelper::map(AuthItem::find()->where(['type' => 1])->all(),'name','name'), 
                    ['multiple' => 'true']);
     ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'UPDATE'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
<script>
    $("select").select2();
</script>

</div>
