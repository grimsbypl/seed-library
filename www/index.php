<?
include("inc/session.php");

if (isset($_GET['new'])) {
	$message = "Welcome New  Member!<br />";
} else {
	$message = "Welcome Back, Super Seed Saver!<br />";
}

$page_title = "Transaction Type";
include("inc/header.php");
?>
<h2><?=$message?></h2>
<p>
What would you like to do:
<ul>
	<li><a href="borrowForm.php">Borrow Seeds</a></li>
	<li><a href="lendForm.php">Add seeds to the library</a></li>
	<li><a href="ViewAll.php">View Transactions</a></li>
</ul>
</p>
<?include("inc/footer.php");?>
