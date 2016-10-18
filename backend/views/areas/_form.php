<?php

use backend\models\Areas;
use backend\models\Cities;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model backend\models\Areas */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="areas-form">

        <?php
        $validationUrl = ['areas/validation'];
        if (!$model->isNewRecord)
            $validationUrl['id'] = $model->id;

        $form = ActiveForm::begin(
            ['id' => $model->formName(),
                'enableAjaxValidation' => true,
                'validationUrl' => $validationUrl]);
        ?>

        <?= $form->field($model, 'city_id')->dropDownList(
            ArrayHelper::map(Cities::find()->all(), 'id', 'name'),
            ['prompt' => Yii::t('app', 'SELECT_CITY')]);
        ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'deleted')->dropDownList(['0' => Yii::t('app', 'YES'), '1' => Yii::t('app', 'NO'),], ['prompt' => Yii::t('app', 'STATUS')]) ?>

        <?= $form->field($model, 'lang')->dropDownList(['en' => Yii::t('app', 'EN'), 'ar' => Yii::t('app', 'AR'),], ['prompt' => Yii::t('app', 'LANGUAGE')]) ?>

        <?= $form->field($model, 'ar_name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'CREATE') : Yii::t('app', 'UPDATE'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$script = <<<  JS
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