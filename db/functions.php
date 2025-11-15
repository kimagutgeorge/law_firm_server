<?php
require_once("db.php");

// get clients
function fetch_clients(){
    global $conn; // <-- add this line to access $conn from db.php
    try {
            $sql = "SELECT * FROM clients ORDER BY id DESC"; // table names are usually lowercase

            $stmt = $conn->prepare($sql);

            if (!$stmt) { // check if prepare failed
                send_json_response(FALSE, "Prepare failed: " . $conn->error);
                return false;
            }

            // No bind_param needed because there are no placeholders

            if ($stmt->execute()) {
                $result = $stmt->get_result(); // get the result set
                $clients = $result->fetch_all(MYSQLI_ASSOC); // fetch as associative array
                send_json_response(TRUE, "Clients fetched successfully", $clients);
            } else {
                send_json_response(FALSE, "Execute failed: " . $stmt->error);
            }

            $stmt->close();
            $conn->close();

        } catch (Exception $e) {
            send_json_response(FALSE, "Error fetching clients: " . $e->getMessage());
        }
}

// add client
function save_client($name, $phone, $email, $address, $notes, $id){
    global $conn;

    try{

        if($id === ""){

            $sql = "INSERT INTO clients(client_name, contact, address, email, notes) VALUES (?,?,?,?,?)";

            $stmt = $conn->prepare($sql);

            if (!$stmt) { // check if prepare failed
                send_json_response(FALSE, "Prepare failed: " . $conn->error);
                return false;
            }

            $stmt->bind_param('sssss', $name, $phone, $address, $email, $notes);

            if ($stmt->execute()) {
                send_json_response(TRUE, "Client Added");
            } else {
                send_json_response(FALSE, "Execute failed: " . $stmt->error);
            }
        
        }else{
            $sql = "UPDATE clients set client_name = ?, contact = ?, address = ?, email = ?, notes = ? WHERE id = ? ";

            $stmt = $conn->prepare($sql);

            if (!$stmt) { // check if prepare failed
                send_json_response(FALSE, "Prepare failed: " . $conn->error);
                return false;
            }

            $stmt->bind_param('ssssss', $name, $phone, $address, $email, $notes, $id);

            if ($stmt->execute()) {
                send_json_response(TRUE, "Client Updated");
            } else {
                send_json_response(FALSE, "Execute failed: " . $stmt->error);
            }
        }

        $stmt->close();
        $conn->close();

    }catch (Exception $e) {
        if($id == ""){
            send_json_response(FALSE, "Error Adding Client:".$e);
        }else{
            send_json_response(FALSE, "Error Updating Client:".$e);
        }
        
    }
}

// change client status
function change_client_status($status, $id){
    global $conn;

    try{

        $sql = "UPDATE clients SET status = ? where id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) { // check if prepare failed
            send_json_response(FALSE, "Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param('ss', $status, $id);

        if ($stmt->execute()) {
            send_json_response(TRUE, "Status updated");
        } else {
            send_json_response(FALSE, "Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

    }catch (Exception $e) {
        send_json_response(FALSE, "Error Updating Status:".$e);
    }
}

// delete client
function del_client($id){
    global $conn;

    try{

        $sql = "DELETE FROM clients where id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) { // check if prepare failed
            send_json_response(FALSE, "Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param('s', $id);

        if ($stmt->execute()) {
            send_json_response(TRUE, "Client deleted");
        } else {
            send_json_response(FALSE, "Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

    }catch (Exception $e) {
        send_json_response(FALSE, "Error deleting Client:".$e);
    }
}

// add department
function save_department($name, $id){
    global $conn;

    try{

        if($id === ""){

            $sql = "INSERT INTO departments(name) VALUES (?)";

            $stmt = $conn->prepare($sql);

            if (!$stmt) { // check if prepare failed
                send_json_response(FALSE, "Prepare failed: " . $conn->error);
                return false;
            }

            $stmt->bind_param('s', $name);

            if ($stmt->execute()) {
                send_json_response(TRUE, "Department Added");
            } else {
                send_json_response(FALSE, "Execute failed: " . $stmt->error);
            }
        
        }else{
            $sql = "UPDATE departments set name = ? WHERE id = ? ";

            $stmt = $conn->prepare($sql);

            if (!$stmt) { // check if prepare failed
                send_json_response(FALSE, "Prepare failed: " . $conn->error);
                return false;
            }

            $stmt->bind_param('ss', $name, $id);

            if ($stmt->execute()) {
                send_json_response(TRUE, "Department Updated");
            } else {
                send_json_response(FALSE, "Execute failed: " . $stmt->error);
            }
        }

        $stmt->close();
        $conn->close();

    }catch (Exception $e) {
        if($id == ""){
            send_json_response(FALSE, "Error Adding Department:".$e);
        }else{
            send_json_response(FALSE, "Error Updating Department:".$e);
        }
        
    }
}
// get departments
function fetch_departments(){
    global $conn; // <-- add this line to access $conn from db.php
    try {
            $sql = "SELECT * FROM departments ORDER BY id DESC"; // table names are usually lowercase

            $stmt = $conn->prepare($sql);

            if (!$stmt) { // check if prepare failed
                send_json_response(FALSE, "Prepare failed: " . $conn->error);
                return false;
            }

            // No bind_param needed because there are no placeholders

            if ($stmt->execute()) {
                $result = $stmt->get_result(); // get the result set
                $departments = $result->fetch_all(MYSQLI_ASSOC); // fetch as associative array
                send_json_response(TRUE, "Departments fetched successfully", $departments);
            } else {
                send_json_response(FALSE, "Execute failed: " . $stmt->error);
            }

            $stmt->close();
            $conn->close();

        } catch (Exception $e) {
            send_json_response(FALSE, "Error fetching departments: " . $e->getMessage());
        }
}


//change department status
function change_department_status($status, $id){
    global $conn;

    try{

        $sql = "UPDATE departments SET status = ? where id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) { // check if prepare failed
            send_json_response(FALSE, "Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param('ss', $status, $id);

        if ($stmt->execute()) {
            send_json_response(TRUE, "Status updated");
        } else {
            send_json_response(FALSE, "Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

    }catch (Exception $e) {
        send_json_response(FALSE, "Error Updating Status:".$e);
    }
}

// delete department
function del_department($id) {
    global $conn;

    try{

        $sql = "DELETE FROM departments where id = ?";

        $stmt = $conn->prepare($sql);

        if (!$stmt) { // check if prepare failed
            send_json_response(FALSE, "Prepare failed: " . $conn->error);
            return false;
        }

        $stmt->bind_param('s', $id);

        if ($stmt->execute()) {
            send_json_response(TRUE, "Department deleted");
        } else {
            send_json_response(FALSE, "Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();

    }catch (Exception $e) {
        send_json_response(FALSE, "Error deleting Department:".$e);
    }
}

// fetch registry
function fetch_registry($fetch_option){
    global $conn; // <-- add this line to access $conn from db.php
    
    try {
            $sql = "SELECT * FROM registry ORDER BY id DESC"; // table names are usually lowercase

            $stmt = $conn->prepare($sql);

            if (!$stmt) { // check if prepare failed
                send_json_response(FALSE, "Prepare failed: " . $conn->error);
                return false;
            }

            // No bind_param needed because there are no placeholders

            if ($stmt->execute()) {
                $result = $stmt->get_result(); // get the result set
                $registry = $result->fetch_all(MYSQLI_ASSOC); // fetch as associative array
                send_json_response(TRUE, "Registry fetched successfully", $registry);
            } else {
                send_json_response(FALSE, "Execute failed: " . $stmt->error);
            }

            $stmt->close();
            $conn->close();

        } catch (Exception $e) {
            send_json_response(FALSE, "Error fetching registry: " . $e->getMessage());
        }
}

?>