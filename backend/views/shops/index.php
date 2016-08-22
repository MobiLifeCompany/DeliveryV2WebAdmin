<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShopsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'SHOPS');
$this->params['breadcrumbs'][] = $this->title;

// get current page name for leftside menu
$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;

?>
<div class="shops-index">
    <h3><?= Html::encode($this->title) ?></h3>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
      <?php 
         if(Yii::$app->user->can('create_shop')){
            echo Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=shops/create'),'id'=>'modalButton']);
         } 
      ?>
    </p>
    <br/>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'SHOPS').'</h4>',
                'options' => [
                    'id' => 'modal',
                    'tabindex' => false] // important for Select2 to work properly
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

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
                            return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    },
                'update' => function ($url,$model) 
                    {
                          if(Yii::$app->user->can('update_shop')){
                            return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>$url,'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                          }
                    },
                'delete' => function ($url,$model) 
                    {
                          if(Yii::$app->user->can('delete_shop')){
                            return Html::a('<span class="glyphicon glyphicon-trash">',$url,['title' => Yii::t('yii', 'Delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                                    'data-method' => 'post',]);
                          }
                    }    
                ]
            ],
        ],
    ]); ?>

</div>
