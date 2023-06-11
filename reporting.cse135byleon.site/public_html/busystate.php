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
    <title>System Load Report</title>
    <link rel='stylesheet' href='style.css'>
</head>

<body>
<?php
    setup_tab(basename(__FILE__));
?>

  <h2>When is the best period to perform maintenance on the website?</h2>

  <p>From the chart below, it appears that we can shutdown the
    machines for maintenance between midnight and 4am with minimal
    impact on our users.</p>

  <img src='hourly-users.png'></img>
  
</body>
