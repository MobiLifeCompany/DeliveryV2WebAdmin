<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\OpeningHours */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="opening-hours-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
        if($model->isNewRecord)
            echo $form->field($model, 'day_name')->dropDownList($remainDays, ['prompt' => Yii::t('app', 'SELECT_DAY')]);
        else
            echo $form->field($model, 'day_name')->textInput(['disabled' => 'disabled']);
    ?>

    <?= $form->field($model, 'from_hour')->dropDownList($hours, ['prompt' => Yii::t('app', 'FROM_HOUR')]); ?>

    <?= $form->field($model, 'to_hour')->dropDownList($hours, ['prompt' => Yii::t('app', 'TO_HOUR')]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
