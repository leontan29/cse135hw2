<?php
include '../config.php';

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
    $sql = "SELECT id, username, email, is_admin FROM users";
    $result = dbrun($sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    retok($users);
}

// Handle POST request
if ($method === 'POST') {
    // Get the JSON data from the request body
    $data = json_decode(file_get_contents("php://input"), true);

    // Extract the user data
    $username = $data['username'] ?? "";
    $email = $data['email'] ?? "";
    $password = $data['password'] ?? "";
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $is_admin = $data['is_admin'] ?? 0;

    // username or email must be set
    // password must be set
    if (!($username || $email) || !$password) {
        reterror(400, "400 Bad Request - missing fields");
    }

    // Insert the new user into the database
    $quoted_username = $new_username ? "'$new_username'" : "NULL";
    $quoted_email = $new_email ? "'$new_email'" : "NULL";
    $sql = "INSERT INTO users (username, email, password_hash, is_admin) ";
    $sql .= " VALUES ($quoted_username, $quoted_email, '$hashedPassword', '$is_admin')";
    if (!dbrun($sql)) {
        reterror(500, "500 Internal Server Error - cannot create user");
    }

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
    $sql = "DELETE FROM users WHERE id = '$id'";
    if (!dbrun($sql)) {
        reterror(500, "500 Internal Server Error - cannot delete user");
    }

    retok("deleted");
}

if ($method === 'PUT') {
    // Get the JSON data from the request body
    $body = file_get_contents("php://input");
    $data = json_decode($body, true);
    // Extract the user data
    $id = $data['id'] ?? 0;
    $username = $data['username'] ?? "";
    $email = $data['email'] ?? "";
    $is_admin = $data['is_admin'] ?? 0;

    // username or email must be set
    // id must be set
    if (!($username || $email) || !$id) {
	reterror(400, "400 Bad Request - missing fields");
    }

    // Insert the new user into the database
    $quoted_username = $username ? "'$username'" : "NULL";
    $quoted_email = $email ? "'$email'" : "NULL";
    $sql = "UPDATE users set username = $quoted_username, email = $quoted_email, is_admin = '$is_admin' ";
    $sql .= " where id = '$id'";
    if (!dbrun($sql)) {
	reterror(500, "500 Internal Server Error - cannot update user");
    }

    retok("updated");
}

reterror(405, '405 Method Not Allowed');
?>
