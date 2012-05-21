<?
$page_no_auth = 1;
include('inc/session.php');
if($is_auth) {
	header("Location: index.php");
	exit();
}
include("inc/db.php");

$message = "";
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	$login_name = $_POST['Email'];
	$login_pass = $_POST['Password'];

	$sql = sprintf(
		"SELECT id, admin FROM users WHERE Email='%s' AND password=md5('%s')",
		mysql_real_escape_string($login_name),
		mysql_real_escape_string($login_pass));
	$result = mysqli_query($cxn, $sql) or die("Couldn't execute query: $sql" . mysqli_error($cxn));
	$num = mysqli_num_rows($result);
	if ($num > 0) {
		$row = mysqli_fetch_assoc($result);

		$_SESSION['auth'] = 1;
		$_SESSION['logname'] = $login_name;
		$_SESSION['logid'] = $row['id'];
		$_SESSION['admin'] = $row['admin'];

		$sql = sprintf("INSERT INTO logins (UserID,loginTime) VALUES ('%s',now())", mysql_real_escape_string($row['id']));
		$result = mysqli_query($cxn,$sql) or die("Can't execute insert query.");
		header("Location: index.php");
	} else {
		$message = "Login unsuccessful.<br/>";
	}
}

$page_title = "Login";
require_once("inc/header.php");
?>
	<div id="login_left">
		<div id="login" class="box">
			<h2>Member Login</h2>
			<form id="login_form" action='login.php' method='POST'>
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
	</div>
	<div id="login_right">
		Welome to the Grimsby Grows.
	</div>
<? require_once("inc/footer.php") ?>
