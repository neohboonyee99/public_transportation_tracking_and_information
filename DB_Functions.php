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
    function addNewDriver($driverName,$driverIC,$driverBusRoute,$driverLoginId,$passwordHash,$busPlateNumber){
        $stmt = $this->conn->prepare("INSERT INTO driver (driver_id, driver_password, driver_name,driver_ic,driver_bus_route,busPlateNumber) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("sssiss",$driverLoginId,$passwordHash,$driverName,$driverIC,$driverBusRoute,$busPlateNumber);
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
            $driverDetails['bus_plate_number'] = $row['bus_plate_number'];
            $stmt->close();
            return $driverDetails;
        }
        else{
            $stmt->close();
            return NULL;
        }
    }


    //function to edit bus driver details
    function editBusDriver($driverName,$driverIC,$driverBusRoute,$busPlateNumber){
        $stmt = $this->conn->prepare("UPDATE driver SET driver_name =?, driver_ic =? , driver_bus_route =?, bus_plate_number=? WHERE driver_name =?");
        $stmt->bind_param("sisss",$driverName,$driverIC,$driverBusRoute,$busPlateNumber,$driverName);
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

    //function to get nearby bus stops
    function getNearbyBusStop($latitude, $longitude, $maxDistance){
        $stmt = $this->conn->prepare("SELECT *, 6377.83 * ACOS( SIN(stops_latitude*PI()/180 ) * SIN( ? *PI()/180 ) + COS(stops_latitude*PI()/180 ) * COS( ? *PI()/180 ) * COS( ( ? *PI()/180) - (stops_longitude*PI()/180) ) ) AS distance FROM bus_stops HAVING distance <= ? ORDER BY distance ASC");
        
        $stmt->bind_param("dddi", $latitude, $latitude, $longitude, $maxDistance);
        if($stmt->execute()){
            $result = $stmt->get_result();
            $busStops = array();
            while($row = $result->fetch_assoc()){
                $stops['latitude'] = $row['stops_latitude'];
                $stops['longitude'] = $row['stops_longitude'];
                $stops['stops_name'] = $row['stops_name'];
    
                array_push($busStops, $stops);
            }
            $stmt->close();
            return $busStops;
        }
        else{
            $stmt->close();
            return false;
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
                    $temp['1st_stop_go']= $row['1st_stop_go'];
                    $temp['2nd_stop_go']= $row['2nd_stop_go'];
                    $temp['3rd_stop_go']= $row['3rd_stop_go'];
                    $temp['4th_stop_go']= $row['4th_stop_go'];
                    $temp['5th_stop_go']= $row['5th_stop_go'];
                    $temp['6th_stop_go']= $row['6th_stop_go'];
                    $temp['7th_stop_go']= $row['7th_stop_go'];
                    $temp['8th_stop_go']= $row['8th_stop_go'];
                    $temp['9th_stop_go']= $row['9th_stop_go'];
                    $temp['10th_stop_go']= $row['10th_stop_go'];
                    $temp['11th_stop_go']= $row['11th_stop_go'];
                    $temp['12th_stop_go']= $row['12th_stop_go'];
                    $temp['13th_stop_go']= $row['13th_stop_go'];
                    $temp['14th_stop_go']= $row['14th_stop_go'];
                    $temp['15th_stop_go']= $row['15th_stop_go'];
                    $temp['16th_stop_go']= $row['16th_stop_go'];
                    $temp['17th_stop_go']= $row['17th_stop_go'];
                    $temp['18th_stop_go']= $row['18th_stop_go'];
                    $temp['19th_stop_go']= $row['19th_stop_go'];
                    $temp['20th_stop_go']= $row['20th_stop_go'];
                    $temp['1st_stop_back']= $row['1st_stop_back'];
                    $temp['2nd_stop_back']= $row['2nd_stop_back'];
                    $temp['3rd_stop_back']= $row['3rd_stop_back'];
                    $temp['4th_stop_back']= $row['4th_stop_back'];
                    $temp['5th_stop_back']= $row['5th_stop_back'];
                    $temp['6th_stop_back']= $row['6th_stop_back'];
                    $temp['7th_stop_back']= $row['7th_stop_back'];
                    $temp['8th_stop_back']= $row['8th_stop_back'];
                    $temp['9th_stop_back']= $row['9th_stop_back'];
                    $temp['10th_stop_back']= $row['10th_stop_back'];
                    $temp['11th_stop_back']= $row['11th_stop_back'];
                    $temp['12th_stop_back']= $row['12th_stop_back'];
                    $temp['13th_stop_back']= $row['13th_stop_back'];
                    $temp['14th_stop_back']= $row['14th_stop_back'];
                    $temp['15th_stop_back']= $row['15th_stop_back'];
                    $temp['16th_stop_back']= $row['16th_stop_back'];
                    $temp['17th_stop_back']= $row['17th_stop_back'];
                    $temp['18th_stop_back']= $row['18th_stop_back'];
                    $temp['19th_stop_back']= $row['19th_stop_back'];
                    $temp['20th_stop_back']= $row['20th_stop_back'];

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

    //function to get route details by journey
    function getRouteDetailsByJourney($routeNumber,$journey){
        if ($journey=="true"){
            $stmt = $this->conn->prepare("SELECT * FROM bus_route WHERE route_number = ?");
            $stmt->bind_param('s',$routeNumber);
            if($stmt->execute()){
                $row = $stmt->get_result()->fetch_assoc();
                $temp['start_stop']= $row['start_stop'];
                $temp['1st_stop_go']= $row['1st_stop_go'];
                $temp['2nd_stop_go']= $row['2nd_stop_go'];
                $temp['3rd_stop_go']= $row['3rd_stop_go'];
                $temp['4th_stop_go']= $row['4th_stop_go'];
                $temp['5th_stop_go']= $row['5th_stop_go'];
                $temp['6th_stop_go']= $row['6th_stop_go'];
                $temp['7th_stop_go']= $row['7th_stop_go'];
                $temp['8th_stop_go']= $row['8th_stop_go'];
                $temp['9th_stop_go']= $row['9th_stop_go'];
                $temp['10th_stop_go']= $row['10th_stop_go'];
                $temp['11th_stop_go']= $row['11th_stop_go'];
                $temp['12th_stop_go']= $row['12th_stop_go'];
                $temp['13th_stop_go']= $row['13th_stop_go'];
                $temp['14th_stop_go']= $row['14th_stop_go'];
                $temp['15th_stop_go']= $row['15th_stop_go'];
                $temp['16th_stop_go']= $row['16th_stop_go'];
                $temp['17th_stop_go']= $row['17th_stop_go'];
                $temp['18th_stop_go']= $row['18th_stop_go'];
                $temp['19th_stop_go']= $row['19th_stop_go'];
                $temp['20th_stop_go']= $row['20th_stop_go'];
            
                $stmt->close();
                return $temp;
                
            }
            else{
                $stmt->close();
                return NULL;
            }  
        }
        else{
            $stmt2 = $this->conn->prepare("SELECT * FROM bus_route WHERE route_number = ?");
            $stmt2->bind_param('s',$routeNumber);
            if($stmt2->execute()){
                $row = $stmt2->get_result()->fetch_assoc();
                $temp['back_stop']= $row['back_stop'];
                $temp['1st_stop_back']= $row['1st_stop_back'];
                $temp['2nd_stop_back']= $row['2nd_stop_back'];
                $temp['3rd_stop_back']= $row['3rd_stop_back'];
                $temp['4th_stop_back']= $row['4th_stop_back'];
                $temp['5th_stop_back']= $row['5th_stop_back'];
                $temp['6th_stop_back']= $row['6th_stop_back'];
                $temp['7th_stop_back']= $row['7th_stop_back'];
                $temp['8th_stop_back']= $row['8th_stop_back'];
                $temp['9th_stop_back']= $row['9th_stop_back'];
                $temp['10th_stop_back']= $row['10th_stop_back'];
                $temp['11th_stop_back']= $row['11th_stop_back'];
                $temp['12th_stop_back']= $row['12th_stop_back'];
                $temp['13th_stop_back']= $row['13th_stop_back'];
                $temp['14th_stop_back']= $row['14th_stop_back'];
                $temp['15th_stop_back']= $row['15th_stop_back'];
                $temp['16th_stop_back']= $row['16th_stop_back'];
                $temp['17th_stop_back']= $row['17th_stop_back'];
                $temp['18th_stop_back']= $row['18th_stop_back'];
                $temp['19th_stop_back']= $row['19th_stop_back'];
                $temp['20th_stop_back']= $row['20th_stop_back'];
            
                $stmt2->close();
                return $temp;
                
            }
            else{
                $stmt2->close();
                return NULL;
            }  
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
    //function to start operation
    function startOperation($routeNumber, $plateNumber, $latitude,$longitude,$journey){
        if($journey){
            $startStop = NULL;
            $nextStop = NULL;
            $stmt = $this->conn->prepare("SELECT * FROM bus_route WHERE route_number = ?");
            $stmt->bind_param('s', $routeNumber);

            if ($stmt->execute()){
                $result = $stmt->get_result();

                if (mysqli_num_rows($result)>0){
                    $row = $result->fetch_assoc();
                    $startStop = $row['start_stop'];
                    $nextStop = $row['1st_stop_go'];
                    $stmt->close();

                    
                }
                $stmt3 = $this->conn->prepare("INSERT INTO bus (bus_route_number, latitude, longitude, current_stops,next_stop, plate_number) VALUES (?,?,?,?,?,?)");
                $stmt3->bind_param('sddsss', $routeNumber, $latitude, $longitude, $startStop,$nextStop, $plateNumber);

                if ($stmt3->execute()){
                    $stmt3->close();
                    return true;
                }
                else{
                    $stmt3->close();
                    return false;
                }


            }
            else{
                $stmt->close();
                return false;
            }

            
        }
        else{
            $stmt2 = $this->conn->prepare("SELECT * FROM bus_route WHERE route_number = ?");
            $stmt2->bind_param('s', $routeNumber);

            if ($stmt2->execute()){
                $result2 = $stmt2->get_result();
                if (mysqli_num_rows($result2)>0){
                    $row2 = $result2->fetch_assoc();
                    $backStop = $row2['back_stop'];
                    $nextStop = $row2['1st_stop_back'];
                    $stmt2->close();

                    $stmt4 = $this->conn->prepare("INSERT INTO bus (bus_route_number, latitude, longitude, current_stops,next_stop, plate_number) VALUES (?,?,?,?,?,?)");
                    $stmt4->bind_param('sddsss', $routeNumber, $latitude, $longitude, $backStop,$nextStop,$plateNumber);
        
                    if ($stmt4->execute()){
                        $stmt4->close();
                        return true;
                    }
                    else{
                        $stmt4->close();
                        return false;
                    }
                }
            }
            else{
                $stmt->close();
                return false;
            }

           
        }     
    }

    //function to delete bus when bus driver stop operation
    function stopOperation($plateNumber){
        $stmt= $this->conn->prepare("DELETE from bus WHERE plate_number = ?");
        $stmt->bind_param('s',$plateNumber);

        if ($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }

    }

     //function to update bus current stop and next stop
     function updateBusStop($plateNumber,$currentBusStop, $nextStop){
        $stmt = $this->conn->prepare("UPDATE bus SET current_stops =?, next_stop =? WHERE plate_number =?");
        $stmt->bind_param('sss', $currentBusStop, $nextStop,$plateNumber);

        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
        
    }

    //function to update location
    function updateLocation($busPlateNumber,$latitude,$longitude){
        $stmt = $this->conn->prepare("UPDATE bus SET latitude =?, longitude =? WHERE plate_number =?");
        $stmt->bind_param('dds', $latitude, $longitude, $plateNumber);

        if($stmt->execute()){
            $stmt->close();
            return true;
        }
        else{
            $stmt->close();
            return false;
        }
        
    }
    
    //function to check driver exist or not for Android
    function isDriverExistAndroid($username){
        $stmt = $this->conn->prepare("SELECT * FROM driver WHERE driver_id = ?");
        $stmt->bind_param('s', $username);

        if($stmt->execute()){
            $result = $stmt->get_result();
            if(mysqli_num_rows($result)>0){
                $row = $result->fetch_assoc();
                $stmt->close();
                $exist['error_code'] =1;
            }
            else {
                $stmt->close();
                $exist['error_code'] =2;
            }

        }
        else{
            $stmt->close();
            $exist['error_code'] =2;
           
        }
        return $exist;
    }

    //function to get driverInfo by username for android
    function getDriverInfo($username){
        $isExecuteError = false;

        $stmt = $this->conn->prepare("SELECT * FROM driver WHERE driver_id =?");
        $stmt->bind_param('s',$username);

        if($stmt->execute()){
            $result = $stmt->get_result();
            if(mysqli_num_rows($result)>0){
                $assoc = $result->fetch_assoc();
                $driverInfo['password_hash'] = $assoc['driver_password'];
                $driverInfo['route_number'] = $assoc['driver_bus_route'];
                $driverInfo['bus_plate_number'] = $assoc['bus_plate_number'];
                $driverInfo['error_code'] =0;
                $stmt->close();
                return $driverInfo;
            }

        }
        else{
            $stmt->close();
            $driverInfo['error_code'] =3;
            return $driverInfo;
        }

    }


    //function to get bus stops details by stop name
    function getBusStopsDetails($stopsName){
        $stmt = $this->conn->prepare("SELECT * FROM bus_stops WHERE stops_name = ?");
        $stmt->bind_param('s',$stopsName);

        if($stmt->execute()){
            $result = $stmt->get_result();
            if(mysqli_num_rows($result)>0){
                $assoc = $result->fetch_assoc();
                $busStopsDetails['latitude'] = $assoc['stops_latitude'];
                $busStopsDetails['longitude'] = $assoc['stops_longitude'];
                
            }
            $stmt->close();
            return $busStopsDetails;

        }
        else{
            $stmt->close();
            return false;
        }
    }

    //function to get bus by checking next stop
    function getBusByNextStop($stopName){
        $stmt = $this->conn->prepare("SELECT * FROM bus WHERE next_stop = ?");
        $stmt->bind_param('s',$stopName);
        $busDetails = array();

        if($stmt->execute()){
            $result = $stmt->get_result(); 
            
            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){
                    $temp['latitude'] = $row['latitude'];
                    $temp['longitude'] = $row['longitude'];
                    $temp['route_number'] = $row['bus_route_number'];

                    $busDetails[] = $temp;
                    
                }
                $stmt->close();
                return $busDetails;
            }    
        }

        else{
            $stmt->close();
            return false;
        }
    }

    //function to get bus by checking next stop
    function getBusByNextStopByRouteNum($routeNumber, $stopName){
        $stmt = $this->conn->prepare("SELECT * FROM bus WHERE next_stop = ?, bus_route_number=?");
        $stmt->bind_param('ss',$stopName,$routeNumber);
        $busDetails = array();

        if($stmt->execute()){
            $result = $stmt->get_result(); 
            
            if(mysqli_num_rows($result)>0){

                while($row=mysqli_fetch_assoc($result)){
                    $temp['latitude'] = $row['latitude'];
                    $temp['longitude'] = $row['longitude'];
                    $temp['route_number'] = $row['bus_route_number'];

                    $busDetails[] = $temp;
                    
                }
                $stmt->close();
                return $busDetails;
            }    
        }

        else{
            $stmt->close();
            return false;
        }
    }
}
?>