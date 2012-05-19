<?php
/*   Script name: seedcatalogue.php
 * A form to input all the info about the seeds being taken/given
*/
if(!isset($message))
session_start();
if(@$_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}

?>
<html>
	<head><title> Seed Catalog </title></head>
	<body>
<?php

//this page should list the main catalogue items users must fill out for each seed type taken/lent. 
//One button for 'Reset', one button for 'Submit'
//If Submit is clicked and all not null forms aren't filled out, 
//send to a Page that says you missed form x.

echo "<form action='reviewEntry.php' method ='POST'>\n";
//echo "$_SESSION[logname]";

$today = date("Y-m-d");
$year = date("Y");

if(@$_POST[transtype] != Null) { 
	if(@$_POST[transtype] == "Borrowing")
	{
		require_once("borrowForm.php");
	}
	if(@$_POST[transtype] == "Lending")
	{
		require_once("lendForm.php");
	}
}
else {
	echo "Should just stay on this page";
}
	//
//determine if required inputs were entered. If not, send back to 
//appropriate form
/*if(@$_POST[Year_Harvested] == Null) { //this is Borrowing
	if(@$_POST[Common_Name] == NULL or @$_POST[Last_Seed] == NULL) {
		$message = "Please fill in all required boxes!";
		include("borrowForm.php");
		
		return "";
	}
}
else { //this is Lending
	if(@$_POST[Common_Name] == NULL or @$_POST[Location] == NULL or @$_POST[Experience] == NULL) {
		$message = "Please fill in all required boxes!";
		include("lendForm.php");
		return "";
	}
}
*/
/*function get_script_name() {
		// returns name of script file  
		return basename(__FILE__);
	}*/
?>
</body></html>