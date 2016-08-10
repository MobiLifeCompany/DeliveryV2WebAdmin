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
 <?php 
      //$actionType =Yii::$app->controller->action->id;
       $validationUrl = ['item-categories/validation'];
       if (!$model->isNewRecord)
            $validationUrl['id'] = $model->id;

       /* $form = ActiveForm::begin(
                ['id'=>$model->formName(),
                'enableAjaxValidation'=>true,
                'validationUrl'=> $validationUrl,
                'options' => ['enctype'=>'multipart/form-data']]
                ); */
    ?>

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

    <?= $form->field($model, 'lang')->dropDownList([ 'en' => Yii::t('app', 'EN'), 'ar' => Yii::t('app', 'AR'), ], ['prompt' => Yii::t('app', 'LANGUAGE')]) ?>

    <?= $form->field($model, 'deleted')->dropDownList([ '0'=> Yii::t('app', 'YES'), '1'=>Yii::t('app', 'NO'), ], ['prompt' => Yii::t('app', 'STATUS')]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php  
$script = <<< JS
    $('form#{$model->formName()}').on('beforeSubmit', function(e)
    {
        var \$form = $(this);
        $.post(
            \$form.attr("action"),
            \$form.serialize()
        ).done(function(result){
            if(result == 1){
             //   $(\$form).trigger("reset");
                $.pjax.reload({container:'#modalGrid'});
               // $(document).find('#modal').modal('hide');
            }else
            {
               // $(\$form).trigger("reset");
               // $("#message").html(result);
            }
        }).fail(function(){
            console.log("server error");
        });
        return false;
    });
JS;
$this->registerJs($script);
?>