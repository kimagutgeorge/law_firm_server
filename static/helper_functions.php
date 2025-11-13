<?php
    function send_json_response($success, $message, $data = []) {
    ob_clean(); // Clear any accidental output
    header('Content-Type: application/json');
    echo json_encode([
        'success' => $success,
        'message' => $message,
        'data' => $data
    ]);
    exit;
}

function js_log($msg) {
    echo "<script>console.log(" . json_encode($msg) . ");</script>";
}

?>