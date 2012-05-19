<?php
$user ="root";
$host ="localhost";
$port = "8889";
$pword = "root";
$database = "seeddb";

if (!isset($cxn)) {
	$cxn = mysqli_connect($host, $user, $pword, $database, $port);
	if (mysqli_connect_error()) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}
}
?>
