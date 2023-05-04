<?php
  session_start();
  session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP Session Destroyed</title>
</head>

<body>
  <h1>Sessions Destroyed</h1>
  <a href="/php-cgiform.html">Back to the CGI Form</a>
  <br />
  <a href="/cgi-bin/php-cookie-sessions-1.php">Back to Page 1</a>
  <br />
  <a href="/cgi-bin/php-cookie-sessions-2.php">Back to Page 2</a>
</body>
</html>
