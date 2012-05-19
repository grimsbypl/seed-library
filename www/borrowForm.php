<?php
session_start();
if($_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}

$title = "Borrow Seeds";
include("header.inc");

$today = date("Y-m-d");
if (isset($message))
{
  echo "<span style='color: red;'>$message</span>";
}
echo "<form action='reviewEntry.php' method ='POST'>\n";
echo "<p><p style='font-weight: bold'>
	Please fill in the information for the seeds you are borrowing.  An asterisk * indicates required information</p>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Today's Date </td>
	<td><input type='text' name='Date' 
	value='$today' size='10' 
	maxlength='10'>
	</td></tr></p>";	

echo "<tr>
	<td style='text-align: right;
		font-weight: bold'>*Common Name</td>
	<td><input type='text' name='Common_Name' 
	value='' size='65' 
	maxlength='65'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Latin Name </td>
	<td><input type='text' name='Latin_Name' 
	value='' size='65' 
	maxlength='65'>
	</td></tr></p>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Variety </td>
	<td><input type='text' name='Variety' 
	value='' size='65' 
	maxlength='65'>
	</td></tr></p>";


echo "*Are you taking the last of these particular seeds? (We're just asking for bookeeping :)<br>";
/*echo"<select name='Last Seed'>\n
	<option value='No' selected='selected'>No, there are more left</option>
	<option value='Yes'>Yes, that is the last one</option>
	</select><br><br>";
*/
echo "<input type='radio' name='Last Seed'
		value='No' checked>No, there are more seeds left\n<br>";
echo "<input type='radio' name='Last Seed'
	     value='Yes'>Yes, that is the last seed\n";	
echo "<p><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1);'>
	\n";
echo "<input type='submit' value='Review Entry'>
	</form>\n";
?>
<?include("footer.inc");?>
