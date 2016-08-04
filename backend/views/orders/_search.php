<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

 <div class="box-header">
    <div class="box-tools">
        <div class="input-group input-group-sm" style="width: 200px;">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                 'fieldConfig' => [
                    'template' => '<div class="input-group"><span class="input-group-btn">'.
                    '<button class="btn btn-default"><i class="fa fa-search"></i></button></span>{input}</div>',
                    'options' => [
                        'tag' => false,
                         ],
                     ],
                 ]); ?>
                 <p class="text-items">
                <?= $form->field($model, 'ordersGlobalSearch')->textInput(['maxlength' => 255, 'class' => 'form-control', 'placeholder' => 'Search'])->label(false); ?>
                </p>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
