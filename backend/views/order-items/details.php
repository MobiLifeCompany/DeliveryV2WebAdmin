<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\services\DirectionsWayPoint;
use dosamigos\google\maps\services\TravelMode;
use dosamigos\google\maps\overlays\PolylineOptions;
use dosamigos\google\maps\services\DirectionsRenderer;
use dosamigos\google\maps\services\DirectionsService;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\services\DirectionsRequest;
use dosamigos\google\maps\overlays\Polygon;
use dosamigos\google\maps\layers\BicyclingLayer;
use dosamigos\google\maps\Event;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\OrderItemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'ORDER_ITEMS');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ORDERS'), 'url' => 'index.php?r=orders'];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-items-index">
    <h3><?= Html::encode(Yii::t('app', 'ORDER_NO') . ' ' .Yii::$app->request->queryParams['id']) ?></h3>
    <?php
        Modal::begin([
                'header'=>'<h4>'.Yii::t('app', 'ORDER_DETAILS').'</h4>',
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
	            'attribute' => Yii::t('app', 'ORDER_STATUS'),
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
             'qty',
             'delivery_charge',
             'total',
             [
                 'attribute' => Yii::t('app', 'TOTAL_WITH_DELIVERY'),
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
<h3><?= Html::encode($this->title) ?></h3>

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
		                return Html::a(Yii::t('app', 'YES'),'#',['class'=>'label label-success']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'NO'),'#',['class'=>'label label-danger']);
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

<br/>
<br/>


<?php 
$coord = new LatLng(['lat' => 35.1367539, 'lng' => 36.7153893]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    'width' => '1000',
    'height' => '500', 
]);


if((!empty($orderModel->getModels()[0]) && !empty($deliveryUser->getModels()[0]->deliveryUser) && !empty($deliveryUser->getModels()[0]->deliveryUser->longitude)))
{
    // lets use the directions renderer
    $shop = new LatLng(['lat' => (!empty($orderModel->getModels()[0]['shop'])?$orderModel->getModels()[0]['shop']->latitude:0), 'lng' => (!empty($orderModel->getModels()[0]['shop'])?$orderModel->getModels()[0]['shop']->longitude:0)]);
    $customerAddress = new LatLng(['lat' => (!empty($orderModel->getModels()[0]['customerAddresses'])?$orderModel->getModels()[0]['customerAddresses']->latitude:0), 'lng' => (!empty($orderModel->getModels()[0]['customerAddresses'])?$orderModel->getModels()[0]['customerAddresses']->longitude:0)]);
    $deliveryMan = new LatLng(['lat' => $deliveryUser->getModels()[0]->deliveryUser->latitude, 'lng' => $deliveryUser->getModels()[0]->deliveryUser->longitude]);

    // setup just one waypoint (Google allows a max of 8)
    $waypoints = [
        new DirectionsWayPoint(['location' => $deliveryMan])
    ];

    $directionsRequest = new DirectionsRequest([
        'origin' => $shop,
        'destination' => $customerAddress,
        'waypoints' => $waypoints,
        'travelMode' => TravelMode::DRIVING
    ]);

    // Lets configure the polyline that renders the direction
    $polylineOptions = new PolylineOptions([
        'strokeColor' => '#3C90BE',
        'draggable' => true
    ]);

    // Now the renderer
    $directionsRenderer = new DirectionsRenderer([
        'map' => $map->getName(),
        'polylineOptions' => $polylineOptions
    ]);

    // Finally the directions service
    $directionsService = new DirectionsService([
        'directionsRenderer' => $directionsRenderer,
        'directionsRequest' => $directionsRequest
    ]);

    // Thats it, append the resulting script to the map
    $map->appendScript($directionsService->getJs());

    echo $map->display();
}

?>