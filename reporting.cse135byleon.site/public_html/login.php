<?php
include 'inc/config.php';
include 'inc/db.php';

$form_errmsg = [];
$identifier = $_POST["identifier"] ?? "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST["password"];

    $conn = db_connect();
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param('ss', $identifier, $identifier);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    if ($row) {
        $storedHashedPassword = $row["password_hash"];
        if (password_verify($password, $storedHashedPassword)) {
            $_SESSION["identifier"] = $identifier;
	    $_SESSION["is_admin"] = $row["is_admin"];
            header("location: dashboard.php");
	    exit;
        } else {
	    $form_errmsg[] = "Invalid password.";
        }
    } else {
        $form_errmsg[] = "Invalid username or email.";
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
    <link rel='stylesheet' href='style.css'>
</head>
<body>
    <h2>Login</h2>
<?php
if ($form_errmsg) {
   echo "<div class='error'>\n";
   echo "   <ul>\n";
   foreach ($form_errmsg as $msg) {
       echo "        <li>$msg</li>\n";
   }
   echo "    </ul>\n";
   echo "</div>\n";
}
?>
    <form action="login.php" method="POST">
        <input type="text" name="identifier" placeholder="Username or Email" required value='<?= $identifier ?>'><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
