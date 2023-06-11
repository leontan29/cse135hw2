<?php
include '../inc/config.php';
include '../inc/db.php';

// Set the appropriate response headers
header("Content-Type: application/json");

function reterror($code, $msg) {
    http_response_code($code);
    $response = [
            'status' => 'error',
            'message' => $msg
        ];
    echo json_encode($response);
    exit;
}

function retok($payload) {
    http_response_code(200);
    echo json_encode($payload);
    exit;
}


// Check the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle GET request
if ($method === 'GET') {
    // Retrieve all users from the database
    $conn = db_connect();
    $stmt = $conn->prepare("
      select time_format(ctime, '%H') hr, count(*) cnt from visit group by 1;
	");
    $stmt->execute();
    $result = $stmt->get_result();
    $output = [];
    while ($row = $result->fetch_assoc()) {
        $output[] = $row;
    }
    $stmt->close();
    retok($output);
}


error_log("method not allowed: $method");
reterror(405, '405 Method Not Allowed');
?>
