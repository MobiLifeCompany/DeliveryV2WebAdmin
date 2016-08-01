<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Order Items Details');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => 'index.php?r=orders'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-items-index">

    <h2><?= Html::encode('Order#'.Yii::$app->request->queryParams['id']) ?></h2>

    <p>
        <?php //echo Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=cities/create'),'id'=>'modalButton']); ?>
    </p>
    <br/>
    <?php
        Modal::begin([
                'header'=>'<h4>Order Details</h4>',
                'id' => 'modal',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>
   <?php Pjax::begin(['id'=>'modalGrid']);?> 
    <?= GridView::widget([
        'dataProvider' => $orderModel,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
        'summary' => '',
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body table-responsive no-padding'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute' => 'customer_id',
             'value'=>'customer.full_name'
            ],
            ['attribute' => 'shop_id',
             'value'=>'shop.name'
            ],
            [
	            'attribute' => 'order_status',
                'vAlign'=>'middle',
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
	            }
	        ],
             'qty',
             'delivery_charge',
             'total',
             [
                 'attribute' => 'Total With Delivery',
                 'value' => function($model) { return $model->total + $model->delivery_charge;},
             ],
             'cancel_reason',
             'note:ntext',
             'created_at',
            // 'updated_at',
             [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>'index.php?r=orders/view&id='.$model->id,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    },
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>'index.php?r=orders/update&id='.$model->id,'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                    }    
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<br/>
<br/>
<h2><?= Html::encode($this->title) ?></h2>


 <?php Pjax::begin(['id'=>'modalGridSpecial']);?> 
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

            'id',
            'order_id',
            //'item.name',
             ['attribute' => 'item_id',
             'value'=>'item.name'
            ],
            'qty',
            'item_price',
             'total',
             [
	            'attribute' => 'is_canceled',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->is_canceled ==1){
		                return Html::a('Yes','#',['class'=>'label label-success']);
                    }
                    else {
                        return Html::a('No','#',['class'=>'label label-danger']);
                    }    
	            }
	        ],
             'created_at',
            // 'updated_at',
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} ',
               'buttons' => [
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>$url,'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                    }    
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
