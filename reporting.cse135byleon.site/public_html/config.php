<?php
session_start();

$username = $_SESSION["username"] ?? "";
$is_admin = (!!$username) && !!($_SESSION["is_admin"] ?? false);
$conn = false;

function dbconn()
{
    global $conn;
    if (!$conn) {
        $host = "localhost";
        $user = "leon";
        $password = "gugudog";
        $database = "myapp";

        $conn = mysqli_connect($host, $user, $password, $database);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
    return $conn;
}


function dbrun($sql) {
    $conn = dbconn();
    $result = mysqli_query($conn, $sql);
    if (!$result) {
       die("SQL failed");
    }
    return $result;
}


?>
