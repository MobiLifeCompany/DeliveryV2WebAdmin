<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\Helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AuthItemSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

$this->title = Yii::t('app', 'User Permissions Groups');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=auth-item-child/create'),'id'=>'modalButton']); ?>
    </p>
    <br/>

    <?php
        Modal::begin([
                'header'=>'<h4>User Permissions Groups</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
                'options' => [
                    'tabindex' => false // important for Select2 to work properly
                  ],
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
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body table-responsive no-padding'
        ],
        'columns' => [
            'parent',
            'child',
            'created_at',
            'updated_at',
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} {view}',
               'buttons' => [
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>$url,'id'=>'updateModalButton'.$model->parent,'onclick'=>'return showUpdateModal("'.$model->parent.'")']);
                    },
                'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton'.$model->parent,'onclick'=>'return showViewModal("'.$model->parent.'")']);
                    }     
                ]
            ],
        ],
    ]); ?>
 <?php Pjax::end();?>    
</div>
