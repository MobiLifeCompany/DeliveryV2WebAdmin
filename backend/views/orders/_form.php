<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Shops;
use backend\models\Customers;
use backend\models\CustomerAddresses;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

   <?php 

       $validationUrl = ['orders/validation'];
       if (!$model->isNewRecord)
            $validationUrl['id'] = $model->id;

        $form = ActiveForm::begin(
                ['id'=>$model->formName(),
                'enableAjaxValidation'=>true,
                'validationUrl'=> $validationUrl]); 
    ?>

     <?= $form->field($model, 'customer_id')->dropDownList(
                    ArrayHelper::map(Customers::find()->all(),'id','full_name'), 
                    ['prompt' => 'Select Customer', 'disabled'=>'disabled' ]);
                    
     ?>
    
    <?= $form->field($model, 'shop_id')->dropDownList(
                    ArrayHelper::map(Shops::find()->all(),'id','name'), 
                    ['prompt' => 'Select Shop', 'disabled'=>'disabled']);
                    
     ?>

     <?= $form->field($model, 'customer_address_id')->dropDownList(
                    ArrayHelper::map(CustomerAddresses::find()->where(['customer_id'=>$model->customer->id])->all(),'id',function($model, $defaultValue) {
                     return '['.$model->city->name.'] - '
                     .'['.$model->area->name.'] - '
                     .'['.$model->street.'] - '
                     .'['.$model->building.'] - '
                     .'['.$model->floor.']';
        }), 
                    ['prompt' => 'Select Address']);
                    
     ?>

    <?= $form->field($model, 'order_status')->dropDownList([ 'OPEN' => 'OPEN', 'PENDING' => 'PENDING', 'CANCEL' => 'CANCEL', 'CLOSED' => 'CLOSED','RE-OPEN' => 'RE-OPEN', ], ['prompt' => '']) ?>

     <?= $form->field($model, 'delivery_charge')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <?= $form->field($model, 'total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cancel_reason')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?> 

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