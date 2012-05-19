<?php
/*   Script name: TransType.php
 * Ask the User if they are borrowing or lending seeds
*/
session_start();
if(@$_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}
?>
<html>
	<head><title> Transaction Type </title></head>
	<body>
<?php
  include("misc.inc");
//this page asks user if they are taking or borrowing seeds, 
//One button for 'Submit', also 'Edit your personal info' option in hyperlink


echo "<form action='processEntry.php' method ='GET'>";
	
switch ($_SESSION['do'])
{
  case "login":
	  echo "Welcome Back, Super Seed Saver!<br />";
	
	$cxn = mysqli_connect($host, $user, $pword, $database)
	   or die ("Couldn't connect to server.");

	$sql = "SELECT * From userseedreg
		WHERE Email = '$_SESSION[logname]'";
	$result = mysqli_query($cxn,$sql)
		  or die("Couldn't execute query." . mysqli_error($cxn));
	
	while ($row = mysqli_fetch_row($result)) {
	$query_string = 'NameFirst=' . urlencode(@$row[1]) 
		. '&NameLast=' . urlencode(@$row[2]) 
		. '&OrgName=' . urlencode(@$row[3]) 
		. '&Address=' . urlencode(@$row[4])
		. '&City=' . urlencode(@$row[5])
		. '&PhoneNum=' . urlencode(@$row[6])
		. '&Email=' . urlencode(@$row[7])
		. '&ContactYN=' . urlencode(@$row[8])
		. '&SeedExpLvl=' . urlencode(@$row[9])
		. '&GardenExpLvl=' . urlencode(@$row[10]);
		//. '&Volunteer=' . urlencode(@$row[11]);
	}
  break;
 
  case "new":
	  echo "Welcome New  Member!<br />";
	  $query_string = 'NameFirst=' . urlencode(@$_POST[NameFirst]) 
		. '&NameLast=' . urlencode(@$_POST[NameLast]) 
		. '&OrgName=' . urlencode(@$_POST[OrgName]) 
		. '&Address=' . urlencode(@$_POST[Address])
		. '&City=' . urlencode(@$_POST[City])
		. '&PhoneNum=' . urlencode(@$_POST[PhoneNum])
		. '&Email=' . urlencode(@$_POST[Email])
		. '&ContactYN=' . urlencode(@$_POST[ContactYN])
		. '&SeedExpLvl=' . urlencode(@$_POST[SeedExpLvl])
		. '&GardenExpLvl=' . urlencode(@$_POST[GardenExpLvl]);
		
  break;
	
  default:
	echo "The default case";
}	

			
echo '<a href="EditInfo.php?' . htmlentities($query_string) . '">
			Edit Member Info</a></form>';
			
echo '<br><br><a href="ViewAll.php">View All Transactions</a>';	

$cxn = mysqli_connect($host, $user, $pword, $database)
	   or die ("Couldn't connect to server.");

	$sql = "SELECT `admin` From userseedreg
		WHERE Email = '$_SESSION[logname]'";
	$result = mysqli_query($cxn,$sql)
		  or die("Couldn't execute query." . mysqli_error($cxn));
	$row = mysqli_fetch_row($result);

if($row[0] == 1){		
	echo '<br><br><a href="admin.php">For Administrator Eyes Only!</a> ';			
}

///////////////////////// 
 foreach ($_POST as $field => $value)
{
	echo "no basement $field" . " " . "is $value\n";
}
 
 echo "<p><div style='margin-left: .5in; margin-top: .5in'>
	<p style='font-weight: bold'>
	Are you Borrowing seeds or Lending seeds for this transaction?</p>
	</p>\n";
echo "<form action='seedcatalog.php' method ='POST'>
		\n";
  

echo "<input type='radio' name='transtype'
	     value='Borrowing' checked>Borrowing\n<br>";
echo "<input type='radio' name='transtype'
	     value='Lending'>Lending\n";	
//$Email = @$_POST[MemberID];
$Email = $_SESSION['logname'];


echo "<br><br><input type='submit' value='Submit'>
		</form>\n";
echo '<a href="mailto:Michael@BeetleMoose.com?subject=SeedDB">Email Webmaster</a> ';

 echo "<br><br> <a href = logout.php>Log out</a>";

?>
</body></html>