<?php
session_start();
if(@$_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}

?>
<html>
	<head><title> Process Transaction </title></head>
	<body>
<?php
require_once("misc.inc");
//this page should process the transaction.
//Validate the form inputs
//And put into the Database
 

foreach ($_GET as $field => $value) {
	$fields[]=$field;
			$value = (string) $value;
			$values[] = mysqli_real_escape_string($cxn,$value);  
			$$field = $value;
	}
$fields_str = implode(",",$fields);
$values_str = implode('","',$values);
$sql = "INSERT INTO seedcatalog ";
$sql .= "(".$fields_str.")";

$sql .= " VALUES ";
$sql .= "(".'"'.$values_str.'"'.")".";";

//$cxn = mysqli_connect($host, $user, $pword, $database, $port)
//	   or die ("Couldn't connect to server." . mysqli_error($cxn));
//echo "$sql<br>";
//echo "($host, $user, $pword, $database)\n";
$result = mysqli_query($cxn,$sql)
		or die("Couldn't execute insert query." . mysqli_error($cxn));

if($result != NULL) {
	echo "\n Your transaction has been processed.  Thanks for using the Seed Library. ";
	echo "<br> Would you like to ";
	echo "<a href='TransType.php'>make another transaction?</a>\n";
		}

	 echo "<br><br> <a href = logout.php>Log out</a>";
?>
