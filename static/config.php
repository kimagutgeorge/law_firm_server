<?php
    /* CORS */
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Access-Control-Allow-Credentials: true");

    // Handle preflight OPTIONS request
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    /* HIDING ERRORS */
    // error_reporting(0);
    // ini_set('display_errors', 0);
    // ini_set('display_startup_errors', 0);

    /* universal variables */
    $action = $_POST['action'] ?? $_GET['action'] ?? "";
    $fetch_option = $_GET['fetch_option'] ?? null;

?>