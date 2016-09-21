<?php

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

use yii\bootstrap\ActiveForm;
use backend\models\MapOrder;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\Helpers\Url;

$this->title = Yii::t('app', 'Home');

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
?>
<?php
if(Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN' || Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' )
{
    ?>
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 connectedSortable">
            <div class="box <?php if (Yii::$app->session['realUser']['work_status']=='Ready') { echo 'box-info';} else { echo 'box-warning';}?>">
                <div class="box-header">
                    <i class="fa fa-user"></i>
                    <h3 class="box-title">Delivery User Work Status:
                        <?php if((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ||
                                Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
                            && ( Yii::$app->session['realUser']['work_status']=='Ready')) { ?>
                            <a href="#"><i class="fa fa-square text-blue"></i> Ready</a>
                        <?php } else if((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ||
                                Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
                            && ( Yii::$app->session['realUser']['work_status']=='Waiting')) {  ?>
                            <a href="#"><i class="fa fa-square text-yellow"></i> Waiting</a>
                        <?php }
                        ?></h3>
                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                        <div class="btn-group" data-toggle="btn-toggle" style="margin-right: 11px;">
                            <button type="button" class="btn btn-default btn-lg  <?php if (Yii::$app->session['realUser']['work_status']=='Ready') { echo 'active';}?>" onclick="activeWorkStatus('Ready','work_status')"><i class="fa fa-square text-blue"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-lg  <?php if (Yii::$app->session['realUser']['work_status']=='Waiting') { echo 'active';}?>" onclick="activeWorkStatus('Waiting','work_status')"><i class="fa fa-square text-yellow"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- <div class="box-body chat" id="chat-box">

                 </div>
                  /.chat
                 <div class="box-footer">
                     <div class="input-group">
                       hhhhhhhh
                     </div>
                 </div> -->
            </div>
            <!-- /.box (chat box) -->
        </section>
        <section class="col-lg-6 connectedSortable">
            <div class="box <?php if (Yii::$app->session['realUser']['live_status']=='On-Line') { echo 'box-success';} else { echo 'box-danger';}?>">
                <div class="box-header">
                    <i class="fa fa-user"></i>
                    <h3 class="box-title">Delivery User Live Status:
                        <?php if((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ||
                                Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
                            && ( Yii::$app->session['realUser']['live_status']=='On-Line')) { ?>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        <?php } else if((Yii::$app->session['realUser']['user_type']=='SHOP_DELIVERY_MAN' ||
                                Yii::$app->session['realUser']['user_type']=='CR_DELIVERY_MAN')
                            && ( Yii::$app->session['realUser']['live_status']=='Off-Line')) {  ?>
                            <a href="#"><i class="fa fa-circle text-danger"></i> Offline</a>
                        <?php } else { ?>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        <?php }
                        ?>
                    </h3>
                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                        <div class="btn-group" data-toggle="btn-toggle" style="margin-right: 11px;">
                            <button type="button" class="btn btn-default btn-lg <?php if (Yii::$app->session['realUser']['live_status']=='On-Line') { echo 'active';}?>" onclick="activeWorkStatus('On-Line','live_status')"><i class="fa fa-square text-green"></i>
                            </button>
                            <button type="button" class="btn btn-default btn-lg <?php if (Yii::$app->session['realUser']['live_status']=='Off-Line') { echo 'active';}?>" onclick="activeWorkStatus('Off-Line','live_status')"><i class="fa fa-square text-red"></i></button>
                        </div>
                    </div>
                </div>
                <!--<div class="box-body chat" id="chat-box">

               </div>
               /.chat
               <div class="box-footer">
                   <div class="input-group">
                     hhhhhhhh
                   </div>
               </div>-->
            </div>
            <!-- /.box (chat box) -->
        </section>
    </div>
    </br>
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
    <?php
    echo GridView::widget([
        'dataProvider' => $currentOrdersForMapDashboard,
        'export' =>false,
        'tableOptions' => ['class' => 'table table-hover'],
        'class' => 'box',
        'layout' => "{items}\n{summary}\n{pager}",
        'responsiveWrap' => false,
        'options' => [
            'tag' => 'div',
            'class' => 'box box-body'
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'order_id',
                'label' => Yii::t('app', 'ORDER_ID'),
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) {
                    return Html::a($model['order_id'].' #','#', ['value'=>Url::to('index.php?r=orders/view&id='.$model['order_id']),'class'=>'product-title','id'=>'viewModalButton_order_'.$model['order_id'],'onclick'=>'return showViewModalByType('.$model['order_id'].',"order")']);
                }
            ],
            [
                'attribute' => 'order_status',
                'label' => Yii::t('app', 'ORDER_STATUS'),
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) {
                    if($model['order_status'] =='OPEN'){
                        return "<span class= 'label label-success'>".Yii::t('app', 'OPEN')."</span>";
                    }if($model['order_status'] =='RE-OPEN'){
                        return "<span class= 'label label-success'>".Yii::t('app', 'REOPEN')."</span>";
                    }else if($model['order_status'] =='CLOSED'){
                        return "<span class= 'label label-danger'>".Yii::t('app', 'CLOSED')."</span>";
                    }else if($model['order_status'] =='PENDING'){
                        return "<span class= 'label label-warning'>".Yii::t('app', 'PENDING')."</span>";
                    }else if($model['order_status'] =='CANCEL'){
                        return "<span class= 'label label-info'>".Yii::t('app', 'CANCELED')."</span>";
                    }
                }
            ],
            [
                'attribute' => 'shop_name',
                'label' => Yii::t('app', 'SHOPS'),
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) {
                    return Html::a($model['shop_name'],'#', ['value'=>Url::to('index.php?r=shops/view&id='.$model['shop_id']),'class'=>'product-title','id'=>'viewModalButton_shop_'.$model['shop_id'],'onclick'=>'return showViewModalByType('.$model['shop_id'].',"shop")']);
                }
            ],
            [
                'attribute' => 'Position',
                'label' => Yii::t('app', 'POSITION'),
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) {
                    if($model['shop_longitude'] =='0' || $model['shop_latitude'] =='0' ){
                        return "<span class= 'label label-danger'>".Yii::t('app', 'NOT_SET')."</span>";
                    }
                    else {
                       return "<span class= 'label label-success'>".Yii::t('app', 'SET')."</span>";
                    }
                }
            ],
            [
                'attribute' => 'Customer',
                'label' => Yii::t('app', 'CUSTOMERS'),
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) {
                    return Html::a($model['customer_fullname'],'#', ['value'=>Url::to('index.php?r=customers/view&id='.$model['customer_id']),'class'=>'product-title','id'=>'viewModalButton_customer_'.$model['customer_id'],'onclick'=>'return showViewModalByType('.$model['customer_id'].',"customer")']);
                }
            ],
            [
                'attribute' => 'Customer Address',
                'label' => Yii::t('app', 'CUSTOMERS_ADDRESSES'),
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) {
                    return Html::a($model['customer_address'],'#', ['value'=>Url::to('index.php?r=customer-addresses/view&id='.$model['customer_address_id']),'class'=>'product-title','id'=>'viewModalButton_address_'.$model['customer_address_id'],'onclick'=>'return showViewModalByType('.$model['customer_address_id'].',"address")']);
                }
            ],
            [
                'attribute' => 'Position',
                'label' => Yii::t('app', 'POSITION'),
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) {
                    if($model['customer_addresses_longitude'] =='0' || $model['customer_addresses_latitude'] =='0' ){
                        return "<span class= 'label label-danger'>".Yii::t('app', 'NOT_SET')."</span>";
                    }
                    else {
                       return "<span class= 'label label-success'>".Yii::t('app', 'SET')."</span>";
                    }
                }
            ],
            [
                'attribute' => 'User',
                'label' => Yii::t('app', 'DELIVERY_USER'),
                'vAlign'=>'middle',
                'format'=>'raw',
                'value' => function($model) {
                    if(!empty($model['username'])){
                        return Html::a($model['username'],'#', ['value'=>Url::to('index.php?r=user/view&id='.$model['user_id']),'class'=>'product-title','id'=>'viewModalButton_user_'.$model['user_id'],'onclick'=>'return showViewModalByType('.$model['user_id'].',"user")']);
                    }
                    else {
                        return "<span class= 'label label-danger'>".Yii::t('app', 'NOT_SET')."</span>";
                    }
                }
            ],

        ],
    ]);
    ?>
    <?php

    $coord = new LatLng(['lat' => Yii::$app->params['central_lat'], 'lng' => Yii::$app->params['central_lng']]);
    $map = new Map([
        'center' => $coord,
        'zoom' => 14,
        'width' => '1000',
        'height' => '1000',
    ]);

    foreach ($currentOrdersForMapDashboard->getModels() as $record)
    {
        if($record['show_on_map'] == 1)
        {
            // lets use the directions renderer
            $shop = new LatLng(['lat' => $record['shop_latitude'], 'lng' =>  $record['shop_longitude']]);
            $customerAddress = new LatLng(['lat' => $record['customer_addresses_latitude'], 'lng' => $record['customer_addresses_longitude']]);
            $deliveryMan = new LatLng(['lat' => $record['user_latitude'], 'lng' => $record['user_longitude']]);

            $shopMarker = new Marker([
                'position' => $shop,
                'icon' => 'dist/img/shop-map-icon.png',
            ]);
            $shopMarker->attachInfoWindow(
                new InfoWindow([
                    'content' => '<b> OrderID# '.$record['order_id'].'</b> - '.$record['shop_name']
                ])
            );

            $customerAddressMarker = new Marker([
                'position' => $customerAddress,
                'icon' => 'dist/img/customer-map-icon.png',
            ]);
            $customerAddressMarker->attachInfoWindow(
                new InfoWindow([
                    'content' =>  '<b>OrderID# '.$record['order_id'].'</b> - '.$record['customer_fullname'].' - '.$record['customer_address']
                ])
            );

            $deliveryManMarker = new Marker([
                'position' => $deliveryMan,
                'icon' => 'dist/img/delivery-map-icon.jpg',
            ]);
            $deliveryManMarker->attachInfoWindow(
                new InfoWindow([
                    'content' =>  '<b>OrderID# '.$record['order_id'].'</b> - '.$record['username']
                ])
            );

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

            $x = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
            $y = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
            $z = str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
            $generatedColor = '#' . $x . $y . $z;
            // Lets configure the polyline that renders the direction
            $polylineOptions = new PolylineOptions([
                'strokeColor' => $generatedColor,
                'draggable' => false
            ]);

            // Now the renderer
            $directionsRenderer = new DirectionsRenderer([
                'map' => $map->getName(),
                'polylineOptions' => $polylineOptions,
                'suppressMarkers' => true,
            ]);

            // Finally the directions service
            $directionsService = new DirectionsService([
                'directionsRenderer' => $directionsRenderer,
                'directionsRequest' => $directionsRequest
            ]);

            $directionsService->setOrderId("<b style=\"background-color: ".$generatedColor."\"> OrderId#: ".$record['order_id']."</b>");

            // Thats it, append the resulting script to the map
            $map->appendScript($directionsService->getJs());

            // Add marker to the map
            $map->addOverlay($shopMarker);
            $map->addOverlay($customerAddressMarker);
            $map->addOverlay($deliveryManMarker);

        }

    }


    echo $map->display();
}
else
{
    ?>
    <div  style="text-align:center;">
        <h2> <?php echo Yii::t('app', 'HOME_MESSAGE');?> </h2>
        <br/>
        <img src="dist/img/logo.png" class="img-circle" alt="DE Logo" width="250px" height="250px">
    </div>
    <?php
}

?>