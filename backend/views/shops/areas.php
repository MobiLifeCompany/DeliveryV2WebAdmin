<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Shops;
use backend\models\Areas;

/* @var $this yii\web\View */
/* @var $model backend\models\Shops */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SHOPS'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="shops-areas">

    <?php $form = ActiveForm::begin(); ?>

    <?php
        $shopId = Yii::$app->request->queryParams['id'];
        $shop = new Shops();
        $shop = $shop->getShopById($shopId);
        $cityId = $shop->getModels()[0]['city_id'];
        $allAreas = ArrayHelper::map(Areas::find()->where(['city_id'=>$cityId])->all(),'id','name');
    ?>

    <?= $form->field($model, 'area_id')->listBox($allAreas, ['multiple' => 'true']);
     ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'UPDATE'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    
<script>
    $("select").select2();
</script>
</div>
