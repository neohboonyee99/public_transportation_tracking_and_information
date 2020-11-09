<?php
    require 'DB_Functions.php';
    require 'config.php';
 
    if (isset($_POST['plateNumber']) && isset($_POST['currentBusStop']) && isset($_POST['nextStop'])){
        $plateNumber = $_POST['plateNumber'];
        $currentBusStop = $_POST['currentBusStop'];
        $nextStop = $_POST['nextStop'];

        $db = new DB_Functions();

        $updateBusStop = $db->updateBusStop($plateNumber, $currentBusStop, $nextStop);

        if ($updateBusStop){
            $response['msg'] = "Successful updated bus stop";
            echo json_encode($response);
        }

        else{
            $response['msg'] = "Fail to update bus stop";
            echo json_encode($response);
        }
    }
    
?>