<?php
/*   Script name: processEdits.php
 * 	 Put the edits into the userseedreg table
*/
session_start();
if(@$_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}
//should a header to TransType.php go here?
//Will the below code get executed if it does?
?>
<html>
	<head><title> Process Edits </title></head>
	<body>
<?php 
require_once("misc.inc");
$cxn = mysqli_connect($host, $user, $pword, $database, $port)
   or die ("Couldn't connect to server." . mysqli_error($cxn));>

/*  Check that First, Last Name, and Email are matches  
$sql1= "SELECT NameFirst, NameLast, Email 
		FROM userseedreg
		WHERE NameFirst IS \'$_POST NOT DONE HERE
   */
   
if($_POST['Password']!=$_POST['ConfirmPassword']) {
	include("NoPass.php");
	exit();
	}
foreach ($_POST as $field => $value) {
			if($field == "Password") {
				if($value == "") {
					include("NoPass.php");
					exit();
					}
				else $value = md5($value);
				}
			if($value != "" and $field != "ConfirmPassword"){
				if($field != "Volunteer"){
				@$updatestring .= $field . " = " . "'" . $value . "'" . ", ";
				}
				else
				$updatestring .= $field . " = " . "'" . $value . "'";
			}
		
	}

$sql = "UPDATE userseedreg SET ";
$sql .= $updatestring;
$sql .= " WHERE " . "userseedreg.Email" . " = " . "'" . $_SESSION['logname'] . "'";


$cxn = mysqli_connect($host, $user, $pword, $database, $port)
	   or die ("Couldn't connect to server." . mysqli_error($cxn));
//echo "$sql<br>";
//echo "($host, $user, $pword, $database)\n";
$result = mysqli_query($cxn,$sql)
		or die("Couldn't execute insert query." . mysqli_error($cxn));
echo "Your membership information has been updated. <br>Go to the ";
echo "<a href='TransType.php'>Transaction Page</a>"; 
/*
	$_POST[NameFirst]
	$_POST[NameLast] 
	$_POST[OrgName] 
	$_POST[Address]
	$_POST[City] 
	$_POST[PhoneNum]
	$_POST[Email]
	$_POST[fpassword] 
	$_POST[ContactYN]
	$_POST[SeedExpLvl]
	$_POST[GardenExpLvl]
	$_POST[Volunteer]
*/
?>
</body></html>
