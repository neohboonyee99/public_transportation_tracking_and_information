<?php
    require 'DB_Functions.php';
    require 'config.php';

    if (isset($_POST['stops_name'])){
        $stopsName = $_POST['stops_name'];

        $db = new DB_Functions();

        $getBusStopsDetails= $db->getBusStopsDetails($stopsName);

        if ($getBusStopsDetails){
            $response['msg'] = "Succesful for getting bus stops details";
            $response['stop_details'] = $getBusStopsDetails;
            echo json_encode($response);
        }
        else{
            $response['msg'] = "Fail to get bus stops detail";
            echo json_encode($response);
        }
            
    }
?>