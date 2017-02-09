<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Shops;
use backend\models\ItemCategories;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Items */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="items-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

     <?php
         if($model->isNewRecord){
             $model->active = '1';
             $model->deleted = '0';
             $model->lang = 'ar';

             echo $form->field($model, 'active')->hiddenInput()->label(false);
             echo $form->field($model, 'deleted')->hiddenInput()->label(false);
             echo $form->field($model, 'lang')->hiddenInput()->label(false);
         }
     ?> 


    
    <?= $form->field($model, 'item_category_id')->dropDownList(
                    ArrayHelper::map(ItemCategories::find()->all(),'id','name'), 
                    ['prompt' => 'SELECT_CATEGORY']);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?php if(isset($model->photo)) 
                echo $form->field($model, 'photo')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => ['previewFileType' => 'image',
                                        'showUpload' => false,
                                        'initialPreview'=>"images/items/".$model->id."/".$model->photo."",
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

    <?php
    if(!$model->isNewRecord){
        echo $form->field($model, 'active')->dropDownList([ '0'=> Yii::t('app', 'NO'), '1'=>Yii::t('app', 'YES'), ], ['prompt' => Yii::t('app', 'STATUS')]);
        echo $form->field($model, 'deleted')->dropDownList([ '0'=> Yii::t('app', 'NO'), '1'=>Yii::t('app', 'YES'), ], ['prompt' => Yii::t('app', 'STATUS')]);
        echo $form->field($model, 'lang')->hiddenInput()->label(false);
    }
    ?>

    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<script>
    $("select").select2();
</script>
</div>

