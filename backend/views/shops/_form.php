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
                    ['prompt' => Yii::t('app', 'SELECT_BUSINESS')]);
     ?>

     <?= $form->field($model, 'area_id')->dropDownList(
                    ArrayHelper::map(Areas::find()->all(),'id','name'), 
                    ['prompt' => Yii::t('app', 'SELECT_AREA')]);
     ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_avilable')->dropDownList([ '0'=> Yii::t('app', 'NO'), '1'=>Yii::t('app', 'YES'), ], ['prompt' => Yii::t('app', 'AVALABILITY')]) ?>

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

    <?= $form->field($model, 'deleted')->dropDownList([ '0'=> Yii::t('app', 'YES'), '1'=>Yii::t('app', 'NO'), ], ['prompt' => Yii::t('app', 'STATUS')]) ?>

    <?= $form->field($model, 'lang')->dropDownList([ 'en' => Yii::t('app', 'EN'), 'ar' => Yii::t('app', 'AR'), ], ['prompt' => Yii::t('app', 'LANGUAGE')]) ?>

    <?= $form->field($model, 'rating')->dropDownList([ '1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'], ['prompt' => Yii::t('app', 'RATING')]) ?>

    <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscribed')->dropDownList([ '0'=> Yii::t('app', 'NO'), '1'=>Yii::t('app', 'YES'), ], ['prompt' => Yii::t('app', 'STATUS')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
