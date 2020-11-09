<?php
    require 'DB_Functions.php';
    require 'config.php';

    if (isset($_POST['routeNumber']) && isset($_POST['plateNumber']) && isset($_POST['latitude']) && isset($_POST['longitude']) && isset($_POST['journey'])){
        $routeNumber = $_POST['routeNumber'];
        $plateNumber = $_POST['plateNumber'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $journey = $_POST['journey'];

        $db = new DB_Functions();

        $createBus = $db->startOperation($routeNumber, $plateNumber, $latitude, $longitude, $journey);

        if ($createBus){
            $response['msg'] = "Starting Operation";
            echo json_encode($response);
        }
        
        else{
            $response['msg'] = "Fail to start operation";
            
            echo json_encode($response);
        }
            
    }
?>