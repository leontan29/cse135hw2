<?php

require '../lib/helper.php';
require '../lib/rest.php';
return REST('info', $_SERVER['REQUEST_METHOD'], $_GET, $_POST);

?>
