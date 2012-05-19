<?php
/*   Script name: ViewAll.php
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
	<head><title> View Transactions </title></head>
	<body>
<?php
  include("misc.inc");
  
	$cxn = mysqli_connect($host, $user, $pword, $database, $port)
	   or die ("Couldn't connect to server." . mysqli_error($cxn));

	$sql = "SELECT  *
		FROM seedcatalog 
		WHERE (MemberID = '$_SESSION[logname]')			
		ORDER BY Date DESC";       //and Year_Harvested = 'NULL'
	$result = mysqli_query($cxn,$sql)
		  or die("Couldn't execute query." . mysqli_error($cxn));
	$num_rows = mysqli_num_rows ( $result );
		
	echo "Hello, $_SESSION[logname]. Here are all the seeds you borrowed. ";// since last year";
	echo "<br> Would you like to ";
	echo "<a href='TransType.php'>make another transaction?</a><br><br>";
	
	echo "<table border='3'>";
	echo "<tr><td><b>Date Borrowed</b></td><td><b>Plant Name</b></td><td><b>Scientific Name</b></td>"
			. "<td><b>Variety</b></td></tr>";
					
	while($row = mysqli_fetch_array($result)) { 
		extract($row);	
		if(@$Year_Harvested == NULL){   //only list Borrowed Seeds								
			$Common_Name = stripslashes($Common_Name);
			$Variety = stripslashes($Variety);
					
			echo "<tr><td>$Date</td><td>$Common_Name</td>"
					. "<td><i>$Latin_Name</i></td><td>$Variety</td></tr>";
			
		}					

	}
	echo "</table><br>";		
	



		  
  ?>
  
