<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST["identifier"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username = '$identifier' OR email = '$identifier'";
    $result = dbrun($sql);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $storedHashedPassword = $row["password_hash"];
        if (password_verify($password, $storedHashedPassword)) {
            $_SESSION["username"] = $row["username"];
	    $_SESSION["is_admin"] = $row["is_admin"];
            header("location: dashboard.php");
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "Invalid username or email.";
    }
} else {
   session_destroy();
   session_start();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form action="login.php" method="POST">
        <input type="text" name="identifier" placeholder="Username or Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
