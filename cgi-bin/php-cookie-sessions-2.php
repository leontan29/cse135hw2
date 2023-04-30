<?php
  session_start();
  $name = $_SESSION['username'];
  if (!$name) {
    $name = $_POST['username'];
    $_SESSION['username'] = $name;
  }
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP Sessions</title>
</head>

<body>
  <h1>PHP Sessions Page 2</h1>

<?php
  if ($name) {
    echo "<p><b>Name:</b> $name\n";
  } else {
    echo "<p><b>Name:</b> You do not have a name set</p>\n";
  }
?>
<br />
<br />
<a href="/php-cgiform.html">CGI Form</a><br />
<a href="/cgi-bin/php-cookie-sessions-1.php">Session Page 1</a><br/>
<form style="margin-top:30px" action="/cgi-bin/php-destroy-cookie-session.php" method="get">
  <button type="submit">Destroy Session</button>
</form>

</body>
</html>
