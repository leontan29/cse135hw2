<?php
include '../config.php';

// Set the appropriate response headers
header("Content-Type: application/json");

if (!$is_admin) {
    http_response_code(401);
    $response = [
            'status' => 'error',
            'message' => 'Unauthorized'
        ];
    echo json_encode($response);
    exit;
}

// Check the HTTP request method
$method = $_SERVER['REQUEST_METHOD'];

// Handle GET request
if ($method === 'GET') {
    // Retrieve all users from the database
    $sql = "SELECT id, username, email, is_admin FROM users";
    $result = dbrun($sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Return the users as JSON response
    echo json_encode($users);
    return;
}

// Handle POST request
if ($method === 'POST') {
    file_put_contents('php://stderr', print_r(var_export($_POST, true), true));
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
        $response = [
            'status' => 'error',
            'message' => 'Required fields are missing.'
        ];
        http_response_code(400);
        echo json_encode($response);
	return;       
    }

    // Insert the new user into the database
    $value_username = $new_username ? "'$new_username'" : "NULL";
    $value_email = $new_email ? "'$new_email'" : "NULL";
    $sql = "INSERT INTO users (username, email, password_hash, is_admin) ";
    $sql .= " VALUES ($value_username, $value_email, '$hashedPassword', '$is_admin')";
    if (dbrun($sql)) {
        $response = [
            'status' => 'success',
            'message' => 'User created successfully.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error creating user.'
        ];
    }
    echo json_encode($response);
    return;
}

// Handle DELETE request
if ($method === 'DELETE') {
    // Get the user ID from the query parameters
    $userId = $_GET['id'];

    // Delete the user from the database
    $sql = "DELETE FROM users WHERE id = $userId";
    if (dbrun($sql)) {
        $response = [
            'status' => 'success',
            'message' => 'User deleted successfully.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error deleting user.'
        ];
    }
    echo json_encode($response);
    return;
}
?>
