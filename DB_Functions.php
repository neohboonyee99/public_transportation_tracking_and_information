<?php

class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
    }

    //function to check existing driver
    function isDriverExist($driverLoginId,$driverName,$driverIC,$driverBusRoute){
        $stmt = $this->conn->prepare("SELECT * FROM driver WHERE driver_id =? AND driver_name = ? AND driver_ic = ? AND driver_bus_route = ?");
        
        $stmt->bind_param('ssis',$driverLoginId, $driverName, $driverIC, $driverBusRoute);
        if ($stmt->execute()){
            $result = $stmt->get_result();

            if (mysqli_num_rows($result)>0){
                //driver exist
                $stmt->close();
                return true;
            }
            else{
                //driver does not exist
                $stmt->close();
                return false;
            }
        }

        else{
            return true;
        }

       
    }

    //function to add new driver
    function addNewDriver($driverName,$driverIC,$driverBusRoute,$driverLoginId,$passwordHash){
        $stmt = $this->conn->prepare("INSERT INTO driver (driver_id, driver_password, driver_name,driver_ic,driver_bus_route) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssis",$driverLoginId,$passwordHash,$driverName,$driverIC,$driverBusRoute);
        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

    //function to get all driver details
    function getBusDriver(){
        $busDriver = array();
        $stmt = $this->conn->prepare("SELECT * FROM driver");
        if($stmt->execute()){
            $result = $stmt->get_result();
            if (mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    $temp['driver_name']= $row['driver_name'];
                    $temp['driver_ic']= $row['driver_ic'];
                    $temp['driver_bus_route']= $row['driver_bus_route'];

                    $busDriver[] = $temp;
                }

                $stmt->close();
                return $busDriver;
            }
        }
        else{
            $stmt->close();
            return NULL;
        }  
    }

    //function to get driver details by name
    function getDriverDetailsByName($driverName){
        $stmt = $this->conn->prepare("SELECT * FROM driver WHERE driver_name =?");
        $stmt->bind_param('s',$driverName);
        if($stmt->execute()){
            $row =$stmt->get_result()->fetch_assoc();
            $driverDetails['driver_name'] = $row['driver_name'];
            $driverDetails['driver_ic'] = $row['driver_ic'];
            $driverDetails['driver_bus_route'] = $row['driver_bus_route'];
            $stmt->close();
            return $driverDetails;
        }
        else{
            $stmt->close();
            return NULL;
        }
    }


    //function to edit bus driver details
    function editBusDriver($driverName,$driverIC,$driverBusRoute){
        $stmt = $this->conn->prepare("UPDATE driver SET driver_name =?, driver_ic =? , driver_bus_route =? WHERE driver_name =?");
        $stmt->bind_param("siss",$driverName,$driverIC,$driverBusRoute,$driverName);
        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

    //function to delete bus driver
    function deleteBusDriver($driverName){
        $stmt = $this->conn->prepare("DELETE from driver WHERE driver_name = ?");
        $stmt->bind_param('s', $driverName);
        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

    //function to check existing bus stop
    function isStopExist($stopName){
        $stmt = $this->conn->prepare("SELECT * FROM bus_stops WHERE stops_name = ?");
        
        $stmt->bind_param('s', $stopName);
        
        if ($stmt->execute()){
            $result = $stmt->get_result();

            if (mysqli_num_rows($result)>0){
                //bus stop exist
                $stmt->close();
                return true;
            }
            else{
                //bus stop does not exist
                $stmt->close();
                return false;
            }
        }

        else{
            return true;
        }
    }

    //function to add new bus stop
    function addNewBusStop($stopName,$latitude,$longitude){
        $stmt = $this->conn->prepare("INSERT INTO bus_stops (stops_name, stops_latitude, stops_longitude) VALUES (?,?,?)");
        $stmt->bind_param('sdd',$stopName, $latitude, $longitude);
        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

    //function to get all bus stops
    function getBusStops(){
        $busStop = array();
        $stmt = $this->conn->prepare("SELECT * FROM bus_stops");
        if($stmt->execute()){
            $result = $stmt->get_result();
            if (mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    $temp['name']= $row['stops_name'];
                    $temp['latitude']= $row['stops_latitude'];
                    $temp['longitude']= $row['stops_longitude'];

                    $busStop[] = $temp;
                }

                $stmt->close();
                return $busStop;
            }

            
        }
        else{
            $stmt->close();
            return NULL;
        }  
    }

    //function to delete bus stop
    function deleteBusStop($stopName){
        $stmt = $this->conn->prepare("DELETE from bus_stops WHERE stops_name = ?");
        $stmt->bind_param('s', $stopName);
        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

    //function to check existing bus route
    function isRouteExist($routeNumber){
        $stmt = $this->conn->prepare("SELECT * FROM bus_route WHERE route_number = ?");
        
        $stmt->bind_param('s', $routeNumber);
        
        if ($stmt->execute()){
            $result = $stmt->get_result();

            if (mysqli_num_rows($result)>0){
                //route exist
                $stmt->close();
                return true;
            }
            else{
                //route does not exist
                $stmt->close();
                return false;
            }
        }

        else{
            return true;
        }
    }

    //function to add new bus route
    function addNewRoute($routeNumber,$startStop,$backStop,$startStop1st,$startStop2nd,$startStop3rd,$startStop4th,$startStop5th,$startStop6th,$startStop7th,$startStop8th,$startStop9th,$startStop10th,$startStop11th,$startStop12th,$startStop13th,$startStop14th,$startStop15th,$startStop16th,$startStop17th,$startStop18th,$startStop19th,$startStop20th,$backStop1st,$backStop2nd,$backStop3rd,$backStop4th,$backStop5th,$backStop6th,$backStop7th,$backStop8th,$backStop9th,$backStop10th,$backStop11th,$backStop12th,$backStop13th,$backStop14th,$backStop15th,$backStop16th,$backStop17th,$backStop18th,$backStop19th,$backStop20th){

        $stmt = $this->conn->prepare("INSERT INTO bus_route (route_number, start_stop, back_stop, 1st_stop_go, 2nd_stop_go, 3rd_stop_go, 4th_stop_go, 5th_stop_go, 6th_stop_go, 7th_stop_go, 8th_stop_go, 9th_stop_go, 10th_stop_go, 11th_stop_go, 12th_stop_go, 13th_stop_go, 14th_stop_go, 15th_stop_go, 16th_stop_go, 17th_stop_go, 18th_stop_go, 19th_stop_go, 20th_stop_go, 1st_stop_back, 2nd_stop_back, 3rd_stop_back, 4th_stop_back, 5th_stop_back, 6th_stop_back, 7th_stop_back, 8th_stop_back, 9th_stop_back, 10th_stop_back, 11th_stop_back, 12th_stop_back, 13th_stop_back, 14th_stop_back, 15th_stop_back, 16th_stop_back, 17th_stop_back, 18th_stop_back, 19th_stop_back, 20th_stop_back ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param('sssssssssssssssssssssssssssssssssssssssssss',$routeNumber,$startStop,$backStop,$startStop1st,$startStop2nd,$startStop3rd,$startStop4th,$startStop5th,$startStop6th,$startStop7th,$startStop8th,$startStop9th,$startStop10th,$startStop11th,$startStop12th,$startStop13th,$startStop14th,$startStop15th,$startStop16th,$startStop17th,$startStop18th,$startStop19th,$startStop20th,$backStop1st,$backStop2nd,$backStop3rd,$backStop4th,$backStop5th,$backStop6th,$backStop7th,$backStop8th,$backStop9th,$backStop10th,$backStop11th,$backStop12th,$backStop13th,$backStop14th,$backStop15th,$backStop16th,$backStop17th,$backStop18th,$backStop19th,$backStop20th);

        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

     //function to get all bus route
     function getBusRoute(){
        $busRoute = array();
        $stmt = $this->conn->prepare("SELECT * FROM bus_route");
        if($stmt->execute()){
            $result = $stmt->get_result();
            if (mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    $temp['route_number']= $row['route_number'];
                    $temp['start_stop']= $row['start_stop'];
                    $temp['back_stop']= $row['back_stop'];
                    $temp['startStop1st']= $row['1st_stop_go'];
                    $temp['startStop2nd']= $row['2nd_stop_go'];
                    $temp['startStop3rd']= $row['3rd_stop_go'];
                    $temp['startStop4th']= $row['4th_stop_go'];
                    $temp['startStop5th']= $row['5th_stop_go'];
                    $temp['startStop6th']= $row['6th_stop_go'];
                    $temp['startStop7th']= $row['7th_stop_go'];
                    $temp['startStop8th']= $row['8th_stop_go'];
                    $temp['startStop9th']= $row['9th_stop_go'];
                    $temp['startStop10th']= $row['10th_stop_go'];
                    $temp['startStop11th']= $row['11th_stop_go'];
                    $temp['startStop12th']= $row['12th_stop_go'];
                    $temp['startStop13th']= $row['13th_stop_go'];
                    $temp['startStop14th']= $row['14th_stop_go'];
                    $temp['startStop15th']= $row['15th_stop_go'];
                    $temp['startStop16th']= $row['16th_stop_go'];
                    $temp['startStop17th']= $row['17th_stop_go'];
                    $temp['startStop18th']= $row['18th_stop_go'];
                    $temp['startStop19th']= $row['19th_stop_go'];
                    $temp['startStop20th']= $row['20th_stop_go'];
                    $temp['backStop1st']= $row['1st_stop_back'];
                    $temp['backStop2nd']= $row['2nd_stop_back'];
                    $temp['backStop3rd']= $row['3rd_stop_back'];
                    $temp['backStop4th']= $row['4th_stop_back'];
                    $temp['backStop5th']= $row['5th_stop_back'];
                    $temp['backStop6th']= $row['6th_stop_back'];
                    $temp['backStop7th']= $row['7th_stop_back'];
                    $temp['backStop8th']= $row['8th_stop_back'];
                    $temp['backStop9th']= $row['9th_stop_back'];
                    $temp['backStop10th']= $row['10th_stop_back'];
                    $temp['backStop11th']= $row['11th_stop_back'];
                    $temp['backStop12th']= $row['12th_stop_back'];
                    $temp['backStop13th']= $row['13th_stop_back'];
                    $temp['backStop14th']= $row['14th_stop_back'];
                    $temp['backStop15th']= $row['15th_stop_back'];
                    $temp['backStop16th']= $row['16th_stop_back'];
                    $temp['backStop17th']= $row['17th_stop_back'];
                    $temp['backStop18th']= $row['18th_stop_back'];
                    $temp['backStop19th']= $row['19th_stop_back'];
                    $temp['backStop20th']= $row['20th_stop_back'];

                    $busRoute[] = $temp;
                }

                $stmt->close();
                return $busRoute;
            }

            
        }
        else{
            $stmt->close();
            return NULL;
        }  
    }

    //function to get route details by route number
    function getRouteDetailsByRouteNumber($routeNumber){
        $stmt = $this->conn->prepare("SELECT * FROM bus_route WHERE route_number = ?");
        $stmt->bind_param('s',$routeNumber);
        if($stmt->execute()){
            $row = $stmt->get_result()->fetch_assoc();
            $temp['route_number']= $row['route_number'];
            $temp['start_stop']= $row['start_stop'];
            $temp['back_stop']= $row['back_stop'];
            $temp['startStop1st']= $row['1st_stop_go'];
            $temp['startStop2nd']= $row['2nd_stop_go'];
            $temp['startStop3rd']= $row['3rd_stop_go'];
            $temp['startStop4th']= $row['4th_stop_go'];
            $temp['startStop5th']= $row['5th_stop_go'];
            $temp['startStop6th']= $row['6th_stop_go'];
            $temp['startStop7th']= $row['7th_stop_go'];
            $temp['startStop8th']= $row['8th_stop_go'];
            $temp['startStop9th']= $row['9th_stop_go'];
            $temp['startStop10th']= $row['10th_stop_go'];
            $temp['startStop11th']= $row['11th_stop_go'];
            $temp['startStop12th']= $row['12th_stop_go'];
            $temp['startStop13th']= $row['13th_stop_go'];
            $temp['startStop14th']= $row['14th_stop_go'];
            $temp['startStop15th']= $row['15th_stop_go'];
            $temp['startStop16th']= $row['16th_stop_go'];
            $temp['startStop17th']= $row['17th_stop_go'];
            $temp['startStop18th']= $row['18th_stop_go'];
            $temp['startStop19th']= $row['19th_stop_go'];
            $temp['startStop20th']= $row['20th_stop_go'];
            $temp['backStop1st']= $row['1st_stop_back'];
            $temp['backStop2nd']= $row['2nd_stop_back'];
            $temp['backStop3rd']= $row['3rd_stop_back'];
            $temp['backStop4th']= $row['4th_stop_back'];
            $temp['backStop5th']= $row['5th_stop_back'];
            $temp['backStop6th']= $row['6th_stop_back'];
            $temp['backStop7th']= $row['7th_stop_back'];
            $temp['backStop8th']= $row['8th_stop_back'];
            $temp['backStop9th']= $row['9th_stop_back'];
            $temp['backStop10th']= $row['10th_stop_back'];
            $temp['backStop11th']= $row['11th_stop_back'];
            $temp['backStop12th']= $row['12th_stop_back'];
            $temp['backStop13th']= $row['13th_stop_back'];
            $temp['backStop14th']= $row['14th_stop_back'];
            $temp['backStop15th']= $row['15th_stop_back'];
            $temp['backStop16th']= $row['16th_stop_back'];
            $temp['backStop17th']= $row['17th_stop_back'];
            $temp['backStop18th']= $row['18th_stop_back'];
            $temp['backStop19th']= $row['19th_stop_back'];
            $temp['backStop20th']= $row['20th_stop_back'];
         
            $stmt->close();
            return $temp;
            
        }
        else{
            $stmt->close();
            return NULL;
        }  
    }

    //function to edit bus route
    function editBusRoute($routeNumber,$startStop,$backStop,$startStop1st,$startStop2nd,$startStop3rd,$startStop4th,$startStop5th,$startStop6th,$startStop7th,$startStop8th,$startStop9th,$startStop10th,$startStop11th,$startStop12th,$startStop13th,$startStop14th,$startStop15th,$startStop16th,$startStop17th,$startStop18th,$startStop19th,$startStop20th,$backStop1st,$backStop2nd,$backStop3rd,$backStop4th,$backStop5th,$backStop6th,$backStop7th,$backStop8th,$backStop9th,$backStop10th,$backStop11th,$backStop12th,$backStop13th,$backStop14th,$backStop15th,$backStop16th,$backStop17th,$backStop18th,$backStop19th,$backStop20th){

        $stmt = $this->conn->prepare("UPDATE bus_route SET route_number=?, start_stop=?, back_stop=?,  1st_stop_go=?,  2nd_stop_go=?,  3rd_stop_go=?,  4th_stop_go=?,  5th_stop_go=?,  6th_stop_go=?,  7th_stop_go=?,  8th_stop_go=?,  9th_stop_go=?,  10th_stop_go=?,  11th_stop_go=?,  12th_stop_go=?,  13th_stop_go=?,  14th_stop_go=?,  15th_stop_go=?,  16th_stop_go=?,  17th_stop_go=?,  18th_stop_go=?,  19th_stop_go=?,  20th_stop_go=?,  1st_stop_back=?,  2nd_stop_back=?,  3rd_stop_back=?,  4th_stop_back=?,  5th_stop_back=?,  6th_stop_back=?,  7th_stop_back=?,  8th_stop_back=?,  9th_stop_back=?,  10th_stop_back=?,  11th_stop_back=?,  12th_stop_back=?,  13th_stop_back=?,  14th_stop_back=?,  15th_stop_back=?,  16th_stop_back=?,  17th_stop_back=?,  18th_stop_back=?,  19th_stop_back=?,  20th_stop_back=? WHERE route_number =?");
        $stmt->bind_param('ssssssssssssssssssssssssssssssssssssssssssss',$routeNumber,$startStop,$backStop,$startStop1st,$startStop2nd,$startStop3rd,$startStop4th,$startStop5th,$startStop6th,$startStop7th,$startStop8th,$startStop9th,$startStop10th,$startStop11th,$startStop12th,$startStop13th,$startStop14th,$startStop15th,$startStop16th,$startStop17th,$startStop18th,$startStop19th,$startStop20th,$backStop1st,$backStop2nd,$backStop3rd,$backStop4th,$backStop5th,$backStop6th,$backStop7th,$backStop8th,$backStop9th,$backStop10th,$backStop11th,$backStop12th,$backStop13th,$backStop14th,$backStop15th,$backStop16th,$backStop17th,$backStop18th,$backStop19th,$backStop20th,$routeNumber);

        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

    //function to delete bus route
    function deleteBusRoute($routeNumber){
        $stmt = $this->conn->prepare("DELETE from bus_route WHERE route_number = ?");
        $stmt->bind_param('s', $routeNumber);
        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
    }

    
}
?>