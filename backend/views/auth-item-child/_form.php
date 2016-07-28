<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\AuthItemChild;
use backend\models\AuthItem;

/* @var $this yii\web\View */
/* @var $model backend\models\AuthItemChild */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="auth-item-child-form">

     <?php 
        $validationUrl = ['auth-item-child/validation'];
       if (!$model->isNewRecord){
            $validationUrl['parent'] = $model->parent;
            $validationUrl['child'] = $model->child;
        }

        $form = ActiveForm::begin(
                ['id'=>$model->formName(),
                'enableAjaxValidation'=>true,
                'validationUrl'=> $validationUrl]); 
    ?>

     <?= $form->field($model, 'parent')->dropDownList(
                    ArrayHelper::map(AuthItem::find()->where(['type' => 1])->all(),'name','name'), 
                    ['prompt' => 'Select Parent Permission']);
     ?>

    <?= $form->field($model, 'child')->dropDownList(
                    ArrayHelper::map(AuthItem::find()->where(['type' => 2])->all(),'name','name'), 
                    ['prompt' => 'Select Child Permission']);
     ?>

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