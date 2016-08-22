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
      // filter shops according to user permissions
         $userShops = Yii::$app->session['userShops'];
     ?> 

    <?= $form->field($model, 'shop_id')->dropDownList(
                    ArrayHelper::map(Shops::find()->where(['in','id',$userShops])->all(),'id','name'),
                    ['prompt' => Yii::t('app', 'SELECT_SHOP')]);
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

    <?= $form->field($model, 'active')->dropDownList([ '0'=> Yii::t('app', 'NO'), '1'=>Yii::t('app', 'YES'), ], ['prompt' => Yii::t('app', 'STATUS')]) ?>

    <?= $form->field($model, 'deleted')->dropDownList([ '0'=> Yii::t('app', 'NO'), '1'=>Yii::t('app', 'YES'), ], ['prompt' => Yii::t('app', 'STATUS')]) ?>

    <?= $form->field($model, 'lang')->dropDownList([ 'en' => Yii::t('app', 'EN'), 'ar' => Yii::t('app', 'AR'), ], ['prompt' => Yii::t('app', 'LANGUAGE')]) ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<script>
    $("select").select2();
</script>
</div>

