<?
$user ="root";
$pword = "seeds";
$host ="localhost";
$port = "3306";
$database = "seeddb";

if (!isset($cxn)) {
	$cxn = mysqli_connect($host, $user, $pword, $database, $port);
	if (mysqli_connect_error()) {
		die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
	}
}
?>
