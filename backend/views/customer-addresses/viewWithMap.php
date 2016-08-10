<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

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
/* @var $model backend\models\CustomerAddresses */

$this->title = $model->customer->full_name.' Address No# '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'CUSTOMER_ADDRESSES'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-addresses-view">
    <br/>
    <br/>
    <h3> <?php echo $this->title;?></h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'customer_id',
             'value'=>$model->customer->full_name
            ],
             ['attribute' => 'city_id',
             'value'=>$model->city->name
            ],
             ['attribute' => 'area_id',
             'value'=>$model->area->name
            ],
            'street',
            'building',
            'floor',
            'details',
            'phone',
            'email:email',
            'latitude',
            'longitude',
            [
                'attribute'=>'is_default',
                'value' =>  $model->deleted == 0 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 0 ? Yii::t('app', 'YES') : Yii::t('app', 'NO')
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>

<?php 
$coord = new LatLng(['lat' => $model->latitude, 'lng' => $model->longitude]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    'width' => '1000',
    'height' => '500', 
]);

// lets use the directions renderer
$shop = new LatLng(['lat' => $model->latitude, 'lng' => $model->longitude]);


$marker = new Marker([
    'position' => $shop,
    'draggable' => false,
    'title' => 'My Home Town',
]);

$map->addOverlay($marker);
// Display the map -finally :)
echo $map->display();

?>