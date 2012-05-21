<?
session_start();
$is_auth = isset($_SESSION['auth']) && $_SESSION['auth'];
$is_admin = isset($_SESSION['admin']) && $_SESSION['admin'];
if (!isset($page_no_auth) && !$is_auth) {
	header("Location: login.php");
	exit();
}
?>
