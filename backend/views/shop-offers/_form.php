<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Shops;
use backend\models\Items;
use kartik\file\FileInput;
use dosamigos\datepicker\DatePicker;
use dosamigos\datepicker\DateRangePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopOffers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-offers-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=>'multipart/form-data']]); ?>

    <?=
        $form->field($model, 'shop_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Shops::find()->all(),'id','name'),
            'options' => ['placeholder' =>  Yii::t('app', 'SELECT_SHOP')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?=
        $form->field($model, 'item_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Items::find()->all(),'id','name'),
            'options' => ['placeholder' =>  Yii::t('app', 'SELECT_ITEM')],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'short_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ar_short_description')->textInput(['maxlength' => true]) ?>

    <?php if(isset($model->photo)) 
                echo $form->field($model, 'photo')->widget(FileInput::classname(), [
                    'options' => ['accept' => 'image/*'],
                    'pluginOptions' => ['previewFileType' => 'image',
                                        'showUpload' => false,
                                        'initialPreview'=>"images/offers/".$model->id."/".$model->photo."",
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

    <?= $form->field($model, 'from_date')->widget(DateRangePicker::className(), [
            'attributeTo' => 'to_date', 
            'form' => $form, // best for correct client validation
            'clientOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ]);
    ?>

    <?= $form->field($model, 'active')->dropDownList([ '0' => Yii::t('app', 'NO'), '1' => Yii::t('app', 'YES'), ], ['prompt' => Yii::t('app', 'STATUS')]) ?>

    <?= $form->field($model, 'offer_type')->dropDownList([ 'GOLDEN' => Yii::t('app', 'GOLDEN'), 'SILVER' => Yii::t('app', 'SILVER'), ], ['prompt' => Yii::t('app', 'OFFER_TYPE')]) ?>

    <?= $form->field($model, 'lang')->dropDownList([ 'en' => Yii::t('app', 'EN'), 'ar' => Yii::t('app', 'AR'), ], ['prompt' => Yii::t('app', 'LANGUAGE')]) ?>

    <?= $form->field($model, 'clickable')->dropDownList([ '0' => Yii::t('app', 'NO'), '1' => Yii::t('app', 'YES'), ], ['prompt' => Yii::t('app', 'ACTIVE')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
