<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShopRatesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'SHOP_RATING');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;


?>
<div class="shop-rates-index">
    <h3><?= Html::encode(Yii::t('app', 'SHOP').'#'.Yii::$app->request->queryParams['id']) ?></h3>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'SHOP_RATING').'</h4>',
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
        'responsiveWrap' => false,
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body'
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
                'value' => function($model) { return Html::a('','index.php?r=shop-rates/details&id='.$model->id,['class'=>'glyphicon glyphicon-star']); },
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
               'template' => '{delete} {update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>'index.php?r=shops/view&id='.$model->id,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
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
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <br>

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
            ['attribute' => 'customer_id',
             'value'=>'customer.full_name'
            ],
            ['attribute' => 'shop_id',
             'value'=>'shop.name'
            ],
            ['attribute' => 'order_id',
             'value'=>'order.id'
            ],
            [
	            'attribute' => 'rate',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    $i = 0;
                    $stars = '';
                    for(;$i < $model->rate; $i++)
                        $stars .= Html::a('<span class="fa fa-star text-yellow">','#');
                    for(;$i < 5; $i++)
                        $stars .= Html::a('<span class="fa fa-star-o text-yellow">','#');
                    return $stars;
	            }
	        ],

            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    }, 
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
