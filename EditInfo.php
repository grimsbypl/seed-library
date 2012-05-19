<?php
/*   Script name: EditInfo.php
 * User can Change Information
*/
session_start();
if(@$_SESSION['auth'] != "yes")
{
  header("Location: Login.php");
  exit();
}
?>
<html>
	<head><title> Edit User Info</title></head>
	<body>
<h1> Edit User Information</h1>
<h2> First, Last Name and Email are required. Change anything else.</h2>
<h2> Be Sure to Choose a *NEW* Password</h2>

<?php

echo "<form action='processEdits.php' method ='POST'>\n";
$today = date("Y-m-d");
$Email = $_GET['Email'];  //does this need to be here???
echo "<tr>
	<td style='text-align: right;
		font-weight: bold'>*First Name</td>
	<td><input type='text' name='NameFirst' 
	value=\"$_GET[NameFirst]\" size='20' 
	maxlength='20'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>*Last Name</td>
	<td><input type='text' name='NameLast' 
	value=\"$_GET[NameLast]\" size='25' 
	maxlength='25'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Organization Affiliation</td>
	<td><input type='text' name='OrgName' 
	value=\"$_GET[OrgName]\" size='45' 
	maxlength='45'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Address</td>
	<td><input type='text' name='Address' 
	value=\"$_GET[Address]\" size='35' 
	maxlength='35'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>City</td>
	<td><input type='text' name='City' 
	value=\"$_GET[City]\" size='25' 
	maxlength='25'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Phone Number</td>
	<td><input type='text' name='PhoneNum' 
	value=\"$_GET[PhoneNum]\" size='20' 
	maxlength='20'>
	</td></tr>";

echo "<p><h4>*Email 
	<input type='text' name='Email' 
	value=\"$_GET[Email]\" size='35' 
	maxlength='35'>
	</h4>";
echo "<p>
	<h4>*Choose a NEW Password
	<input type='password' name='Password' 
	value='' size='20' 
	maxlength='20'></h4>
	</p>";
echo "<p>
	<h4>*Confirm Password
	<input type='password' name='ConfirmPassword' 
	value='' size='20' 
	maxlength='20'></h4>
	</p>";
echo " <p>*What's your Seed Saving comfort level?";
echo "<input type='radio' name='SeedExpLvl'
	     value='Easy' checked>Easy";
echo "<input type='radio' name='SeedExpLvl'
	     value='Advanced'>Advanced";
/*
echo "<select name='SeedExpLvl'>\n
	 <option value='Easy' selected='selected'>Easy</option>
	 <option value='Advanced'>Advanced</option>
	 </select><br><br>";
*/


echo " <p>*What's your Gardening comfort level?   ";
echo "<input type='radio' name='GardenExpLvl'
	     value='Easy' checked>Easy";
echo "<input type='radio' name='GardenExpLvl'
	     value='Advanced'>Advanced";

/*
echo "<select name='GardenExpLvl'>\n
	 <option value='Easy' selected='selected'>Easy</option>
	 <option value='Advanced'>Advanced</option>
	 </select><br><br>";
*/

echo "<p> Would you like to be contacted about seed swaps, classes, etc.?";
 
echo "<input type='radio' name='ContactYN'
	     value='Yes' checked>Yes";
echo "<input type='radio' name='ContactYN'
	     value='No'>No";
		 
echo "<p> Please highlight the ways in which you would be willing to 
	volunteer with B.A.S.I.L. Seed Library.<br>
	(Press Ctrl and click for multiple selections)";
echo "<p><select size = '5' name = 'Volunteer' multiple>
		<option selected>None
		<option>Library
		<option>Data Entry
		<option>Teach
		<option>Mentor
		<option>Fundraise
		<option>Outreach
		<option>Other </select>";

echo "<br><br><input type='submit' value='Submit'>
		</form>\n";		
?>
</body></html>
