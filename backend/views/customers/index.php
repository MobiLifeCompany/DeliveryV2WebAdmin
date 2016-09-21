<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CustomersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'CUSTOMERS');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
?>
<div class="customers-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <br/>
 <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'CUSTOMERS').'</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
 ?>
<?php Pjax::begin(['id'=>'modalGrid']);?>   
<?= GridView::widget([
        'dataProvider' => $dataProvider,
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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
           // 'password_digest',
           // 'confirmation_token',
           // 'auth_token',
             'full_name',
             'phone',
             'mobile',
             [
	            'attribute' => 'is_allowed',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->is_allowed ==1){
		               return "<span class= 'label label-success'>".Yii::t('app', 'YES')."</span>";
                    }
                    else {
                        return "<span class= 'label label-danger'>".Yii::t('app', 'NO')."</span>";
                    }    
	            }
	        ],
            // 'photo',
              [
	            'attribute' => 'gender',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->gender =='Male'){
		                return "<span class= 'label label-danger'>".Yii::t('app', 'MALE')."</span>";
                    }
                    else {
                        return "<span class= 'label label-success'>".Yii::t('app', 'FEMALE')."</span>";
                    }    
	            }
	        ],
            // 'is_allowed',
            // 'unlock_token',
            // 'confirmed_at',
            // 'locked_at',
            // 'sms_count',
            // 'lang',
            // 'created_at',
            // 'updated_at',
             'email:email',
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a(Yii::t('app', 'ADDRESSES'),'index.php?r=customer-addresses/details&id='.$model->id,['class'=>'badge bg-light-blue']); },
            ],
           [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a(Yii::t('app', 'ORDERS'),'index.php?r=orders/details&id='.$model->id,['class'=>'badge bg-light-blue']); },
            ],
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    },
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>$url,'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                    }    
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
