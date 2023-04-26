<?php
header("Cache-Control: no-cache");
header("Content-type: application/json");

$timestamp = date(DATE_RFC2822);
$address = $_SERVER['REMOTE_ADDR'];

$message = ['title' => 'Hello, PHP!',
	 'heading' => 'Hello, PHP!',
	 'message' => 'This page was generated with the PHP programming language',
	 'time' => $timestamp,
	 'IP' => $address];

$json = json_encode($message);
echo "$json\n";

?>
