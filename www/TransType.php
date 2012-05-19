<?
session_start();
if($_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}

if (isset($_GET['new'])) {
	$message = "Welcome New  Member!<br />";
} else {
	$message = "Welcome Back, Super Seed Saver!<br />";
}

$title = "Transaction Type";
include("header.inc");
?>
<h2><?=$message?></h2>
<p>
What would you like to do:
<ul>
	<li><a href="borrowForm.php">Borrow Seeds</a></li>
	<li><a href="lendForm.php">Add seeds to the library Seeds</a></li>
	<li><a href="ViewAll.php">View Transcations</a></li>
</ul>
</p>
<?include("footer.inc");?>
