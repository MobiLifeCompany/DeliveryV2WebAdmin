<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\ItemCategories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="item-categories-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_name')->textInput(['maxlength' => true]) ?>

    <?php if(isset($model->photo) && $model->photo != '') 
                echo $form->field($model, 'photo')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => ['previewFileType' => 'image',
                                        'showUpload' => false,
                                        'initialPreview'=>"images/categories/".$model->id."/".$model->photo."",
                                        'initialPreviewAsData'=>true,
                                        'initialCaption'=>$model->photo,
                                        'overwriteInitial'=>true,
                                    ],]);
            else
                echo $form->field($model, 'photo')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => ['previewFileType' => 'image',
                                        'showUpload' => false,
                                    ],]);
    ?>

    <?= $form->field($model, 'lang')->dropDownList([ 'en' => 'En', 'ar' => 'Ar', ], ['prompt' => 'Language']) ?>

    <?= $form->field($model, 'deleted')->dropDownList([ '0'=> 'No', '1'=>'Yes', ], ['prompt' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
