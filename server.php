<?php
    ob_start();
    /* imports */
    require_once("static/config.php");
    // require_once("static/db.php");
    require_once("static/helper_functions.php");
    include("db/functions.php");
    
if($action === "get-clients"){
      fetch_clients();
}
// save client
else if($action === "save-client") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $notes = $_POST["notes"];
    $id = $_POST["id"];

    save_client($name, $phone, $email, $address, $notes, $id);
}else if($action === "change-status"){
    $status = $_POST["status"];
    $id = $_POST["id"];
    change_client_status($status, $id);

}else if($action === "del-client"){
    $id = $_POST["id"];
    del_client($id);
}

?>