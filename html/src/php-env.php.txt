<?php
header("Cache-Control: no-cache");
header("Content-type: text/html");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Environment Variables</title>
  </head>
  <body>
  <h1 align='center'>Environment Varaibles</h1>
  <hr>
  <h2>Environ Vriables:</h2>
  <p>
    <ul>
<?php
	foreach (getenv() as $key => $value) {
	    echo "<li><strong>$key:</strong> $value</li>\n";
	}
?>
    </ul>
  </p>
  <h2>Server Variables:</h2>
  <p>
    <ul>
<?php
	foreach ($_SERVER as $key => $value) {
	    echo "<li><strong>$key:</strong> $value</li>\n";
	}
?>
    </ul>
  </p>
  </body>
</html>
