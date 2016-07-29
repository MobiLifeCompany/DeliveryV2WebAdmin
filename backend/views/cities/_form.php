<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Countries;
use backend\models\Cities;

/* @var $this yii\web\View */
/* @var $model backend\models\Cities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cities-form">

    <?php  
       $validationUrl = ['cities/validation'];
       if (!$model->isNewRecord)
            $validationUrl['id'] = $model->id;

        $form = ActiveForm::begin(
                ['id'=>$model->formName(),
                'enableAjaxValidation'=>true,
                'validationUrl'=> $validationUrl]); 
    ?>

    <?= $form->field($model, 'country_id')->dropDownList(
                    ArrayHelper::map(Countries::find()->all(),'id','name'), 
                    ['prompt' => 'Select Country']);
     ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deleted')->dropDownList([ '0'=> 'No', '1'=>'Yes', ], ['prompt' => 'Status']) ?>

    <?= $form->field($model, 'lang')->dropDownList([ 'en' => 'En', 'ar' => 'Ar', ], ['prompt' => 'Language']) ?>

    <?= $form->field($model, 'ar_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
                $(\$form).trigger("reset");
                $.pjax.reload({container:'#modalGrid'});
                $(document).find('#modal').modal('hide');
            }else
            {
                $(\$form).trigger("reset");
                $("#message").html(result);
            }
        }).fail(function(){
            console.log("server error");
        });
        return false;
    });
JS;
$this->registerJs($script);
?>