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


$this->title = Yii::t('app', 'MAP_DASHBOARD');
$this->params['breadcrumbs'][] = $this->title;

$curpage = Yii::$app->controller->id;
$this->params['currentPage'] = $curpage;
$this->params['currentPageAction'] = Yii::$app->controller->action->id;

?>

<br/>
<br/>

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
<?php $form = ActiveForm::begin(); ?>
<?php
        echo GridView::widget([
        'dataProvider' => $currentOrdersForMapDashboard,
        'export' =>false,
        'responsiveWrap' => false,
        'columns' => [
            [
                'class' => '\kartik\grid\CheckboxColumn', 
                'checkboxOptions'=>function ($model, $key, $index){

                    if($model['show_on_map']==1 && ($model['shop_longitude'] !='0' && $model['shop_latitude'] !='0') && ($model['customer_addresses_longitude'] !='0' || $model['customer_addresses_latitude'] !='0')){
                        return  ['id'=>"chk_{$model['order_id']}",
                                  'checked' => true,
                                  'name' => "chk_{$model['order_id']}",
                                  'value' => "chk_{$model['order_id']}"];
                    }else if($model['show_on_map']==1 && (($model['shop_longitude'] =='0' || $model['shop_latitude'] =='0') || ($model['customer_addresses_longitude'] =='0' || $model['customer_addresses_latitude'] =='0'))){
                        return  ['id'=>"chk_{$model['order_id']}",
                                  'checked' => true,
                                  'disabled' => true,
                                  'name' => "chk_{$model['order_id']}",
                                  'value' => "chk_{$model['order_id']}"];
                    }else if($model['show_on_map']==0 && (($model['shop_longitude'] =='0' || $model['shop_latitude'] =='0') || ($model['customer_addresses_longitude'] =='0' || $model['customer_addresses_latitude'] =='0'))){
                        return  ['id'=>"chk_{$model['order_id']}",
                                  'checked' => false,
                                  'disabled' => true,
                                  'name' => "chk_{$model['order_id']}",
                                  'value' => "chk_{$model['order_id']}"];
                    }
                    else{
                        return  ['id'=>"chk_{$model['order_id']}",
                                  'checked' => false,
                                  'name' => "chk_{$model['order_id']}",
                                  'value' => "chk_{$model['order_id']}"];
                    }
                },
            ],
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
		                return Html::a(Yii::t('app', 'OPEN'),'#',['class'=>'label label-success']);
                    }if($model['order_status'] =='RE-OPEN'){
		                return Html::a(Yii::t('app', 'REOPEN'),'#',['class'=>'label label-success']);
                    }else if($model['order_status'] =='CLOSED'){
                        return Html::a(Yii::t('app', 'CLOSED'),'#',['class'=>'label label-danger']);
                    }else if($model['order_status'] =='PENDING'){
                        return Html::a(Yii::t('app', 'PENDING'),'#',['class'=>'label label-warning']);
                    }else if($model['order_status'] =='CANCEL'){
                        return Html::a(Yii::t('app', 'CANCELED'),'#',['class'=>'label label-info']);
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
		                return Html::a(Yii::t('app', 'NOT_SET'),'#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'SET'),'#',['class'=>'label label-success']);
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
		                return Html::a(Yii::t('app', 'NOT_SET'),'#',['class'=>'label label-danger']);
                    }
                    else {
                        return Html::a(Yii::t('app', 'SET'),'#',['class'=>'label label-success']);
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
                            return Html::a(Yii::t('app', 'NOT_SET'),'#',['class'=>'label label-danger']);
                       }     
                }
            ],
            
        ],
    ]); 
?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'UPDATE_TO_SHOW_ON_MAP'), ['class' =>  'btn btn-success']) ?>
    </div>
   <br/>
    <?php ActiveForm::end(); ?>

    <?php
    
        $coord = new LatLng(['lat' => 35.1367539, 'lng' => 36.7153893]);
        $map = new Map([
            'center' => $coord,
            'zoom' => 14,
            'width' => '1000',
            'height' => '1000', 
        ]);

        foreach ($currentOrdersForMapDashboard->getModels() as $record) {
              if($record['show_on_map'] == 1){
                    // lets use the directions renderer
                    $shop = new LatLng(['lat' => $record['shop_latitude'], 'lng' =>  $record['shop_longitude']]);
                    $customerAddress = new LatLng(['lat' => $record['customer_addresses_longitude'], 'lng' => $record['customer_addresses_latitude']]);
                    $deliveryMan = new LatLng(['lat' => $record['shop_latitude']-0.1, 'lng' => $record['shop_longitude']-0.1]);

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
                    // Lets configure the polyline that renders the direction
                    $polylineOptions = new PolylineOptions([
                        'strokeColor' => '#'.$x.$y.$z,
                        'draggable' => false
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
                
              }

        }
       

        echo $map->display();
        ?>

