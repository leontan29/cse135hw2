<?php
header("Cache-Control: no-cache");
header("Content-type: text/html");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hello, PHP!</title>
  </head>
  <body>
    <h1>Leon was here - Hello, PHP!</h1>
    <p>This page was generated with the PHP programming language.</p>
<?php
    $timestamp = date(DATE_RFC2822);
    echo "<p>Current time: $timestamp</p>";

    $address = $_SERVER['REMOTE_ADDR'];
    echo "<p>Your IP Address: $address</p>";
?>    
  </body>
</html>

