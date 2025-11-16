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
    error_reporting(0);
    ini_set('display_errors', 0);
    ini_set('display_startup_errors', 0);

    /* universal variables */
    $action = $_POST['action'] ?? $_GET['action'] ?? "";
    $fetch_option = $_GET['fetch_option'] ?? null;

    // Define BASE_FOLDER as a constant at the top of your file or in a config file
    define('BASE_FOLDER', __DIR__ . '/storage');

    // Make sure the BASE_FOLDER exists when the script loads
    if (!file_exists(BASE_FOLDER)) {
        mkdir(BASE_FOLDER, 0755, true);
    }


?>