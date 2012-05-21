<?
include('inc/session.php');
include('inc/db.php');

$message = "";
if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	if(!preg_match("/^[A-Za-z' -]{1,50}$/",$_POST['Common_Name'])) {
		$message = "Invalid Common Name.";
	}
	if(!preg_match("/^[A-Za-z' -]{1,50}$/",$_POST['Variety'])) {
		$message = "Invalid Variety.";
	}
	if(!preg_match("/^[A-Za-z' -]{1,50}$/",$_POST['Location'])) {
		$message = "Invalid Location.";
	}
	foreach(array('Common_Name','Variety','Location') as $required_field) {
		$value = trim($_POST[$required_field]);
		if (empty($value)) {
			$message = "$required_field is a required field.";
			break;
		}
	}

	if (empty($message)) {
		$sql = sprintf("INSERT INTO seeds (Common_Name, Latin_Name, Variety, Year_Harvested, Location, Experience, Notes) VALUES ('%s', '', '%s', %s, '%s', %s, '%s')",
					mysql_real_escape_string($_POST['Common_Name']),
					mysql_real_escape_string($_POST['Variety']),
					mysql_real_escape_string($_POST['Year_Harvested']),
					mysql_real_escape_string($_POST['Location']),
					mysql_real_escape_string($_POST['Experience']),
					mysql_real_escape_string($_POST['Notes'])
		);
		mysqli_query($cxn, $sql) or die("Couldn't execute query: $sql" . mysqli_error($cxn));
		$id = mysqli_insert_id($cxn);
		$sql = sprintf("INSERT INTO transactions (Date, UserID, SeedID, Count) VALUES (now(), %s, %s, 1)",
					mysql_real_escape_string($_SESSION['logid']),
					mysql_real_escape_string($id)
		);
		mysqli_query($cxn, $sql) or die("Couldn't execute query: $sql" . mysqli_error($cxn));
		header("Location: index.php");
		exit();
	}
}
$page_title = "Lend Seeds";
include("inc/header.php");
?>
	Please fill in the information for the seeds you are lending.
	<div id="lend" class="box">
		<form id="lend_form" action="lendForm.php" method="POST">
			<div class="field">
				<span class="label">Common Name</span>
				<input type='text' name='Common_Name' value="<?=$_POST['Common_Name']?>"/>
			</div>
			<div class="field">
				<span class="label">Variety</span>
				<input type='text' name='Variety' value="<?=$_POST['Variety']?>"/>
			</div>
			<div class="field">
				<span class="label">Location Harvested</span>
				<input type='text' name='Location' value="<?=$_POST['Location']?>"/>
			</div>
			<div class="field">
				<span class="label">Year Harvested</span>
				<select name="Year_Harvested">
				<? $today = getdate(); for ($i = 0; $i < 7; ++$i) { $year = $today['year'] - $i; ?>
					<option value="<?=$year?>" <?=$_POST['Year_Harvested'] == $year ? 'selected="selected"' : ''?>><?=$year?></option>
				<?}?>
				</select>
			</div>
			<div class="field">
				<span class="label">What experience level is needed for gardening/saving this seed?</span>
				<select name="Experience">
					<option value="0" <?=$_POST['Experience']=='0' ? 'selected="selected"' : ''?>>Unknown</option>
					<option value="1" <?=$_POST['Experience']=='1' ? 'selected="selected"' : ''?>>Easy</option>
					<option value="2" <?=$_POST['Experience']=='2' ? 'selected="selected"' : ''?>>Advanced</option>
				</select>
			</div>
			<div class="field">
				<span class="label">Comments about saving these seeds</span>
				<textarea name="Notes" cols="40" rows="5"><?= htmlspecialchars($_POST['Notes']) ?></textarea>
			</div>
			<input type='submit' value='Submit'>
		</form>
		<div class="error_text"><?=$message?></div>
	</div>
	<a href="javascript:history.go(-1)">Back</a>
<?include("inc/footer.php");?>
