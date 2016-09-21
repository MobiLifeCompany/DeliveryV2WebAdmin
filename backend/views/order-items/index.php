<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ORDERS_ITEMS');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
?>
<div class="order-items-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'ORDER_ITEMS').'</h4>',
                'id' => 'modal',
                ]);
           echo "<div id='modalContent'></div>";
        Modal::end();
    ?>
<?php Pjax::begin(['id'=>'modalGridSpecial']);?>  
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

            //'id',
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
		                return "<span class= 'label label-success'>".Yii::t('app', 'YES')."</span>";
                    }
                    else {
                        return "<span class= 'label label-danger'>".Yii::t('app', 'NO')."</span>";
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
<?php Pjax::end(); ?></div>
