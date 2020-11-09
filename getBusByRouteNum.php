<?php
    require 'DB_Functions.php';
    require 'config.php';

    if (isset($_POST['stop_name']) && isset($_POST['route_number'])){
        $stopName = $_POST['stop_name'];
        $routeNum = $_POST['route_number']
    
        $db = new DB_Functions();

        $getBusByNextStop= $db->getBusByNextStopByRouteNum($routeNum, $stopName);

        if ($getBusByNextStop){
            $response['msg'] = "Succesful for getting bus";
            $response['error'] = false;
            $response['bus'] = $getBusByNextStop;
            echo json_encode($response);
        }
        else{
            $response['msg'] = "Fail to get bus";
            $response['error'] = true;
            echo json_encode($response);
        }
            
    }
?>