<?php
include 'inc/config.php';

if (!$identifier) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel='stylesheet' href='style.css'>
</head>

<body>
<?php
    setup_tab(basename(__FILE__));
?>

    <h2>Welcome, <?= $identifier ?><?= $is_admin ? ' (admin)' : '' ?>!</h2>

</body>
</html>
