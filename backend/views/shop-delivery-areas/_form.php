<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ShopDeliveryAreas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-delivery-areas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        if($model->isNewRecord)
            echo $form->field($model, 'area_id')->dropDownList($remainAreas, ['prompt' => Yii::t('app', 'SELECT_AREA')]);
        else
            echo $form->field($model, 'area_id')->dropDownList($allAreas, ['disabled' => 'disabled']);
    ?>

   <?= $form->field($model, 'delivery_charge')->textInput() ?>

   <?= $form->field($model, 'deleted')->dropDownList([ 0 => Yii::t('app', 'NO'), 1 => Yii::t('app', 'YES'), ], ['prompt' => '']) ?>


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
