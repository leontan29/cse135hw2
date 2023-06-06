<?php
include 'config.php';

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
    $new_username = $_POST['new_username'] ?? "";
    $new_email = $_POST['new_email'] ?? "";
    $new_password = $_POST['new_password'] ?? "";
    $new_is_admin = ($_POST['new_is_admin'] ?? "") == 'on' ? 1 : 0;
    if (!$new_username && !$new_email) {
       $form_errmsg[] = "Please fill in Username and/or Email.";
    }
    if (!$new_password) {
       $form_errmsg[] = "Please fill in Password.";
    }
    if (!$form_errmsg) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $value_username = $new_username ? "'$new_username'" : "NULL";
        $value_email = $new_email ? "'$new_email'" : "NULL";
        $sql = "insert into users(username, email, password_hash, is_admin) ";
        $sql .= " values($value_username, $value_email, '$hashed_password', '$new_is_admin')";
        dbrun($sql);

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
    <script src="https://cdn.zinggrid.com/zinggrid.min.js" defer></script>
    <script>
        /*
        // Function to fetch users from the API
        function getUsers() {
              fetch('/api/user')
                      .then(response => response.text())
                      .then(text => 
            document.querySelector('zing-grid').setAttribute('data', text));
        }
        // Function to delete a user via the API
        function deleteUser(id) {
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/api/user/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        // Handle success
                        console.log(response);
                        // Refresh the user list
                        getUsers();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.log(error);
                    }
                });
            }
        }
        // Function to initialize the page
        function initializePage() {
            // Fetch and display users
            getUsers();
        }
        */
    </script>
</head>
<body>
    <h1>Users</h1>

    <h2>Create User</h2>
<?php
if ($form_errmsg) {
   echo '<div style="background-color: #ffcccc; color: #ff0000; padding: 10px; margin-bottom: 10px;">', "\n";
   echo '    <ul style="list-style: none; margin: 0; padding: 0;">', "\n";
   foreach ($form_errmsg as $msg) {
       echo '        <li style="margin-bottom: 5px;">', $msg, '</li>', "\n";
   }
   echo '    </ul>', "\n";
   echo '</div>', "\n";
}
?>
    <form id="createUserForm" method='post' action=''>
        <input type="text" name="new_username" placeholder="Username" value='<?=$new_username?>'>
	and/or 
        <input type="text" name="new_email" placeholder="Email" value='<?=$new_email?>'>
        <br>
        <input type="text" name="new_password" placeholder="Password" required value='<?=$new_password?>'>
        <br>
        <label for="new_is_admin">Is Admin:</label>
        <input type="checkbox" id="new_is_admin" name="new_is_admin" <?=($new_is_admin ? "checked": "")?>>
        <br>
        <input type="submit" name="submit" value="Submit">
    </form>

    <h2>User List</h2>
    <zing-grid caption="User List" editor-controls="remover"
    src = '/api/user'>
    </zing-grid>
</body>
</html>
