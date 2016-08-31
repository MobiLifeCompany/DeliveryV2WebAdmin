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
        $userShops = Yii::$app->session['userShops'];
        $users = User::find()->where(['in','shop_id',$userShops])->all();   
    ?>

     <?= $form->field($model, 'delivery_user_id')->dropDownList(
                    ArrayHelper::map($users,'id','username'), 
                    ['prompt' => Yii::t('app', 'SELECT_USER'),]);
                    
     ?>

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