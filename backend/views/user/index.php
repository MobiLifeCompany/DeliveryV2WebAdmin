<?php

use yii\helpers\Html;
use yii\Helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

$this->title = Yii::t('app', 'USERS');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
        echo Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=user/create'),'id'=>'modalButton']);
    ?>
    <br/>
    <?php
        Modal::begin([
                'header'=>'<h4>'. Yii::t('app', 'USERS') .'</h4>',
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
           // 'first_name',
           // 'last_name',
            'username',
             ['attribute' => 'shop_id',
             'value'=>'shop.name'
            ],
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            // 'email:email',
            // 'status',
           //  'phone',
             'user_type',
              [
	            'attribute' => 'deleted',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->deleted =='Yes'){
		                return Html::a('No','#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a('Yes','#',['class'=>'label label-success']);
                    }    
	            }
	        ],
            [
	            'attribute' => 'live_status',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->user_type ==='SHOP_DELIVERY_MAN' || $model->user_type ==='CR_DELIVERY_MAN')
                    {
                        if($model->live_status =='Off-Line'){
                            return Html::a('Off-Line','#',['class'=>'label label-danger']);
                        }
                        else {
                            return Html::a('On-Line','#',['class'=>'label label-success']);
                        }  
                    }else{
                        return "";
                    }  
	            }
	        ],
            [
	            'attribute' => 'work_status',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->user_type ==='SHOP_DELIVERY_MAN' || $model->user_type ==='CR_DELIVERY_MAN')
                    {
                        if($model->work_status =='Ready'){
                            return Html::a('Ready','#',['class'=>'label label-info']);
                        }
                        else {
                            return Html::a('Waiting','#',['class'=>'label label-warning']);
                        }  
                    }else{
                        return "";
                    }  
	            }
	        ],
             //'deleted',
            // 'gender',
            // 'is_fired',
            // 'lang',
            // 'subscribed',
            // 'created_at',
            // 'updated_at',
            //[
            //    'vAlign'=>'middle',
            //    'format'=>'raw',
            //    'value' => function($model) { return Html::a(Yii::t('app', 'PERMISSIONS'),'index.php?r=auth-assignment/update&user_id='.$model->id,['class'=>'badge bg-light-blue']); },
           // ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { 
                        if($model->user_type == 'CR_DELIVERY_MAN' || $model->user_type =='CR_ADMIN') 
                        {
                            return Html::a(Yii::t('app', 'SHOPS'),'#',['class'=>'badge bg-light-blue', 'value'=>Url::to('index.php?r=user/shops&id='.$model->id), 'id'=>'userShopsModalButton'.$model->id,'onclick'=>'return showUserShopsModal('.$model->id.')']);
                        }else {
                            return "";
                        } 
                    },
            ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { 
                            return Html::a(Yii::t('app', 'PERMISSIONS'),'#',['class'=>'badge bg-light-blue', 'id'=> 'permissionId','data-placement'=> 'right','data-toggle'=>"tooltip", 'title'=>"first tooltip", 'value'=>Url::to('index.php?r=auth-assignment/permissions&user_id='.$model->id), 'id'=>'userPermModalButton'.$model->id,'onclick'=>'return showUserPermModal('.$model->id.')']);
                    },
            ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { 
                      if($model->user_type == 'CR_DELIVERY_MAN' || $model->user_type =='SHOP_DELIVERY_MAN') 
                        {
                            return Html::a('<span class="glyphicon glyphicon-list">','index.php?r=order-map-trace/index&id='.$model->id);
                        }else {
                            return "";
                        }
                    }
                ,
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
 <?php Pjax::end();?>
</div>

<?php
$script = <<< JS
$('#permissionId').tooltip('show');
JS;
$this->registerJs($script);
?>