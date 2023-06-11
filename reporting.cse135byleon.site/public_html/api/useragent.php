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
    // Return tuples like this: ["FLAGS", count].
    // The FLAGS indicates browser types that were present in the user-agent.
    // The count shows how many visits were done with this browser type.
    //
    // The FLAGS should be parsed like this:
    // If E in flag, then it is Edge.
    // Else if O in flag, then it is Opera.
    // Else if F in flag, then it is Firefox.
    // Else if CS in flag, then it is Chrome.
    // Else if S in flag, then it is Safari.
    // Else it is others.
    $conn = db_connect();
    $stmt = $conn->prepare("
      select ua, count(*) as cnt from (
          select concat(
             IF(user_agent like '%Firefox%', 'F', ''),
             IF(user_agent like '%Edg%', 'E', ''),
	     IF(user_agent like '%Chrome/%', 'C', ''),
	     IF(user_agent like '%Safari%', 'S', ''),
	     IF(user_agent like '%OPR%' or user_agent like '%Opera%', 'O', '')) as ua
	   from visit) foo
        group by ua
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
