<?php
include 'config.php';

if (!$username) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
    <a href='users.php'>User Management</a>
    <a href="logout.php">Logout</a>
</body>
</html>
