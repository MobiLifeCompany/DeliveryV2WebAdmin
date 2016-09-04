<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ITEMS');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

?>
<div class="items-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=items/create'),'id'=>'modalButton']); ?>
    <br/>
    <?php
        Modal::begin([
                'options' => [
                    'id' => 'modal',
                    'tabindex' => false], // important for Select2 to work properly
                'header'=>'<h4>'.Yii::t('app', 'ITEMS').'</h4>',
                'size' => 'modal-lg',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' =>false,
        'responsiveWrap' => false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'layout'=>"{items}\n{summary}\n{pager}",
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'ar_name',
            [
                'attribute' => 'shop_id',
                'value'=>'shopItemCategory.shop.name'
            ],
            [
                'attribute' => 'item_category_id',
                'value'=>'shopItemCategory.itemCategory.name'
            ],
            'price',
            [
	            'attribute' => 'deleted',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->deleted == 0){
                        return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']); 
                    }
                    else {
                       return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }    
	            }
	        ],
            [
	            'attribute' => 'active',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->active == 0){
		                return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }
                    else {
                       return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }    
	            }
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

</div>
