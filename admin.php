<?php
/*   Script name: TransType.php
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
	<head><title> Administration Page </title></head>
	<body>
<?php
 
  global $cxn;
 
  function show_form() {
  //display a radiobutton
	echo "<form action='admin.php' method ='POST'>\n";
	echo "Do you want to see current Users or the Seed Table?";
	echo "<br><input type='radio' name='TableType'
			value='user' checked>User Table";
	echo "<input type='radio' name='TableType'
			value='seed'>Seed Table";
	echo "<br><br><input type='submit' value='Submit'>
	</form>\n";

	}
	function display_table_headings($TType)
	{
		if($TType == 'seedcatalog') {
			echo "<h1> The Seed Transactions Table</h1></br>";
			echo "<table border='3'><tr>";
			
			echo "<tr><td><b>Plant Name</b></td>"
			. "<td><b>Scientific Name</b></td>"
			. "<td><b>Date Registered</b></td>"
			. "<td><b>Variety</b></td>"
			. "<td><b>MemberID</b></td>"
			. "<td><b>Year Harvested</b></td>"
			. "<td><b>Location</b></td>"
			. "<td><b>Experience</b></td>"
			. "<td><b>Notes</b></td>"
			. "<td><b>Last Seed?</b></td></tr>";
		}
		if($TType == 'userseedreg') {//DB Dependent!!
			echo "<h1> The User Table</h1></br>";
			echo "<table border='3'><tr>";
			echo "<tr><td><b>DateReg</b></td><td><b>First Name</b></td><td><b>Last Name</b></td>"
			. "<td><b>Org Name</b></td>"
			. "<td><b>Address</b></td>"
			. "<td><b>City</b></td>"
			. "<td><b>Phone</b></td>"
			. "<td><b>Email</b></td>"
			. "<td><b>Contact?</b></td>"
			. "<td><b>Seed Experience</b></td>"
			. "<td><b>Garden Experience</b></td>"
			. "<td><b>Volunteer</b></td></tr>";
			
		}
	}
	function display_table($Table) {
		global $cxn;
		 include("misc.inc");
		 //echo "<h1>$Table</h1>";
		 if($Table == 'user') {
			$TableType = 'userseedreg';
			$ordercol = 'DateReg';
		}	
		elseif($Table == 'seed') {
			$TableType = 'seedcatalog';
			$ordercol = 'Date';
		}
		/*echo "<form action='admin.php' method ='POST'>\n";
		echo "<p><select size = '5' name = 'ordercol' >
		<option selected>Date
		<option>Name
		<option>Email
		</select>";
		echo "<br><br><input type='submit' value='Submit'>
	</form>\n";
		*/
		$cxn = mysqli_connect($host, $user, $pword, $database)
			or die ("Couldn't connect to server.");
		$sql = "SELECT * FROM $TableType
				ORDER BY $ordercol DESC";
		$result = mysqli_query($cxn,$sql)
			or die("Couldn't execute query." . mysqli_error($cxn));
		//$row = mysqli_fetch_row($result);
		echo '<br><br><a href="TransType.php">Transactions</a>';
		
		display_table_headings($TableType);
		echo "</tr>";
		$numrow = mysqli_num_rows($result);
		//echo $numrow;
		while($row = mysqli_fetch_assoc($result)) {
			echo "<tr>";
			foreach ($row AS $field=>$cell) {
				if($field != 'Password' and $field != 'admin' and $field != 'TransactionID')  //DB Dependent!!
				{
					
					if($field == 'Email')
						$Email = $cell;
					if($field == 'Volunteer')
					{
						$volstr = "";
						$vsql = "SELECT Type FROM volunteer_user_map
								WHERE email LIKE '" . $Email . "'";
					//	echo $sql;
						$vresult = mysqli_query($cxn,$vsql)
							or die("Couldn't execute Volunteer query." . mysqli_error($cxn));
						
						while($vols = mysqli_fetch_assoc($vresult))
							foreach($vols AS $vtype)
								@$volstr .= $vtype . ",";
						$cell = trim($volstr, ",");
					}
					echo "<td>$cell</td>";
				}	
			}
			echo "</tr>";
		}
		echo "</table>";		
		return;
	}
	
	function main() {
		global $cxn;
		if(empty($_POST['TableType']))  //if first time through show_form();
			show_form();
		else {
			$row = display_table($_POST['TableType']);
		}
		//echo "Getting to the last of the program";
		echo "<p><INPUT TYPE='button' VALUE='Back' onClick='history.go(-1)'>";		
}
main();
	
?>