<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\AuthItemChild;
use backend\models\AuthItem;
use kartik\widgets\Select2

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

     <?php 
        echo $form->field($model, 'parent')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(AuthItem::find()->where(['type' => 1])->all(),'name','name'),
            'options' => ['placeholder' => 'Select Parent Permission ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);

        echo $form->field($model, 'child')->widget(Select2::classname(), [
            'data' =>ArrayHelper::map(AuthItem::find()->where(['type' => 2])->all(),'name','name'),
            'options' => ['placeholder' => 'Select Parent Permission ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]);
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