<?php
include 'inc/config.php';
include 'inc/db.php';

// Check if the user is logged in and is an admin
if (!$is_admin) {
    header("location: login.php");
    exit;
}

$form_errmsg = [];
$new_username = "";
$new_email = "";
$new_password = "";
$new_is_admin = 0;
if ($_POST['submit'] ?? false) {
    $new_username = $_POST['new_username'] ?? null;
    $new_email = $_POST['new_email'] ?? null;
    $new_password = $_POST['new_password'] ?? null;
    $new_is_admin = ($_POST['new_is_admin'] ?? "") == 'on' ? 1 : 0;
    if (!$new_username && !$new_email) {
       $form_errmsg[] = "Please fill in Username and/or Email.";
    }
    if (!$new_password) {
       $form_errmsg[] = "Please fill in Password.";
    }
    if (!$form_errmsg) {
        $row = [];
	if ($new_username) {
           $row['username'] = $new_username;
	}
	if ($new_email) {
	   $row['email'] = $new_email;
	}
	$row['is_admin'] = $new_is_admin;
	$row['password_hash'] = password_hash($new_password, PASSWORD_DEFAULT);
	db_insert('users', $row);
	
        // inserted. now clear the values in the form.
        $new_username = "";
        $new_email = "";
        $new_password = "";
        $new_is_admin = 0;
    }
}


?>


<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
    <link rel='stylesheet' href='style.css'>
    <!-- for grid -->
    <script src="https://cdn.zinggrid.com/zinggrid.min.js" defer></script>
</head>
<body>

<?php
    setup_tab(basename(__FILE__));
?>

    <h2>Create User</h2>
<?php
    print_errmsg($form_errmsg);
?>
    <form id="createUserForm" method='post' action=''>
        <input type="text" name="new_username" placeholder="Username" value='<?= $new_username ?>'>
	and/or 
        <input type="text" name="new_email" placeholder="Email" value='<?= $new_email ?>'>
        <br>
        <input type="text" name="new_password" placeholder="Password" required value='<?= $new_password ?>'>
        <br>
        <label for="new_is_admin">Is Admin:</label>
        <input type="checkbox" id="new_is_admin" name="new_is_admin" <?= ($new_is_admin ? "checked": "") ?>>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <h2>User List</h2>
    <zing-grid editor-controls="remover editor"
    src = '/api/user'>
    </zing-grid>
</body>
</html>
