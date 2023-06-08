<?php
session_start();

$identifier = $_SESSION["identifier"] ?? "";
$is_admin = (!!$identifier) && !!($_SESSION["is_admin"] ?? false);
$conn = false;

define('TABNAME', array('Dashboard', 'Users', 'Logout'));
define('TABPATH', array('dashboard.php', 'users.php', 'logout.php'));


function setup_tab($curpath)
{
    global $is_admin;
    print "<!-- Tab Buttons -->\n";
    print "<div class='tab-container'>\n";
    for ($i = 0; $i < count(TABNAME); $i++) {
	$name = TABNAME[$i];
	if ($name === 'Users' && !$is_admin) {
	    // restricted to admin users only
	    continue;
	}
	$path = TABPATH[$i];
	$class = 'tab-button';
	if ($curpath == $path) {
	    $class .= ' active';
	}
	print "<a class='$class' href='$path'>$name</a>\n";
    }
    print "</div>\n";
}


function print_errmsg($msgarr)
{
    if ($msgarr) {
	print "<div class='error'>\n";
	print"   <ul>\n";
	foreach ($msgarr as $msg) {
	    print "        <li>$msg</li>\n";
	}
	print "    </ul>\n";
	print"</div>\n";
    }
}


?>
