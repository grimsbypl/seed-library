<?
include('inc/session.php');
include('inc/db.php');

$sql = sprintf(
	"SELECT t.id, Date, Common_Name, Variety, Count " .
	"FROM users AS u, transactions AS t INNER JOIN seeds AS s ON t.SeedID=s.id " .
	"WHERE t.UserID=%s GROUP BY t.id",
	mysql_real_escape_string($_SESSION['logid'])
);
$result = mysqli_query($cxn, $sql) or die("Couldn't execute query: $sql" . mysqli_error($cxn));

$page_title = "Transactions";
include('inc/header.php');
?>
	<table id="transactions" class="box">
		<caption>Hello, <?=$_SESSION['logname']?>. Here are all the seeds you borrowed.</caption>
		<thead>
			<tr>
				<th>Date Borrowed</th>
				<th>Plant Name</th>
				<th>Variety</th>
				<th>Action</th>
			</th>
		</thead>
		<tbody>
		<? $i = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
			<tr class="row_<?=($i % 2 == 0) ? 'even' : 'odd'?>">
				<td><?= $row['Date'] ?></td>
				<td><?= $row['Common_Name'] ?></td>
				<td><?= $row['Variety'] ?></td>
				<td><?= ($row['Count'] > 0) ? 'Lend' : 'Borrow' ?></td>
			</tr>
		<? ++$i; } ?>
		</tbody>
	</table>
	<a href="javascript:history.go(-1)">Back</a>
<? include('inc/footer.php') ?>
