<?php

use yii\helpers\Html;
use yii\Helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

$this->title = Yii::t('app', 'USER_PERMISSIONS');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="auth-item-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
        echo Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=auth-item/create'),'id'=>'modalButton']);
    ?>
    </br>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'USER_PERMISSIONS').'</h4>',
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
        'options'=>  [
                        'tag'=>'div',
                        'class'=>'box box-body'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'name',
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { 
                         if($model->type ==1){
                            return Html::a($model->name,'#',['value'=>Url::to('index.php?r=auth-item/permissions&id='.$model->name), 'id'=>'userPermModalButton'.$model->name,'onclick'=>'return showUserPermModal("'.$model->name.'")']);
                         }else {
                            return $model->name;
                         }
                    },
            ],
             [
	            'attribute' => 'type',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->type ==1){
                        return "<span class= 'label label-success'>".Yii::t('app', 'GROUP_PERMISSION')."</span>";
                    }
                    else {
                        return "<span class= 'label label-warning'>".Yii::t('app', 'USER_PERMISSION')."</span>";
                    }    
	            }
	        ],
            'description:ntext',
            //'rule_name',
           // 'data:ntext',
            // 'created_at',
            // 'updated_at',
               [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton'.$model->name,'onclick'=>'return showViewModal("'.$model->name.'")']);
                    },
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>$url,'id'=>'updateModalButton'.$model->name,'onclick'=>'return showUpdateModal("'.$model->name.'")']);
                    }    
                ]
        ],
        ],
    ]); ?>
 <?php Pjax::end();?>
</div>
