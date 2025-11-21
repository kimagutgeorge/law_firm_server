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
function fetch_registry($fetch_option = null) {
    global $conn;
    $BASE_URL = "/law_firm/static/storage"; // Web-accessible path, not filesystem path

    try {
        $sql = "SELECT * FROM registry ORDER BY id DESC";

        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            send_json_response(FALSE, "Prepare failed: " . $conn->error);
            return;
        }

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $registry = $result->fetch_all(MYSQLI_ASSOC);
            
            foreach ($registry as &$row) {
                $row['dropdown_is_hidden'] = true;
                
                if (isset($row['type']) && strtolower($row['type']) === "file") {
                    $filepath = BASE_FOLDER . '/' . $row['name'];
                    
                    if (file_exists($filepath)) {
                        $row['file_url'] = $BASE_URL . '/' . rawurlencode($row['name']);
                        $row['file_exists'] = true;
                        $row['file_extension'] = pathinfo($row['name'], PATHINFO_EXTENSION);
                    } else {
                        $row['file_url'] = null;
                        $row['file_exists'] = false;
                        $row['file_extension'] = null;
                    }
                } else {
                    $row['file_url'] = null;
                    $row['file_exists'] = false;
                    $row['file_extension'] = null;
                }
            }
            
            send_json_response(TRUE, "Registry fetched", $registry);
        } else {
            send_json_response(FALSE, "Execute failed: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        send_json_response(FALSE, "Error: " . $e->getMessage());
    }
}

//create registry
function create_registry($ref_no, $name, $description, $type, $image = null){
    global $conn;
    
    try {
        // Determine the final name (with extension for files)
        $final_name = $name;
        if (strtolower($type) === "file" && $image !== null && isset($image["name"])) {
            $file_extension = pathinfo($image["name"], PATHINFO_EXTENSION);
            if (!pathinfo($name, PATHINFO_EXTENSION) && $file_extension) {
                $final_name = $name . '.' . $file_extension;
            }
        }
        
        $sql = "INSERT INTO registry(ref_no, description, type, name) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            send_json_response(FALSE, "Prepare failed: " . $conn->error);
            return false;
        }
        $stmt->bind_param('ssss', $ref_no, $description, $type, $final_name);
        if ($stmt->execute()) {
            $record_id = $stmt->insert_id;
            
            if (strtolower($type) === "file") {
                if ($image !== null && isset($image["tmp_name"])) {
                    $storage_path = BASE_FOLDER . '/' . $final_name;
                    
                    if (move_uploaded_file($image["tmp_name"], $storage_path)) {
                        send_json_response(TRUE, "$type Created", ["path" => $storage_path]);
                    } else {
                        send_json_response(FALSE, "$type created but file upload failed");
                    }
                } else {
                    send_json_response(FALSE, "No file provided for upload");
                }
            } else {
                $storage_path = BASE_FOLDER . '/' . $final_name;
                
                if (!file_exists($storage_path)) {
                    if (mkdir($storage_path, 0755, true)) {
                        send_json_response(TRUE, "$type Created", []);
                    } else {
                        send_json_response(FALSE, "$type created but folder creation failed");
                    }
                } else {
                    send_json_response(TRUE, "$type Created", []);
                }
            }
        } else {
            send_json_response(FALSE, "Execute failed: " . $stmt->error);
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        send_json_response(FALSE, "Error creating registry: " . $e->getMessage());
    }
}

?>