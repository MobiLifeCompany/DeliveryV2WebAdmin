<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\Helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShopDeliveryAreasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'DELIVERY_AREAS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'SHOPS'), 'url' => ['shops/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="shop-delivery-areas-index">

<h3><?= Yii::t('app', 'SHOPS'); ?></h3>
 <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'DELIVERY_AREAS').'</h4>',
                'id' => 'modal',
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
            [
             'attribute' => 'business_id',
             'value'=>'business.name'
            ],
            [
             'attribute' => 'city_id',
             'value'=>'city.name'
            ],
            ['attribute' => 'area_id',
             'value'=>'area.name'
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
            'min_amount',

            [
	            'attribute' => Yii::t('app', 'POSITION'),
                'label' => Yii::t('app', 'POSITION'),
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
               'class' => 'yii\grid\ActionColumn',
               'template' => ' {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>'index.php?r=shops/view&id='.$model->id,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    }, 
                ]
            ],
        ],
    ]); ?>

    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=shop-delivery-areas/create&id='.Yii::$app->request->queryParams['id']),'id'=>'modalButton']); ?>
    </p>
    <br>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'summary'=> "",
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body table-responsive no-padding'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            ['attribute' => 'shop_id',
             'value'=>'shop.name'
            ],
             ['attribute' => 'area_id',
             'value'=>'area.name'
            ],
            'delivery_charge',
             [
	            'attribute' => 'deleted',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->deleted == 0){
		                return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }    
	            }
	        ],
            'created_at',

            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} ',
               'buttons' => [
               
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>'index.php?r=shop-delivery-areas/update&id='.$model->id.'&shop_id='.Yii::$app->request->queryParams['id'],'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                    },
                'delete' => function ($url,$model) 
                    {
                            return Html::a('<span class="glyphicon glyphicon-trash">','index.php?r=shop-delivery-areas/delete&id='.$model->id.'&shop_id='.Yii::$app->request->queryParams['id'],['title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',]);
                    }        
                ]
            ],
        ],
    ]); ?>
</div>