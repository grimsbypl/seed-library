<?php

if (isset($message))
{
  echo "<span style='color: red;'>$message</span>";
}
echo "<p><p style='font-weight: bold'>
	Please fill in the information for the seeds you are lending. An asterisk * indicates required information</p>";

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


echo "<p><tr>
<td style='text-align: right;
	font-weight: bold'>*Year Harvested</td>
<td>
<select name='Year_Harvested'>\n";
echo "<option value='2002' selected='selected'>2002</option>";
for ($i = $year - 7 ; $i <= $year ; $i++) {
	echo "<option value=$i>$i</option>";
}
	echo "</select><br><br>";
 

echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>*Location Harvested </td>
	<td><input type='text' name='Location' 
	value='' size='65' 
	maxlength='65'>
	</td></tr></p>";


echo " <div style='margin-left: 0 in; margin-top: 0in'>
		*What experience level is needed for gardening/saving this seed?";
echo "<br><b>(Note: Look at the plant index on our website or at the library<b>" . 
	" to identify the level of seed saving difficulty.)";
/*echo "<select name='Experience'>\n
	 <option value='Easy' selected='selected'>Easy</option>
	 <option value='Advanced'>Advanced</option>
	 </select><br><br>";
	 */
echo "<br><input type='radio' name='Experience'
		value='Easy' checked>Easy";
echo "<br><input type='radio' name='Experience'
	     value='Advanced'>Advanced\n";	
echo "<p><tr>
	<td style='text-align: right;
		font-weight: bold'>Comments about saving these seeds (ie What does
			a person need to know about this particular seed?</td>
	<td><input type='text' name='Notes' 
	value='' size='100' 
	maxlength='100'>
	</td></tr></p>";
	echo "<p><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1);'>
	\n";
echo "<input type='submit' value='Review Entry'>
	</form>\n";
	?>