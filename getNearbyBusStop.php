<?php
    require 'DB_Functions.php';
    require 'config.php';

    //Get POST Data
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $maxDistance = 2; //kilometers

    $db = new DB_Functions();

    $busStops = $db->getNearbyBusStop($latitude,$longitude, $maxDistance);
    

    if($busStops){
        $response['bus_stops'] = $busStops;
        $response['error'] = false;
        $response['msg'] = "Successfully get nearby bus stops.";
        echo json_encode($response);
    }
    else{
        $response['error'] = true;
        $response['msg'] = "Unsuccessful to get nearby bus stop.";
        echo json_encode($response);
    }

?>