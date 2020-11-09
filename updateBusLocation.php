<?php
    require 'DB_Functions.php';
    require 'config.php';

    if (isset($_POST['plateNumber']) && isset($_POST['latitude']) && isset($_POST['longitude']) ){
        $plateNumber = $_POST['plateNumber'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];

        $db = new DB_Functions();

        $updateLocation = $db->updateLocation($plateNumber, $latitude, $longitude);

        if ($updateLocation){
            $response['msg'] = "Updating location";
            echo json_encode($response);
        }
        else{
            $response['msg'] = "Fail to update location";
            echo json_encode($response);
        }
            
    }
?>