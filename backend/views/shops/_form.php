<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;
use backend\models\Shops;
use backend\models\Areas;
use backend\models\Businesses;
use kartik\file\FileInput;
use maksyutin\duallistbox\Widget;

/* @var $this yii\web\View */
/* @var $model backend\models\Shops */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shops-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'business_id')->dropDownList(
                    ArrayHelper::map(Businesses::find()->all(),'id','name'), 
                    ['prompt' => 'Select Business']);
     ?>

     <?= $form->field($model, 'area_id')->dropDownList(
                    ArrayHelper::map(Areas::find()->all(),'id','name'), 
                    ['prompt' => 'Select Area']);
     ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_avilable')->dropDownList([ '0'=> 'No', '1'=>'Yes', ], ['prompt' => 'Avalability']) ?>

    <?= $form->field($model, 'longitude')->widget(MaskedInput::className(), ['mask' => '99.9999999', ]) ?>

    <?= $form->field($model, 'latitude')->widget(MaskedInput::className(), ['mask' => '99.9999999', ]) ?>

    <?= $form->field($model, 'estimation_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'min_amount')->textInput() ?>

    <?= $form->field($model, 'delivery_expected_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'delivery_charge')->textInput() ?>

    <?= $form->field($model, 'promotion_note')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'warning_note')->textarea(['rows' => 2]) ?>

    <?php if(isset($model->photo)) 
                echo $form->field($model, 'photo')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => ['previewFileType' => 'image',
                                        'showUpload' => false,
                                        'initialPreview'=>"images/shops/".$model->id."/".$model->photo."",
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

    <?= $form->field($model, 'masteries')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'deleted')->dropDownList([ '0'=> 'No', '1'=>'Yes', ], ['prompt' => 'Status']) ?>

    <?= $form->field($model, 'lang')->dropDownList([ 'en' => 'En', 'ar' => 'Ar', ], ['prompt' => 'Language']) ?>

    <?= $form->field($model, 'rating')->dropDownList([ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], ['prompt' => 'Rating']) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscribed')->dropDownList([ '0'=> 'No', '1'=>'Yes', ], ['prompt' => 'Status']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
