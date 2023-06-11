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
    SELECT BAR.timestamp, coalesce(FOO.cnt, 0) as cnt from 
      (select time_format(ctime, '%Y/%m/%d %H') as timestamp, count(*) as cnt
        from activity
	where error is not null and ctime >= date_sub(curdate(), interval 8 day)
	group by 1) FOO
    RIGHT JOIN
      (SELECT
          CONCAT(DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL (n1.num * 24 + n2.num) HOUR), '%Y/%m/%d'),
             ' ',
	     LPAD(n2.num, 2, '0')) as timestamp
        FROM
          (SELECT 0 AS num UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
           UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7) AS n1
          CROSS JOIN
          (SELECT 0 AS num UNION SELECT 1 UNION SELECT 2 UNION SELECT 3
             UNION SELECT 4 UNION SELECT 5 UNION SELECT 6 UNION SELECT 7
             UNION SELECT 8 UNION SELECT 9 UNION SELECT 10 UNION SELECT 11
             UNION SELECT 12 UNION SELECT 13 UNION SELECT 14 UNION SELECT 15
             UNION SELECT 16 UNION SELECT 17 UNION SELECT 18 UNION SELECT 19
             UNION SELECT 20 UNION SELECT 21 UNION SELECT 22 UNION SELECT 23) AS n2
          WHERE
            DATE_SUB(CURDATE(), INTERVAL (n1.num * 24 + n2.num) HOUR) >= DATE_SUB(CURDATE(), INTERVAL 8 DAY)) BAR
    USING (timestamp)
    where timestamp <= DATE_FORMAT(NOW(), '%Y/%m/%d %H')
    order by 1
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
