<?php

use yii\helpers\Html;
use yii\Helpers\Url;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'CUSTOMER') . ' # ' .Yii::$app->request->queryParams['id'].' Orders';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CUSTOMERS'), 'url' => 'index.php?r=customers'];
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
?>

<div class="customer-addresses-index">
    <h3><?= Html::encode('Customer#'.Yii::$app->request->queryParams['id']) ?></h3>
 
<?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'CUSTOMERS_ORDERS').'</h4>',
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
        'responsiveWrap' => false,
        'options'=>[
                        'tag'=>'div',
                        'class'=>'box box-body'
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
		                return "<span class= 'label label-danger'>".Yii::t('app', 'MALE')."</span>";
                    }
                    else {
                        return "<span class= 'label label-success'>".Yii::t('app', 'FEMALE')."</span>";
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

<div class="orders-index">
    <h3><?= Html::encode($this->title) ?></h3>   
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
                        return "<span class= 'label label-success'>".Yii::t('app', 'OPEN')."</span>";
                    }if($model->order_status =='RE-OPEN'){
                        return "<span class= 'label label-success'>".Yii::t('app', 'REOPEN')."</span>";
                    }else if($model->order_status =='CLOSED'){
                        return "<span class= 'label label-danger'>".Yii::t('app', 'CLOSED')."</span>";
                    }else if($model->order_status =='PENDING'){
                        return "<span class= 'label label-warning'>".Yii::t('app', 'PENDING')."</span>";
                    }else if($model->order_status =='CANCEL'){
                        return "<span class= 'label label-info'>".Yii::t('app', 'CANCELED')."</span>";
                    }
                }
	        ],
             'qty',
             'delivery_charge',
             'total',
              [
                 'attribute' => Yii::t('app', 'TOTAL_WITH_DELIVERY'),
                 'value' => function($model) { return $model->total + $model->delivery_charge;},
             ],
             'cancel_reason',
             'note:ntext',
            // 'created_at',
            // 'updated_at',
             [
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) { return Html::a(Yii::t('app', 'ORDER_ITEMS'),'index.php?r=order-items/details&id='.$model->id,['class'=>'badge bg-light-blue']); },
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
<?php Pjax::end(); ?>

</div>
