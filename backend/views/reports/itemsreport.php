<?php

use yii\helpers\Html;
use yii\Helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use backend\models\User;
use yii\Helpers\ArrayHelper;


$this->title = Yii::t('app', 'ITEMS_REPORT');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
$this->params['currentPageAction'] = Yii::$app->controller->action->id;

?>
<div class="items-report-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php  echo $this->render('_itemsReportFrom', ['model' => $searchModel]); ?>
    <br/>
   
    <?php Pjax::begin(['id'=>'modalGrid']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n{summary}\n{pager}",
        'showPageSummary' => true,
        'autoXlFormat'=>true,
        'export'=>[
            'fontAwesome'=>true,
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'pjax'=>true,
        'panel'=>[
            'type'=>'primary',
            'heading'=> Yii::t('app', 'ITEMS_REPORT')
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            [
             'attribute' => 'order_id',
             'label' => Yii::t('app', 'ORDER_ID'),
             'value'=>'id'
            ],
            [
	            'attribute' => 'order_status',
                'label' => Yii::t('app', 'ORDER_STATUS'),
                'hAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model['order_status'] =='OPEN'){
		                return Html::a('OPEN','#',['class'=>'label label-success']);
                    }if($model['order_status'] =='RE-OPEN'){
		                return Html::a('RE-OPEN','#',['class'=>'label label-success']);
                    }else if($model['order_status'] =='CLOSED'){
                        return Html::a('CLOSED','#',['class'=>'label label-danger']);
                    }else if($model['order_status'] =='PENDING'){
                        return Html::a('PENDING','#',['class'=>'label label-warning']);
                    }else if($model['order_status'] =='CANCEL'){
                        return Html::a('CANCEL','#',['class'=>'label label-info']);
                    }    
	            },
                'pageSummary'=>Yii::t('app', 'REPORT_SUMMARY'),
                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
	        ],
            [
             'attribute' => 'Category name',
             'label' => Yii::t('app', 'CATEGORIES'),
             'value'=>'category_name'
            ],
            [
              'attribute' => 'Item Name',
              'label' => Yii::t('app', 'ITEM_NAME'),
              'value'=>'item_name'
            ],
            [
                    'attribute'=>'qty',
                    'label' => Yii::t('app', 'QTY'),
                    'width'=>'50px',
                    'hAlign'=>'middle',
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryFunc'=>GridView::F_SUM
            ],
            [
                    'attribute'=>'price',
                    'label' => Yii::t('app', 'PRICE'),
                    'width'=>'130px',
                    'hAlign'=>'middle',
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryFunc'=>GridView::F_SUM
            ],
            [
                    'attribute'=>'total',
                    'label' => Yii::t('app', 'TOTAL'),
                    'width'=>'50px',
                    'hAlign'=>'middle',
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryFunc'=>GridView::F_SUM
            ],
            [
                'attribute' => 'Order Date',
                'label' => Yii::t('app', 'CREATED_AT'),
                'value'=>'created_at'
            ],

        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
