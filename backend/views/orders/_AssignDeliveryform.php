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

       $query = User::find();
       $dataProvider = new \yii\data\ActiveDataProvider([
           'query' => $query,
           'pagination' => array('pageSize' => Yii::$app->params['pageSize']),
       ]);
       $query->joinWith('userShops');
       $query->orWhere(['user.shop_id'=>$sid]);
       $query->orWhere([
           'and',
           ['user.user_type'=>'CR_DELIVERY_MAN'],
          // ['in','user_shops.shop_id',$userShops],
       ]);
       $query->distinct();
       $result = [];
       foreach($dataProvider->getModels() as $xxx ){
           $result[$xxx->id] = $xxx;
       }
    ?>

     <?= $form->field($model, 'delivery_user_id')->dropDownList(
                    ArrayHelper::map($result,'id','username'),
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