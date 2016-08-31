<?php

use yii\helpers\Html;
use yii\Helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use backend\models\User;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ORDERS');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
?>
<div class="orders-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php
          //echo Html::a('<span class="glyphicon glyphicon-plus pull-right">','#', ['value'=>Url::to('index.php?r=orders/create'),'id'=>'modalButton']);
         ?>
    </p>
    <br/>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'ORDERS').'</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'ORDER_MAP').'</h4>',
                'id' => 'mapModal',
                'size' => 'modal-lg',
                ]);
           echo "<div id='mapModalContent'></div>";
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
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'customer_id',
                'value'=>'customer.full_name'
            ],
            [
                'attribute' => 'shop_id',
                'value'=>'shop.name'
            ],
            [
	            'attribute' => 'order_status',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->order_status =='OPEN'){
		                return Html::a(Yii::t('app', 'OPEN'),'#',['class'=>'label label-success']);
                    }if($model->order_status =='RE-OPEN'){
		                return Html::a(Yii::t('app', 'REOPEN'),'#',['class'=>'label label-success']);
                    }else if($model->order_status =='CLOSED'){
                        return Html::a(Yii::t('app', 'CLOSED'),'#',['class'=>'label label-danger']);
                    }else if($model->order_status =='PENDING'){
                        return Html::a(Yii::t('app', 'PENDING'),'#',['class'=>'label label-warning']);
                    }else if($model->order_status =='CANCEL'){
                        return Html::a(Yii::t('app', 'CANCELED'),'#',['class'=>'label label-info']);
                    }    
	            }
	        ],
           //  'qty',
          //   'delivery_charge',
             'total',
              [
                 'attribute' => Yii::t('app', 'TOTAL_WITH_DELIVERY'),
                 'value' => function($model) { return $model->total + $model->delivery_charge;},
             ],
            // 'cancel_reason',
            // 'note:ntext',
            [
             'attribute' => 'delivery_user_id',
             'vAlign'=>'middle',
             'format'=>'raw',
             'value'=>function($model) { 
                     if($model->deliveryUser!=null){
                         return  Html::a($model->deliveryUser->username,'#',['class'=>'label label-success']);
                     }else{
                          return Html::a(Yii::t('app', 'NOT_ASSIGNED'),'#',['class'=>'label label-danger']);
                     }
            	}
            ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a('<span class="glyphicon glyphicon-user">','#',['value'=>'index.php?r=orders/setdelivery&id='.$model->id,'id'=>'updateModalButton_deliveryMan_'.$model->id,'onclick'=>'return showUpdateModalByType('.$model->id.',"deliveryMan")']); },
            ],
            // 'created_at',
            // 'updated_at',
             [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a(Yii::t('app', 'ORDER_ITEMS'),'index.php?r=order-items/details&id='.$model->id,['class'=>'badge bg-light-blue']); },
            ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a('<span class="fa fa-ship">','#',['value'=>'index.php?r=orders/setorderstatus&id='.$model->id,'id'=>'updateModalButton_order_status_'.$model->id,'onclick'=>'return showUpdateModalByType('.$model->id.',"order_status")']); },
            ],
            [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a('<span class="glyphicon glyphicon-list">','#',['value'=>'index.php?r=order-histories/index&id='.$model->id,'id'=>'viewModalButton_history_'.$model->id,'onclick'=>'return showViewModalByType('.$model->id.',"history")']);},
            ],
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{update} {view} ',
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
<?php Pjax::end(); ?></div>
