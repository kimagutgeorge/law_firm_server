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

else if($action === "save-client") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $notes = $_POST["notes"];
    $id = $_POST["id"];

    save_client($name, $phone, $email, $address, $notes, $id);
}

else if($action === "change-client-status"){
    $status = $_POST["status"];
    $id = $_POST["id"];
    change_client_status($status, $id);

}

else if($action === "del-client"){
    $id = $_POST["id"];
    del_client($id);
}

else if($action === "save-department"){
    $name = $_POST["name"];
    $id = $_POST["id"];
    save_department($name, $id);
}

else if($action === "get-departments"){
    fetch_departments();
}

else if($action === "change-department-status"){
    $status = $_POST["status"];
    $id = $_POST["id"];
    change_department_status($status, $id);
}

else if($action === "del-department"){
    $id = $_POST["id"];
    del_department($id);
}

else if($action === "create-registry"){

}

else if($action === "get-registry"){
    $fetch_option = $_POST["fetch_option"];
    fetch_registry($fetch_option);
}
?>