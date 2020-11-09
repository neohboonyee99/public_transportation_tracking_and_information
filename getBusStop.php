<?php
    require 'DB_Functions.php';
    require 'config.php';

    if (isset($_POST['routeNumber'])&& isset($_POST['journey'])){
        $routeNumber = $_POST['routeNumber'];
        $journey = $_POST['journey'];
    

        $db = new DB_Functions();

        $getBusRouteDetailsByJourney= $db->getRouteDetailsByJourney($routeNumber,$journey);

        if ($getBusRouteDetailsByJourney){
            $response['msg'] = "Succesful for getting bus route";
            $response['bus_route'] = $getBusRouteDetailsByJourney;
            echo json_encode($response);
        }
        else{
            $response['msg'] = "Fail to get bus route";
            echo json_encode($response);
        }
            
    }
?>