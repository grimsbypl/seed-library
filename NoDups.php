<?php
/*   Script name: NoDupsphp
 *   Tell the User they are trying to make a duplicate transaction
*/
//session_start();
if(@$_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}
?>
<html>
	<head><title> No Duplicate</title></head>
	<body>
<h2> No Duplicate Transactions Allowed. <br> Go Back and Change the Plant Name or Variety
</h2>
<?php

echo "<form action='EditInfo.php' method ='POST'>\n";

echo "<p><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1)'>";
?>