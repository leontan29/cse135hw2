<?php
header("Cache-Control: no-cache");
header("Content-type: text/html");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>General Request Echo</title>
  </head>
  <body>
    <h1 align='center'>General Request Echo</h1>
    <hr>

    <p><b>HTTP Protocol:</b> <?php echo $_SERVER['SERVER_PROTOCOL']; ?></p>
    <p><b>HTTP Method:</b> <?php echo $_SERVER['REQUEST_METHOD']; ?></p>

    <p><b>Query:</b></p>
    <ul>
<?php
	foreach ($_GET as $key => $value) {
	    echo "<li>";
	    echo htmlspecialchars("$key = $value");
	    echo "</li>\n";
	}
?>
    </ul>

    <p><b>Message Body:</b></p>
    <ul>
<?php
	foreach ($_POST as $key => $value) {
	    echo "<li>";
	    echo htmlspecialchars("$key = $value");
	    echo "</li>\n";
	}
?>
    </ul>
  </body>
</html>
