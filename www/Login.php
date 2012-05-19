<?php
/* Program: Login.php
 * Desc: Login program for the Members only 
 *       of the seed library. It provides two
 *       options: (1) login using an existing 
 *	 Login name and (2) enter a new login name.
 *	 Login Names and passwords are stored in a 
 *	 MySQL database.
 */
error_reporting(E_ALL); // report all errors
session_start();
include("misc.inc");
$_SESSION['do'] = @$_POST['do'];  //why do I need this to make 'do' work?

switch (@$_POST['do'])
{
  case "login":
		
    $cxn = mysqli_connect($host, $user, $pword, $database)
	   or die ("Couldn't connect to server.");

    $sql = "SELECT Email From userseedreg
	    WHERE Email = '$_POST[Email]'";
    $result = mysqli_query($cxn,$sql)
	      or die("Couldn't execute query." . mysqli_error($cxn));
    $num = mysqli_num_rows($result);
	
    if ($num > 0)  //Login exists; check password
    {
		$sql = "SELECT Email, Password FROM userseedreg
			WHERE Email='$_POST[Email]'
			AND password=md5('$_POST[Password]')";  
		$result2 = mysqli_query($cxn, $sql)
			   or die("Couldn't execute query 2." . mysqli_error($cxn));
		$num2 = mysqli_num_rows($result2);
		if ($num2 > 0)  // password is correct
		{
		  $_SESSION['auth']="yes";
		  $logname=$_POST['Email'];       
		  $_SESSION['logname'] = $logname;
		  $today = date("Y-m-d h:i:s");
		  $sql = "INSERT INTO Login (Email,loginTime)
			  VALUES ('$logname','$today')";
		  $result = mysqli_query($cxn,$sql)
			  or die("Can't execute insert query.");
			  $sayhi = (string) $sql;
		  header("Location: TransType.php");
		}
		else    //password is not correct
		{
		  $message="The $num2[Password] Login, $_POST[Email]
			exists, but you have not entered the 
			correct password! Please try again.<br/>";
		  include("login_form.php");
		}
	  }
	  elseif ($num == 0) // login name not found
	  {
	   $message = "The Login you entered does not 
			   exist! Try again or Register as a new member using the form below.<br>";
		   include("login_form.php");
	  }
    break;

    case "new":
	/* Check for blanks */
	foreach($_POST as $field => $value)
	{
	  if ($field != "OrgName" && $field != "PhoneNum")   //Botanical Name not req'd
	  {
	    if($value == "")
	    {
	      $blanks[] = $field;
	    }
	  }
	}
    if(isset($blanks))
    {
      $message_new= "The following fields are blank.
		Please enter the required information: ";
	  foreach($blanks as $value) {			
		$message_new .= "$value, ";
	  }
		extract($_POST);
	  include("login_form.php");
	  exit();
    }
	/*  Check Password is re-typed Correctly  */
	if($_POST['Password'] != $_POST['ConfirmPassword']) {
		$message_new .= "Password confirmation failed. Please type and re-type (confirm) Password.";
		include("login_form.php");
		exit();
		}
	/* Validate data */
    foreach($_POST as $field => $value)
    {
       if(!empty($value))
       {
	    if(@preg_match("name",$field) and !@preg_match("login",$field))
	    {
			if(!@preg_match("^[A-Za-z' -]{1,50}$",$value))
			{
			  $errors[]="$value is not a valid name.";
			}
	    }
	    if(@preg_match("street",$field) or
		@preg_match("addr",$field) or @preg_match("city",$field))
       	    {
	       if(!@preg_match("^[A=Za-z0-9.,' -]{1,50}$",$value))
	       {
	         $errors[] = "$value is not a valid 
		      		address or city.";
	       }
	    }

	    if(@preg_match("email",$field))
	    {
			if(!@preg_match("^.+@.+\\..+$",$value))
			{
			  $errors[]="$value is not a valid email
					address.";
			}
	    }

	    if(@preg_match("phone",$field))
	    {
			if(!@preg_match("^[0-9)(xX -]{7,20}$",$value))
			{
			  $errors[] = "$value is not a  valid 
					phone number. ";
			}
	    }
       } // end if empty
    } // end foreach
    if(@is_array($errors))
    {
		$message_new = "";
		foreach($errors as $value)
		{
		  $message_new .= $value." Please try
					   again<br />";
		}
		extract($_POST);
		include("login_form.php");
		exit();
    }
    /* clean data */
    $cxn = mysqli_connect($host,$user,$pword,$database);

    foreach($_POST as $field => $value)
    {	if($field == "Email") {
			$Email = $value;
			}
		if($field == "Question"){
			$Question = $value;
		}
		if($field == "Answer"){
			$Answer = $value;
			}
		if($field == "PasswordRetrieve"){
			$Retrieve = $value;
			}
		if(isset($Question) and isset($Answer) and isset($Retrieve)){
			$hintsql = "INSERT INTO passwordhint ";
			$hintsql .= "(" . "Question, Answer, PasswordRetrieve" . ")" . " VALUES " ;
			$hintsql .= "(" . $Question . "," . $Answer . "," . $Retrieve . ")";
			}
		if($field != "Question" and $field != "Answer" and $field != "PasswordRetrieve" and $field != "Button" and $field != "do" and $field != "ConfirmPassword")
		{
		  if($field != "Volunteer") 
		  {
			  if($field == "Password")
			  {
				$Password = strip_tags(trim($value));
			  }
			  else
			  {
				$fields[]=$field;
				$value = (string) $value;
				$values[] = mysqli_real_escape_string($cxn,$value);  
				$field = $value;
			  }
		  }
		  else 
		  { //Put Volunteer lists into separate db table
				$Volunteer = $_POST['Volunteer'];
				if($Volunteer) 
				{
					$volunteersql = "INSERT INTO volunteer_user_map ";
					$volunteersql .= "(" . "email, Type" . ")" . " VALUES " ;
					foreach($Volunteer as $V) {
						$volunteersql .= "('" . $Email . "','" . $V . "'),";
					}
				}
				$volunteersql =trim($volunteersql,",");
		  }
		}
    }
    /* check whether user name already exists */
    $sql = "SELECT Email FROM userseedreg
		WHERE Email = '$Email'";
    $result = mysqli_query($cxn,$sql)  
		or die("Couldn't execute select query." . mysqli_error($cxn));
    $num = mysqli_num_rows($result);
    if ($num > 0)
    {
		$message_new = "$Email already used.
					Select another email address to use.";
		include("login_form.php");
		exit();
    }
    /* Add new member to database */
    else
    {
		$today = date("Y-m-d");
		$fields_str = implode(",",$fields);
		$values_str = implode('","',$values);
		$fields_str .=",DateReg";
		$values_str .='"'.",".'"'.$today;
		$fields_str .=",Password";
		$values_str .= '"'.","."md5"."('".$Password."')";
		$sql = "INSERT INTO userseedreg ";
		$sql .= "(".$fields_str.")";

		$sql .= " VALUES ";
		$sql .= "(".'"'.$values_str.")";


		$result = mysqli_query($cxn,$sql)
				or die("Couldn't execute insert query. new membertodb" . mysqli_error($cxn));
		
		$resultvol = mysqli_query($cxn,$volunteersql)
				or die("Couldn't execute volunteer insert query" . mysqli_error($cxn));
		if(isset($hintsql)){
			echo $hintsql;
			$resulthint = mysqli_query($cxn,$hintsql)
				or die("Couldn't execute hint insert query" . mysqli_error($cxn));
		}
	/*	
		$vol[]= $_POST['Volunteer'];
		echo "array_values($_POST[Volunteer])<br>";
		foreach($vol as $field=>$type) {  //can I just put into string here or must I put into array first?
			echo  $type . "This is field" .  $field;
			$values[$field] = "(" . $_POST['Email'] . "," . $type . ")";
		}
		$val = implode(",",$values);
		$sql = "INSERT INTO vol_user_map ";
		$sql .= "(" . "email,TypeID" . ")";
		$sql .= " VALUES ";
		$sql .= $val;
		echo "$sql</br>";
		$result = mysqli_query($cxn,$sql)
				or die("Couldn't execute map insert query. " . mysqli_error($cxn));
	*/	
		$_SESSION['auth']="yes";
		$_SESSION['logname'] = $Email;

		/* send email to new member page 360 "Dummies"*/
		$emess = "A new Member Account has been set up. ";
		$emess.= "Your new Member ID and password are: ";
		$emess.= "\n\n\t$Email\n\t$Password\n\n";
		$emess.="Thank you for becoming a member of BASIL.";
		$emess.= " We appreciate your interest in seed saving with the Ecology Center. \n\n";
		$emess.= "If you have any questions or problems,";
		$emess.= " email <ERASE THE BRCKETS AND EVERYTHING INSIDE AND REPLACE WITH WEBMASTER'S EMAIL>";
		echo "$emess";		                            
		$ehead="From: <ERASE THE BRCKETS AND EVERYTHING INSIDE AND REPLACE WITH WEBMASTER'S EMAIL>\r\n";
		$subj = "Your new Member Account for the Seed database";
		$mailsnd=mail("$Email","$subj","$emess","$ehead");
		header("Location: TransType.php");
    }
   break;
   default:
	include("login_form.php");
  }
?>
			