<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use backend\models\Cities;
use backend\models\Areas;
use backend\models\Customers;
use yii\widgets\MaskedInput;

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
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shop-addresses-form">

   <?php  
        $form = ActiveForm::begin(); 
    ?>

    <?= $form->field($model, 'latitude')->widget(MaskedInput::className(), ['mask' => '99.9999999', ]) ?>

    <?= $form->field($model, 'longitude')->widget(MaskedInput::className(), ['mask' => '99.9999999', ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$coord = new LatLng(['lat' => 35.1367539, 'lng' => 36.7153893]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    'width' => '1000',
    'height' => '500', 
]);

$marker = new Marker([
    'position' => $coord,
    'draggable' => true,
    'title' => 'Shop',
]);
 $event = new Event(["trigger"=>"dragend",
                     "js"=>"
                     document.getElementById('shops-latitude').value = event.latLng.lat();
                     document.getElementById('shops-longitude').value = event.latLng.lng();
                     //alert(event.latLng.lng()+ ' --- ' + event.latLng.lat());
                     "]);

$marker->addEvent($event);
$map->addOverlay($marker);
// Display the map -finally :)
echo $map->display();
?>