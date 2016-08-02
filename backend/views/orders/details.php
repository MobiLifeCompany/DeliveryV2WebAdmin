<?php

use yii\helpers\Html;
use yii\Helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Customer#'.Yii::$app->request->queryParams['id'].' Orders');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Customers'), 'url' => 'index.php?r=customers'];
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
?>

<div class="customer-addresses-index">
    <h3><?= Html::encode('Customer#'.Yii::$app->request->queryParams['id']) ?></h3>
 
<?php
        Modal::begin([
                'header'=>'<h4>Customers-Orders</h4>',
                'id' => 'modal',
                'size' => 'modal-lg',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
 ?>
<?php Pjax::begin(['id'=>'modalGrid']);?>   
<?= GridView::widget([
        'dataProvider' => $customerModel,
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

            'id',
            'username',
           // 'password_digest',
           // 'confirmation_token',
           // 'auth_token',
             'full_name',
             'phone',
             'mobile',
            // 'photo',
              [
	            'attribute' => 'gender',
                'vAlign'=>'middle',
                'format'=>'raw',
	            'value' => function($model) {
                    if($model->gender =='Male'){
		                return Html::a('Male','#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a('Female','#',['class'=>'label label-success']);
                    }    
	            }
	        ],
            // 'is_allowed',
            // 'unlock_token',
            // 'confirmed_at',
            // 'locked_at',
            // 'sms_count',
            // 'lang',
             'created_at',
             'updated_at',
             'email:email',
            [
               'class' => 'yii\grid\ActionColumn',
               'template' => '{delete} {update} {view} ',
               'buttons' => [
               'view' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-eye-open">','#',['value'=>'index.php?r=customers/view&id='.$model->id,'id'=>'viewModalButton'.$model->id,'onclick'=>'return showViewModal('.$model->id.')']);
                    },
                'update' => function ($url,$model) 
                    {
                        return Html::a('<span class="glyphicon glyphicon-pencil">','#',['value'=>'index.php?r=customers/update&id='.$model->id,'id'=>'updateModalButton'.$model->id,'onclick'=>'return showUpdateModal('.$model->id.')']);
                    }    
                ]
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
<div class="orders-index">
    <h3><?= Html::encode($this->title) ?></h3>   
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
            // 'created_at',
            // 'updated_at',
             [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a('Order Items','index.php?r=order-items/details&id='.$model->id,['class'=>'badge bg-light-blue']); },
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
<?php Pjax::end(); ?></div>
