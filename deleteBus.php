<?php
    require 'DB_Functions.php';
    require 'config.php';

    if (isset($_POST['plateNumber'])){
        $plateNumber = $_POST['plateNumber'];

        $db = new DB_Functions();

        $deleteBus = $db->stopOperation($plateNumber);

        if ($deleteBus){
            $response['msg'] = "Stopping Operation";
            echo json_encode($response);
        }
        else{
            $response['msg'] = "Fail to stop operation";
            echo json_encode($response);
        }
            
    }
?>