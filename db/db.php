<?php
    // include("json_format.php");
    $server_namee = "localhost";
    $username = "root";
    $passowrd = "";
    $db_name = "law_firm";

    //create connection
    $conn = new mysqli($server_namee, $username, $passowrd, $db_name);

    // check connection
    if($conn ->connect_error){
        check_json_format();
        die(json_encode([
            "success" => FALSE,
            "error" => "Connection failed ". $conn ->connect_error
        ])) ;
        exit;
        
    }
    

?>