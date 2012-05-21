<?
include('inc/session.php');
include('inc/db.php');
$page_title = "Borrow Seeds";

if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
	$ids = array();
	$lasts = array();
	$commons = array();
	$varities = array();
	foreach($_POST as $key=>$value) {
		if (strpos($key, 'borrow_') === 0) {
			$ids[] = $value;
			$lasts[] = isset($_POST['last_' . $value]) && $_POST['last_' . $value] == '1' ? '1' : '0';
			$commons[] = $_POST['common_' . $value];
			$varities[] = $_POST['variety_' . $value];
		}
	}
	if (isset($_POST['confirm'])) {
		for ($i = 0; $i < count($ids); ++$i) {
			$sql = sprintf("INSERT INTO transactions (Date, UserID, SeedID, Count) VALUES (now(), %s, %s, -1)",
				mysql_real_escape_string($_SESSION['logid']),
				mysql_real_escape_string($ids[$i]));
			mysqli_query($cxn, $sql) or die("Couldn't execute query: $sql" . mysqli_error($cxn));
			if ($lasts[$i] == '1') {
				$sql = sprintf("UPDATE seeds SET Last_Seed=1 WHERE id=%s",
					mysql_real_escape_string($ids[$i]));
				mysqli_query($cxn, $sql) or die("Couldn't execute query: $sql" . mysqli_error($cxn));
			}
		}
		header("Location: index.php");
		exit();
	}
	include("inc/header.php");
?>
	<form action="borrowForm.php" method="POST">
		<table id="borrow" class="box">
			<caption>Please confim your selections</caption>
			<thead>
				<tr>
					<th></th>
					<th>Last Packet</th>
					<th>Name</th>
					<th>Variety</th>
				</th>
			</thead>
			<tbody>
			<? for ($i = 0; $i < count($ids); ++$i) { ?>
				<tr class="row_<?=($i % 2 == 0) ? 'odd' : 'even'?>">
					<td><input name="borrow_<?=$ids[$i]?>" type="hidden" value="<?=$ids[$i]?>"/></td>
					<td><input name="last_<?=$ids[$i]?>" type="hidden" value="<?=$lasts[$i]?>"/><?=$lasts[$i] ? 'Yes' : 'No'?></td>
					<td><input name="common_<?=$ids[$i]?>" type="hidden" value="<?=$commons[$i]?>"/><?=$commons[$i]?></td>
					<td><input name="variety_<?=$ids[$i]?>" type="hidden" value="<?=$varities[$i]?>"/><?=$varities[$i]?></td>
				</tr>
			<? ++$i; } ?>
			</tbody>
		</table>
		<div id="borrow_buttons">
			<input type="hidden" name="confirm" value="1" />
			<input type="Submit" value="Confirm" />
		</div>
	</form>
	<a href="javascript:history.go(-1)">Back</a>
<?
} else {
	$sql = sprintf(
		"SELECT id, Common_Name, Latin_Name, Variety " .
		"FROM seeds AS s " .
		"WHERE s.Last_Seed=0 " .
		"ORDER BY Common_Name, Variety"
	);
	$result = mysqli_query($cxn, $sql) or die("Couldn't execute query: $sql" . mysqli_error($cxn));
	include("inc/header.php");
?>
	<form action="borrowForm.php" method="POST">
		<table id="borrow" class="box">
			<caption>Hello, <?=$_SESSION['logname']?>. Here are the seeds you may borrow.</caption>
			<thead>
				<tr>
					<th>Borrow</th>
					<th>Last Packet</th>
					<th>Name</th>
					<th>Variety</th>
				</th>
			</thead>
			<tbody>
			<? $i = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
				<tr class="row_<?=($i % 2 == 0) ? 'even' : 'odd'?>">
					<td><input name="borrow_<?=$row['id']?>" type="checkbox" value="<?=$row['id']?>"/></td>
					<td><input name="last_<?=$row['id']?>" type="checkbox" value="1"/></td>
					<td><input name="common_<?=$row['id']?>" type="hidden" value="<?= $row['Common_Name']?>"/><?= $row['Common_Name'] ?></td>
					<td><input name="variety_<?=$row['id']?>" type="hidden" value="<?= $row['Variety']?>"/><?= $row['Variety'] ?></td>
				</tr>
			<? ++$i; } ?>
			</tbody>
		</table>
		<div id="borrow_buttons">
			<input type="Submit" value="Borrow" />
		</div>
	</form>
	<a href="javascript:history.go(-1)">Back</a>
<?}?>
<? include("inc/footer.php"); ?>
