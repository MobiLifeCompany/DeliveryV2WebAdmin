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
    <h3><?= Html::encode(Yii::t('app', 'SHOP').'#'.Yii::$app->request->queryParams['id']) ?></h3>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'DETAILS').'</h4>',
                'options' => [
                    'id' => 'modal',
                    'tabindex' => false] // important for Select2 to work properly
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?= GridView::widget([
        'dataProvider' => $shopModel,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'summary'=>"",
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body table-responsive no-padding'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'ar_name',
            ['attribute' => 'business_id',
             'value'=>'business.name'
            ],
            [
	            'attribute' => 'deleted',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->deleted == 1){
		                return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }    
	            }
	        ],
           // 'rating',
         //   'estimation_time',
            'min_amount',
           // 'delivery_expected_time',
           // 'delivery_charge',
            //'lang',
            [
	            'attribute' => Yii::t('app', 'POSITION'),
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if(empty($model->latitude) || empty($model->latitude) ){
		                return Html::a(Yii::t('app', 'NOT_SET'),'#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'SET'),'#',['class'=>'label label-success']);
                    }    
	            }
	        ],
             [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a('','index.php?r=shops/map&id='.$model->id,['class'=>'glyphicon glyphicon-map-marker']); },
            ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a(Yii::t('app', 'ITEMS'),'index.php?r=items/details&id='.$model->id,['class'=>'badge bg-light-blue']); },
            ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a(Yii::t('app', 'DELIVERY_AREAS'),'#',['class'=>'badge bg-light-blue', 'value'=>Url::to('index.php?r=shops/areas&id='.$model->id), 'id'=>'deliveryAreasModalButton'.$model->id,'onclick'=>'return showDeliveryAreasModal('.$model->id.')']); },
            ],
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>'index.php?r=shops/view&id='.$model->id ,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    },
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>'index.php?r=shops/update&id='.$model->id,'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                    }    
                ]
            ],
        ],
    ]); ?>

    <h3><?= Html::encode($this->title) ?></h3>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?php //Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=items/create'),'id'=>'modalButton']); ?>
    </p>
    <br/>

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
                    if($model->deleted == 1){
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
                    if($model->active == 1){
		                return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }    
	            }
	        ],
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton_item_'.$model->id,'onclick'=>'return showViewModalByType('.$model->id.',"item")']);
                    },
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>$url,'id'=>'updateModalButton_item_'.$model->id,'onclick'=>'return showUpdateModalByType('.$model->id.',"item")']);
                    }    
                ]
            ],
        ],
    ]); ?>

</div>
