<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'SHOPS_ITEMS');
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
		                return "<span class= 'label label-danger'>".Yii::t('app', 'NO')."</span>";
                    }
                    else {
                        return "<span class= 'label label-success'>".Yii::t('app', 'YES')."</span>";
                    }    
	            }
	        ],
           // 'rating',
            'estimation_time',
            'min_amount',
            'delivery_expected_time',
            'delivery_charge',
            //'lang',
            [
	            'attribute' => Yii::t('app', 'POSITION'),
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if(empty($model->latitude) || empty($model->latitude) ){
		                return "<span class= 'label label-danger'>".Yii::t('app', 'NOT_SET')."</span>";
                    }
                    else {
                       return "<span class= 'label label-success'>".Yii::t('app', 'SET')."</span>";
                    }    
	            }
	        ]
        ],
    ]); ?>

    <h3><?= Html::encode($this->title) ?></h3>
    <p>
        <?= Html::a('<span class="glyphicon glyphicon-plus pull-right">','index.php?r=items/create&id='.$_GET['id']); ?>
    </p>
    <br/>
    <br/>
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
                        return "<span class= 'label label-danger'>".Yii::t('app', 'YES')."</span>";
                    }
                    else {
                        return "<span class= 'label label-success'>".Yii::t('app', 'NO')."</span>";
                    }
                }
	        ],
            [
	            'attribute' => 'active',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->active == 1){
		                return "<span class= 'label label-success'>".Yii::t('app', 'YES')."</span>";
                    }
                    else {
                        return "<span class= 'label label-danger'>".Yii::t('app', 'NO')."</span>";
                    }    
	            }
	        ],
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>$url,'id'=>'viewModalButton_item_'.$model->id,'onclick'=>'return showViewModalByType('.$model->id.',"item")']);
                    },
                'update' => function ($url,$model)
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','index.php?r=items/update&id='.$model->id.'&sid='.$_GET['id']);
                    }    
                ]
            ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function ($model)
                {
                    return Html::a('<span class="glyphicon glyphicon-trash">','index.php?r=items/delete&id='.$model->id.'&sid='.$_GET['id'],['data' => ['confirm' => Yii::t('app', 'Are you sure you want to delete this item?')]]);
                },
            ],
        ],
    ]); ?>

</div>
