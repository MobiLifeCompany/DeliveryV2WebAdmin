<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'AREAS');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

?>
<div class="areas-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=areas/create'),'id'=>'modalButton']); ?>
    <br/>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'AREAS').'</h4>',
                'id' => 'modal',
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
            ['attribute' => 'city_id',
             'value'=>'city.name'
            ],
            'name',
            'ar_name',
            [
	            'attribute' => 'deleted',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->deleted ==1){
		                return "<span class= 'label label-danger'>".Yii::t('app', 'NO')."</span>";
                    }
                    else {
                        
                        return "<span class= 'label label-success'>".Yii::t('app', 'YES')."</span>";
                    }    
	            }
	        ],
            'lang',
            'created_at',
            'updated_at',
             [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a(Yii::t('app', 'SHOPS'),'index.php?r=shops/details&id='.$model->id,['class'=>'badge bg-light-blue']); },
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
