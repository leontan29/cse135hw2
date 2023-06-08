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

if (!$is_admin) {
    reterror(403, "403 Forbidden");
}

// Check the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle GET request
if ($method === 'GET') {
    // Retrieve all users from the database
    $users = db_load('users');

    // do not show the password_hash column
    foreach ($users as &$u) {
        unset($u['password_hash']);
    }
    retok($users);
}

// Handle POST request
if ($method === 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract the user data
    $username = $data['username'] ?? null;
    $email = $data['email'] ?? null;
    $password = $data['password'] ?? null;
    $is_admin = $data['is_admin'] ?? 0;

    // username or email must be set
    // password must be set
    if (!($username || $email) || !$password) {
        reterror(400, "400 Bad Request - missing fields");
    }

    $row = [];
    $row['username'] = $username;
    $row['email'] = $email;
    $row['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
    $row['is_admin'] = $is_admin;

    // Insert the new user into the database
    db_insert('users', $row);
    retok("created");
}

// Handle DELETE request
if ($method === 'DELETE') {
    // Get the user ID from the query parameters
    $id = $_GET['id'];
    if (!$id) {
	reterror(400, "400 Bad Request - missing id");
    }

    // Delete the user from the database
    db_delete('users', $id);
    retok("deleted");
}

if ($method === 'PUT') {
    $id= $_GET['id'] ?? null;
    // id must be set
    if (!$id) {
	reterror(400, "400 Bad Request - missing ID");
    }

    // Get the JSON data from the request body
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    // Extract the user data
    $username = $data['username'] ?? null;
    $email = $data['email'] ?? null;
    $is_admin = $data['is_admin'] ?? 0;

    // username or email must be set
    if (!($username || $email)) {
	reterror(400, "400 Bad Request - missing fields");
    }

    $row = [];
    $row['username'] = $username ? $username : null;
    $row['email'] = $email ? $email : null;
    $row['is_admin'] = $is_admin ? $is_admin : 0;
    
    // Update the row
    db_update('users', $id, $row);
    retok("updated");
}

if ($method === 'PATCH') {
    error_log('in PATCH');
    $id= $_GET['id'] ?? null;
    // id must be set
    if (!$id) {
	reterror(400, "400 Bad Request - missing ID");
    }
    $row = db_find('users', $id);
    if (!$row) {
        retok("updated");
    }

    // Get the JSON data from the request body
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);

    if (isset($data['username'])) {
       $v = $data['username'];
       $v = $v ? $v : null;
       $row['username'] = $v;
    }
    if (isset($data['email'])) {
       $v = $data['email'];
       $v = $v ? $v : null;
       $row['email'] = $v;
    }
    if (isset($data['is_admin'])) {
       $row['is_admin'] = $data['is_admin'] ? 1 : 0;
    }
    if (!$row['username'] && !$row['email']) {
       reterr(400, "400 Bad Request - cannot set both username and email to NULL");
    }
    unset($row['id']);
    db_update('users', $id, $row);
    retok("updated");
}


error_log("method not allowed: $method");
reterror(405, '405 Method Not Allowed');
?>
