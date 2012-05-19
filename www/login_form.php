
<html>
	<head><title> Registration Page </title></head>
	<body>
<?php
/*   Script name: login_form.php
 
*/

//this page is a registration page for Users
//The information will be checked and put into DB after Submit is clicked
if(isset($emess)) {
	echo "$emess";
	}
require_once("WelcomeMessage.inc");

echo "<p><h2>Member Login</h2></p>";
/* form for Member Login */
echo "<form action='Login.php' method ='POST'>\n";
if (isset($message))
{
  echo"<span style ='color: red'>$message </span>";
}
echo "<p >Email <input type='text' name='Email'
             size='20' maxisize='20'></p>";

echo "<p>Password <i>Sena</i> <input type='password' name='Password'
             size='20' maxisize='20'></p>";
echo "<input type='hidden' name='do' value='login'>";

echo "<input type='submit' name='log' value='Enter'>
</form>";

/* form for a new member to fill out */

echo "<form action='Login.php' method='POST'>";

if (isset($message_new))
{
  echo "<span style='color: red;'>$message_new</span>";
}

echo "<p><p style='font-weight: bold'>
	<h1>Registration Page</h1><br>
	Please fill in the personal information for contact purposes.<br>  
	An asterisk * indicates required information</p>";



echo "<tr>
	<td style='text-align: right;
		font-weight: bold'>*First Name</td>
	<td><input type='text' name='NameFirst' 
	value='' size='20' 
	maxlength='20'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>*Last Name</td>
	<td><input type='text' name='NameLast' 
	value='' size='25' 
	maxlength='25'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Organization Affiliation</td>
	<td><input type='text' name='OrgName' 
	value='' size='45' 
	maxlength='45'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>*Address</td>
	<td><input type='text' name='Address' 
	value='' size='35' 
	maxlength='35'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>*City</td>
	<td><input type='text' name='City' 
	value='' size='25' 
	maxlength='25'>
	</td></tr>";

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Phone Number</td>
	<td><input type='text' name='PhoneNum' 
	value='' size='20' 
	maxlength='20'>
	</td></tr>";

echo "<p><h4>*Email (Use this for your Login)
	<input type='text' name='Email' 
	value='' size='35' 
	maxlength='35'>
	</h4>";
echo "<p>
	<h4>*Choose a Password 
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
//echo "<input type='hidden' name='PasswordRetrieve' value='Password'>";
/*echo "<p>
	<h4>In case you forget your password, write a question that only you know the answer to, and the database will retrieve your password.
	<input type='text' name='Question'
	value='' size='50'
	maxlength='50'></h4>
	</p>";
echo "<p>
	<h4>What's the answer to your question?
	<input type='text' name='Answer'
	value='' size='20'
	maxlength='20'></h4>
	</p>";
*/
	

echo "<p> Would you like to be contacted about seed swaps, classes, etc.?";
/*
echo "<select name='ContactYN'>\n
	 <option value='Yes' selected='selected'>Yes</option>
	 <option value='No'>No</option>
	 </select><br><br>";
*/
echo "<input type='radio' name='ContactYN'
	     value='Yes' checked>Yes";
echo "<input type='radio' name='ContactYN'
	     value='No'>No";

echo " <p>*What's your Seed Saving comfort level?";
echo "<input type='radio' name='SeedExpLvl'
	     value='Easy' checked>Easy";
echo "<input type='radio' name='SeedExpLvl'
	     value='Advanced'>Advanced";
/*		 
echo " <p>*What's your Seed Saving comfort level?";
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
echo " <p>*What's your gardening comfort level?   ";
echo "<select name='GardenExpLvl'>\n
	 <option value='Easy' selected='selected'>Easy</option>
	 <option value='Advanced'>Advanced</option>
	 </select><br><br>";
*/

echo "<p> Please highlight the ways in which you would be willing to 
	volunteer with B.A.S.I.L. Seed Library.
	<br>(Press Ctrl and click for multiple selections)";
echo "<p><select size = '5' name = 'Volunteer[]' multiple='multiple'>
		<option selected>None
		<option>Library
		<option>Data
		<option>Teach
		<option>Mentor
		<option>Fundraise
		<option>Outreach
		<option>Other </select>";


/*echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>*Choose a Username</td>
	<td><input type='text' name='loginName' 
	value='' size='20' 
	maxlength='20'>
	</td></tr>";
	*/


echo "<input type='hidden' name='do' value='new'>";

echo "<br><br><input type='submit' value='Become a Member'>
	</form>\n";

?>
</body></html>