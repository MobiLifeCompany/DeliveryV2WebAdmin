<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="order-items-index"> 
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' =>  'box',
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
             'created_at',
            // 'updated_at',
        ],
    ]); ?>
</div>
