<?php

use yii\bootstrap\ActiveForm;
use backend\models\MapOrder;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;


$this->title = Yii::t('app', 'SEND_NOTIFICATION');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
$this->params['currentPageAction'] = Yii::$app->controller->action->id;

?>

<br/>
<br/>

<?php
    Modal::begin([
            'header'=>'<h4>'.Yii::t('app', 'DETAILS').'</h4>',
            'options' => [
                'id' => 'modal',
                'tabindex' => false] // important for Select2 to work properly
            ]);
        echo "<div id='modalContent'></div>";
    Modal::end();

    if(Yii::$app->session->hasFlash('success')){
        echo "<div class='alert alert-success'>".Yii::$app->session->getFlash('success')."</div>"; 
        Yii::$app->session->removeFlash('success');
    }else if(Yii::$app->session->hasFlash('error')){
        echo "<div class='alert alert-danger'>".Yii::$app->session->getFlash('error')."</div>"; 
        Yii::$app->session->removeFlash('error');
    }
?>

<?php $form = ActiveForm::begin(); ?>


<?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'message')->textarea(['rows' => 4]) ?>


<?php
        echo GridView::widget([
        'dataProvider' => $customers,
        'export' =>false,
         'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'layout'=>"{items}\n{summary}\n{pager}",
        'responsiveWrap' => false,
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body'
        ],
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn', 
                'checkboxOptions'=>function ($model, $key, $index){
                    if($model['is_allowed']==0 || empty($model['gcm_id']) ){
                    return  ['id'=>"chk_{$model['id']}",
                                  'checked' => false,
                                  'disabled' => true,
                                  'name' => "chk_{$model['gcm_id']}",
                                  'value' => "chk_{$model['gcm_id']}"];
                    }else{
                      return  ['id'=>"chk_{$model['id']}",
                                  'checked' => false,
                                  'name' => "chk_{$model['gcm_id']}",
                                  'value' => "chk_{$model['gcm_id']}"];   
                    }
                },
            ],
            ['class' => 'yii\grid\SerialColumn'],
             'id',
            'username',
            'full_name',
            'phone',
            'mobile',
             [
	            'attribute' => 'is_allowed',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model['is_allowed'] ==1){
		               return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }    
	            }
	        ],
            // 'photo',
              [
	            'attribute' => 'gender',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model['gender'] =='Male'){
		                return Html::a(Yii::t('app', 'MALE'),'#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'FEMALE'),'#',['class'=>'label label-success']);
                    }    
	            }
	        ],
             'email:email',
            
        ],
    ]); 
?>
<br/>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'SEND_NOTIFICATION'), ['class' =>  'btn btn-success']) ?>
    </div>
   <br/>
<?php ActiveForm::end(); ?>
