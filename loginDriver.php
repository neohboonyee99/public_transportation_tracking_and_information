<?php
    require 'DB_Functions.php';
    require 'config.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new DB_Functions();
    $userExist = $db->isDriverExistAndroid($username);

    if($userExist){
        $errorCode = $userExist['error_code'];

        if ($errorCode ==2){
            $response['login_status'] = 0;
            $response['error_code'] = 2;
            $response['error_msg'] = "User not found";
            echo json_encode($response);
        }
        else{
            $getDriverInfo = $db->getDriverInfo($username);
        
            if ($getDriverInfo){
                if ($getDriverInfo['error_code'] ==3 ){
                    $response['error_msg'] = "Server error";
                    $response['login_status'] = 0;
                    echo json_encode($response);
    
                }
                else{
                    $passwordHash = $getDriverInfo['password_hash'];
                    if(password_verify($password, $passwordHash)){
                        $response['login_status'] = 1;
                        $response['msg'] = "Successfully loggged in";
                        $response['driver'] = $getDriverInfo;
                        echo json_encode($response);
                    }
                    else{
                        $response['login_status'] = 0;
                        $response['error_code'] = 1;
                        $response['error_msg'] = "Wrong password";
                        echo json_encode($response);
                    }
    
                }
            }
        }
        
    }  
    
    
?>