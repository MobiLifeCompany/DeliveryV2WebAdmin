<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Shops;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php 
      //$actionType =Yii::$app->controller->action->id;
       $validationUrl = ['user/validation'];
       if (!$model->isNewRecord)
            $validationUrl['id'] = $model->id;

        $form = ActiveForm::begin(
                ['id'=>$model->formName(),
                'enableAjaxValidation'=>true,
                'validationUrl'=> $validationUrl]); 
    ?>

     <?= $form->field($model, 'shop_id')->dropDownList(
                    ArrayHelper::map(Shops::find()->all(),'id','name'), 
                    ['prompt' => Yii::t('app', 'SELECT_SHOP')]);
                    
     ?>

     <?php 
        $secretKey = Yii::$app->params['secretKey'];
        $decryptedPassword = Yii::$app->getSecurity()->decryptByKey(utf8_decode($model->password_hash), $secretKey);
        $model->password_hash=$decryptedPassword;    
     ?>
 
    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash',['options' => ['autocomplete' => 'off']])->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'user_type')->dropDownList([ 'SHOP_ADMIN' => 'SHOP ADMIN', 'SHOP_DELIVERY_MAN' => 'SHOP DELIVERY MAN', 'CR_ADMIN' => 'CR ADMIN', 'CR_DELIVERY_MAN' => 'CR DELIVERY MAN', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'gender')->dropDownList([ 'Male' => Yii::t('app', 'MALE'), 'Female' => Yii::t('app', 'FEMALE'), ], ['prompt' => '']) ?>

    <?= $form->field($model, 'deleted')->dropDownList([ 'Yes' => Yii::t('app', 'NO'), 'No' => Yii::t('app', 'YES'), ], ['prompt' => '']) ?>

    <?php //$form->field($model, 'is_fired')->dropDownList([ 'Yes' => 'Yes', 'No' => 'No', ], ['prompt' => '']) ?>

    <?php //$form->field($model, 'lang')->dropDownList([ 'Ar' => 'Ar', 'En' => 'En', ], ['prompt' => '']) ?>

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