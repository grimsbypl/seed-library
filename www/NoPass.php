<?php
/*   Script name: NoPass.php
 * Tell the user to go back to  Edit Info and choose a new password
*/
//session_start();
if(@$_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}
?>
<html>
	<head><title> No Password Supplied</title></head>
	<body>
<h1> Danger, danger Will Robinson!<br> No password was supplied! or password confirmation failed! <br>Retreat back to previous page<h1>
<?php

echo "<form action='EditInfo.php' method ='POST'>\n";

echo "<p><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1)'>";
?>