<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Shops;
use backend\models\Areas;

/* @var $this yii\web\View */
/* @var $model backend\models\Shops */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shops'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shops-areas">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'area_id')->listBox(
                    ArrayHelper::map(Areas::find()->all(),'id','name'), 
                    ['multiple' => 'true']);
     ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Update'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
<script>
    $("select").select2();
</script>
</div>
