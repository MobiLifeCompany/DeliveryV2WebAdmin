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

$this->title = $model->name.' Shop No# '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Shop'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<br/>
<br/>

<div class="shops-view">
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            ['attribute' => 'business_id',
             'value'=>$model->business->name
            ],
            'name',
            'short_description',
            'address',
            'ar_name',
            'ar_short_description',
            'ar_address',
            'phone',
            [
                'attribute'=>'is_avilable',
                'value' =>  $model->is_avilable == 1 ? 'Yes' : 'No'
            ],
            'longitude',
            'latitude',
            'estimation_time',
            'min_amount',
            'delivery_expected_time',
            'delivery_charge',
            'promotion_note:ntext',
            'warning_note:ntext',
            [
                'attribute'=>'photo',
                'value' =>  "images/shops/".$model->id."/".$model->photo."",
                'format' => ['image',['height'=>'100']],
            ],
            'masteries:ntext',
            [
                'attribute'=>'deleted',
                'value' =>  $model->deleted == 1 ? 'Yes' : 'No'
            ],
            'lang',
            'created_at',
            'updated_at',
            'rating',
            'country',
            [
                'attribute'=>'subscribed',
                'value' =>  $model->subscribed == 1 ? 'Yes' : 'No'
            ],
        ],
    ]) ?>

<?php
if(!empty($deliveryAreas))
{
?>
    <h4>Shop Delivery Areas</h4>
    <div class="box-body">
        <table class="table table-striped">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Arabic Name</th>
            </tr>
    <?php
        foreach ($deliveryAreas as $area) {
            echo '<tr>
                    <td>'.$area->id.'</td>
                    <td>'.$area->name.'</td>
                    <td>'.$area->ar_name.'</td>
                </tr>';
        }
    ?>
        </table>
    </div>
<?php 
}else{
    echo '<h4>Shop Delivery Areas are Empty</h4>';
}    
?>
<br>
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