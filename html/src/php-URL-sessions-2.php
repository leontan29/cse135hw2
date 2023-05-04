<?php
  ini_set('session.use_trans_sid',true);
  ini_set('session.use_cookies',false);
  ini_set('session.use_only_cookies',false);
  session_start();
  $name = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP Sessions</title>
</head>

<body>
  <h1>PHP Sessions Page 2</h1>

<?php
  echo SID;
  if ($name) {
    echo "<p><b>Name:</b> $name\n";
  } else {
    echo "<p><b>Name:</b> You do not have a name set</p>\n";
  }
?>
<br />
<br />
<a href="/php-cgiform.html">CGI Form</a><br />
<a href="/cgi-bin/php-URL-sessions-1.php">Session Page 1</a><br/>
<form style="margin-top:30px" action="/cgi-bin/php-destroy-URL-session.php" method="get">
  <button type="submit">Destroy Session</button>
</form>

</body>
</html>
