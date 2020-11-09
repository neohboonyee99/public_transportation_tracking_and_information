<?php
    require 'DB_Functions.php';
    require 'config.php';

    $db = new DB_Functions();

    $getRoute= $db->getBusRoute();

    if ($getRoute){
        $response['msg'] = "Succesful for getting bus route";
        $response['bus_route'] = $getRoute;
        echo json_encode($response);
    }
    else{
        $response['msg'] = "Fail to get bus route";
        echo json_encode($response);
    }
        
    
?>