<?php
    require "DB_Functions.php";
    $db = new DB_Functions();

    if (isset($_POST['btn_delete_stop'])){
        if (isset($_POST['stops_name'])){
            $stopName = $_POST['stops_name'];
           
            if (empty($stopName)){
                echo "<script>alert('Unsuccessful to delete bus stop!')";
            }
            
            $delete = $db->deleteBusStop($stopName);

            if($delete){
                echo "<script>alert('Successfully deleted bus stop!')";
                
            }
            else{
                echo "<script>alert('Unsuccessful to delete bus stop!')";
                
            }
        }
        else{
            echo "<script>alert('Unsuccessful to delete bus stop!')";
        }
        
        
    }
?>