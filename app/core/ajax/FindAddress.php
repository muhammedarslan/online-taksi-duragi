<?php


$lat =  $_POST['lat'];
$long =  $_POST['lng'];

$url  = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false&key=mapsKey";


$json = @file_get_contents($url);
$data = json_decode($json);
$status = $data->status;
$address = '';
if($status == "OK")
{
	echo $address = $data->results[0]->formatted_address;
}
else
{
	echo "0";
}
