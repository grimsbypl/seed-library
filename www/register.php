<?php
error_reporting(E_ALL); // report all errors
session_start();
if(isset($_SESSION['auth']) && $_SESSION['auth'] == "yes")
{
  header("Location: index.php");
  exit();
}

include("misc.inc");

$message = "";
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	if ($_POST['Password'] != $_POST['ConfirmPassword']) {
		$message = "Password confirmation failed. Please type and re-type (confirm) Password.";
	}
	if(!preg_match("/^[A-Za-z' -]{1,50}$/",$_POST['FirstName'])) {
		$message = "Invalid First Name.";
	}
	if(!preg_match("/^[A-Za-z' -]{1,50}$/",$_POST['LastName'])) {
		$message = "Invalid Last Name.";
	}
	if(!filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
		$message = "Invalid Email.";
	}
	foreach(array('Email','FirstName','LastName','Password', 'ConfirmPassword') as $required_field) {
		$value = trim($_POST[$required_field]);
		if (empty($value)) { 
			$message = "$required_field is a required field.";
			break;
		}
	}

	if (empty($message)) {
		$sql = sprintf("SELECT Email FROM users WHERE Email = '%s'",
				mysql_real_escape_string($_POST['Email']));
		$result = mysqli_query($cxn, $sql)  or die("Couldn't execute select query." . mysqli_error($cxn));
		$num = mysqli_num_rows($result);
		if ($num > 0) {
			$message = $_POST['Email'] . " already used.  Select another email address to use.";
		} else {
			$sql = sprintf("INSERT INTO users (DateReg, NameFirst, NameLast, Email, Password) values(now(), '%s', '%s', '%s', md5('%s'))",
				mysql_real_escape_string($_POST['FirstName']),
				mysql_real_escape_string($_POST['LastName']),
				mysql_real_escape_string($_POST['Email']),
				mysql_real_escape_string($_POST['Password']));
			mysqli_query($cxn, $sql) or die("Couldn't execute insert query." . mysqli_error($cxn));

			$_SESSION['auth']="yes";
			$_SESSION['logname'] = $Email;
			header("Location: TransType.php?new=1");
		}
	}
}
$title = "Register";
?>
<? require_once("header.inc"); ?>
	<div id="register" class="box">
		<h2>Member Registration</h2>
		<form id="login_form" action='register.php' method='POST'>
			<div class="field">
				<span class="label">First Name</span>
				<input type='text' name='FirstName' value="<?=$_POST['FirstName']?>"/>
			</div>
			<div class="field">
				<span class="label">Last Name</span>
				<input type='text' name='LastName' value="<?=$_POST['LastName']?>"/>
			</div>
			<div class="field">
				<span class="label">Email Address</span>
				<input type='text' name='Email' value="<?=$_POST['Email']?>"/>
			</div>
			<div class="field">
				<span class="label">Password</span>
				<input type='password' name='Password'/>
			</div>
			<div class="field">
				<span class="label">Confirm Password</span>
				<input type='password' name='ConfirmPassword'/>
			</div>
			<input type='submit' value='Register'/>
		</form>
		<div class="error_text"><?=$message?></div>
	</div>
<? require_once("footer.inc") ?>
