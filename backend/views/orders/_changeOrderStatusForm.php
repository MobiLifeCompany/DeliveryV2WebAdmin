<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\User;
use backend\models\Customers;
use backend\models\CustomerAddresses;
use yii\helpers\Url;
use yii\web\JsExpression;




/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

   <?php 
        $form = ActiveForm::begin(['id'=>$model->formName(),]); 
    ?>

      <?= $form->field($model, 'order_status')->dropDownList([ 'OPEN' => Yii::t('app', 'OPEN'), 'PENDING' => Yii::t('app', 'PENDING'), 'CANCEL' => Yii::t('app', 'CANCELED'), 'CLOSED' => Yii::t('app', 'CLOSED'),'RE-OPEN' => Yii::t('app', 'REOPEN'), ], ['prompt' => Yii::t('app', 'STATUS'),
        'onchange'=>
                'if($(this).val() == "CANCEL")
                    {
                        document.getElementById("orders-cancel_reason").disabled = false;
                    } 
                    else 
                    {
                        document.getElementById("orders-cancel_reason").disabled = true;
                    }',
                ]) 
     ?>
                    

    <?= $form->field($model, 'cancel_reason')->textInput(['maxlength' => true, 'disabled'=> ($model->order_status == 'CANCEL')? "disabled" : ""]) ?>

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