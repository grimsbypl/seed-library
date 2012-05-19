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
	$login_name = $_POST['Email'];
	$login_pass = $_POST['Password'];       

	$sql = sprintf(
		"SELECT id FROM users WHERE Email='%s' AND password=md5('%s')",
		mysql_real_escape_string($login_name), 
		mysql_real_escape_string($login_pass));  
	$result = mysqli_query($cxn, $sql) or die("Couldn't execute query: $sql" . mysqli_error($cxn));
	$num = mysqli_num_rows($result);
	if ($num > 0) {
		$_SESSION['auth'] = "yes";
		$_SESSION['logname'] = $login_name;

		$row = mysqli_fetch_assoc($result);
		$sql = sprintf("INSERT INTO logins (UserID,loginTime) VALUES ('%s',now())", mysql_real_escape_string($row['id']));
		$result = mysqli_query($cxn,$sql) or die("Can't execute insert query.");
		header("Location: index.php");
	} else {
		$message = "Login unsuccessful.<br/>";
	}
}
$title = "Login"
?>
<? require_once("header.inc"); ?>
	<div id="login" class="box">
		<h2>Member Login</h2>
		<form id="login_form" action='Login.php' method='POST'>
			<div class="field">
				<span class="label">Email</span>
				<input type='text' name='Email'/>
			</div>
			<div class="field">
				<span class="label">Password</span>
				<input type='password' name='Password'/>
			</div>
			<input type='submit' value='Login'/>
		</form>
		<div class="error_text"><?=$message?></div>
	</div>	
	<div id="login_register">
		<a href="register.php">Register</a>
	</div>
<? require_once("footer.inc") ?>	
