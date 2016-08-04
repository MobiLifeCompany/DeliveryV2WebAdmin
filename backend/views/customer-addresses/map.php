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
    'title' => 'My Home Town',
]);
 $event = new Event(["trigger"=>"dragend",
                     "js"=>"
                      alert(event.latLng.lng()+ ' --- ' + event.latLng.lat());
                     "]);

$marker->addEvent($event);
$map->addOverlay($marker);
// Display the map -finally :)
echo $map->display();

?>