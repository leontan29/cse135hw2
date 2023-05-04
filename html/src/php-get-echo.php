<?php
header("Cache-Control: no-cache");
header("Content-type: text/html");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>GET Request Echo</title>
  </head>
  <body>
    <h1 align='center'>GET Request Echo</h1>
    <hr>
    <b>Query String:</b> <?php echo $_SERVER['QUERY_STRING']; ?> <br />

<?php
	foreach ($_GET as $key => $value) {
	    echo htmlspecialchars("$key = $value");
	    echo "<br/>\n";
	}
?>
  </body>
</html>
