<?php

use yii\helpers\Html;
use yii\Helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use backend\models\User;
use yii\Helpers\ArrayHelper;


$this->title = Yii::t('app', 'SALES_REPORT');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
$this->params['currentPageAction'] = Yii::$app->controller->action->id;

?>
<div class="sales-report-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php  echo $this->render('_salesReportFrom', ['model' => $searchModel]); ?>
    <br/>
   
    <?php Pjax::begin(['id'=>'modalGrid']);?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layout'=>"{items}\n{summary}\n{pager}",
        'showPageSummary' => true,
        'autoXlFormat'=>true,
        'responsiveWrap' => false,
        'export'=>[
            'fontAwesome'=>true,
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'pjax'=>true,
        'panel'=>[
            'type'=>'primary',
            'heading'=>Yii::t('app', 'SALES_REPORT')
        ],
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],
            'id',
            ['attribute' => 'shop_id',
             'value'=>'shop.name'
            ],
            ['attribute' => 'customer_id',
             'value'=>'customer.full_name'
            ],
            ['attribute' => 'created_at',
                'label' => Yii::t('app', 'CREATED_AT'),
                'value'=>'created_at'
            ],
            [
	            'attribute' => 'order_status',
                'hAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->order_status =='OPEN'){
		                return Html::a('OPEN','#',['class'=>'label label-success']);
                    }if($model->order_status =='RE-OPEN'){
		                return Html::a('RE-OPEN','#',['class'=>'label label-success']);
                    }else if($model->order_status =='CLOSED'){
                        return Html::a('CLOSED','#',['class'=>'label label-danger']);
                    }else if($model->order_status =='PENDING'){
                        return Html::a('PENDING','#',['class'=>'label label-warning']);
                    }else if($model->order_status =='CANCEL'){
                        return Html::a('CANCEL','#',['class'=>'label label-info']);
                    }    
	            },
                'pageSummary'=>Yii::t('app', 'REPORT_SUMMARY'),
                'pageSummaryOptions'=>['class'=>'text-right text-warning'],
	        ],
            [
                    'attribute'=>'qty',
                    'width'=>'50px',
                    'hAlign'=>'middle',
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryFunc'=>GridView::F_SUM
            ],
            [
                    'attribute'=>'delivery_charge',
                    'width'=>'130px',
                    'hAlign'=>'middle',
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryFunc'=>GridView::F_SUM
            ],
            [
                    'attribute'=>'total',
                    'width'=>'50px',
                    'hAlign'=>'middle',
                    'format'=>['decimal', 2],
                    'pageSummary'=>true,
                    'pageSummaryFunc'=>GridView::F_SUM
            ],
             [
                'attribute'=>'All',
                'label' => Yii::t('app', 'ALL'),
                'value' => function($model) { return $model->total + $model->delivery_charge;},
                'width'=>'50px',
                'hAlign'=>'middle',
                'format'=>['decimal', 2],
                'pageSummary'=>true,
                'pageSummaryFunc'=>GridView::F_SUM
            ],
            [
             'attribute' => 'delivery_user_id',
             'vAlign'=>'middle',
             'format'=>'raw',
             'value'=>function($model) { 
                     if($model->deliveryUser!=null){
                         return  Html::a($model->deliveryUser->username,'#',['class'=>'label label-success']);
                     }else{
                          return Html::a('Not Assigned','#',['class'=>'label label-danger']);
                     }
            	}
            ]
        ],
    ]); ?>
    <?php Pjax::end();?>
</div>
