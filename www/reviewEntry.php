<?php
session_start();
if(@$_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}

?>
<html>
	<head><title> Review Input </title></head>
	<body>
<?php
//this page should display in tables what the user input 
//and allow user to submit or edit seed entry.
require_once("misc.inc");
function get_param($name) {
		// returns parameter passed by form, or empty string
		if(isset($_REQUEST[$name]))
			return $_REQUEST[$name];
		return "";
	}

//Validate the input; does it exist?


//Determine if the transaction is a duplicate record:
//Combination of Date, MemberID(Email), Common_Name, and Variety 
//Should be the same.

$cxn = mysqli_connect($host, $user, $pword, $database)
	   or die ("Couldn't connect to server." . mysqli_error($cxn));
$Common_Name = mysqli_real_escape_string($cxn,$_POST['Common_Name']);

$sqlcheck = "SELECT Common_Name, Date, MemberID, Variety
				FROM `seedcatalog`
				WHERE (Common_Name = '$Common_Name'
				AND Date = '$_POST[Date]'
				AND MemberID = '$_SESSION[logname]'
				AND Variety = '$_POST[Variety]')";


if($resultscheck = mysqli_query($cxn,$sqlcheck)) {

	if(mysqli_num_rows($resultscheck) == 0) {  //If there are no duplicates for that day, member, plant, go ahead
		echo "<table border=\"3\">";
				foreach ($_POST as $field => $value)
				{				
						if($value != NULL) {
							$value = STRIPSLASHES($value);	
							if($field == 'Latin_Name') {
								echo "<tr><td>$field</td><td><i>$value</i></td></tr>";
							}
							else{
								echo "<tr><td>$field</td><td><b>$value</b></td></tr>";
							}
						}	
				}
			echo "</table>";
		if(@$_POST[Year_Harvested] == Null) {  
		$cxn = mysqli_connect($host, $user, $pword, $database)
			or die ("Couldn't connect to server." . mysqli_error($cxn)); 
			//AND `Year_Harvested` IS NOT NULL
		$sql = "SELECT `Notes` 
				FROM `seedcatalog`
				WHERE (`Common_Name` = '$Common_Name'
				)";
		$result = mysqli_query($cxn,$sql);
		echo "<br><br><table border='3'>";
		echo "<tr><td><b>Notes about this $Common_Name plant<b></td></tr>";
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr><td>$row[Notes]</td></tr>";
		
		}
		echo "</table>";
		}
		echo "<p><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1)'>";
		echo "<form action='processEntry.php' method ='GET'>";
		if(@$_POST[Year_Harvested] != Null) {  		//User is Lending
			$query_string = 'Common_Name=' . urlencode(@$_POST[Common_Name]) 
				. '&Latin_Name=' . urlencode(@$_POST[Latin_Name]) 
				. '&Variety=' . urlencode(@$_POST[Variety]) 
				. '&Year_Harvested=' . urlencode(@$_POST[Year_Harvested])
				. '&Location=' . urlencode(@$_POST[Location])
				. '&Experience=' . urlencode(@$_POST[Experience])
				. '&Notes=' . urlencode(@$_POST[Notes])
				. '&MemberID=' . urlencode(@$_SESSION[logname])
				. '&Date=' . urlencode(@$_POST[Date]);
		}
		else {  									//User is Borrowing
			$query_string = 'Common_Name=' . urlencode(@$_POST[Common_Name]) 
				. '&Latin_Name=' . urlencode(@$_POST[Latin_Name]) 
				. '&Variety=' . urlencode(@$_POST[Variety]) 
				. '&Last_Seed=' . urlencode(@$_POST[Last_Seed])
				. '&MemberID=' . urlencode(@$_SESSION[logname])
				. '&Date=' . urlencode(@$_POST[Date]);
				}
		echo '<a href="processEntry.php?' . htmlentities($query_string) . '">Submit Entry</a></form>';
		//echo "<a href='processEntry.php'>Submit Entry</a></form>\n";
		}
	else {
	//$message = "No Duplicate entries.  Try changing the Plant name or variety.";
	include("NoDups.php");
	exit();
	}
}
?>