<?
session_start();
$login = $_SESSION["admin"];
if (!$login) header("Location: login.php");

$root_dir = "../";
require_once($root_dir."includes/config.inc.php");
require_once($root_dir."includes/dbconnect.php");

include_once("header.inc.php");

$sqlbase = dbConnect();

$action = $_REQUEST["action"];
if (empty($action)) $action = "showform";

function getOrder($row)
{
	global $order, $by;
	if ($row == $order)
	{
		if ($by == 'ASC') return 'DESC';
		else return 'ASC';
	}
	else return 'ASC';
}

if ($action == "showform")
{
	$perpage = '100';
	$a = $_GET["a"];
	$order = $_GET["order"]; if (empty($order)) $order = "lastname"; 
	$by = $_GET["by"]; if (empty($by)) $by = "ASC";
	if (ctype_digit($_REQUEST[newpage])) 
	{
		$a = ($perpage * $_REQUEST[newpage]) - $perpage;
		$a = "$a"; // weird quirk with the ctype_digit thing
	}
	
	$hoursused = array();
	$sql = "SELECT userID, SUM(officialhours) as hoursused FROM driverstraining as dt ".
				"WHERE dt.officialhours > 0 ".
				"GROUP BY dt.userID";
	$query = mysql_query($sql); echo mysql_error();
	while ($row = mysql_fetch_array($query)) $hoursused[$row[userID]] = $row[hoursused];
	
	$sql = "SELECT u.*, SUM(wheelhours) as wheeltot, UNIX_TIMESTAMP(dt_date) as dtdate, UNIX_TIMESTAMP(permit_date) as golddate ".#, SUM(dt.officialhours) as usedhours ".
					"FROM transactions as t ".
					"JOIN packages as p ON t.packageID = p.packageID ".
					"JOIN userinfo as u ON t.userID = u.userID ". 
					#"JOIN driverstraining as dt ON t.userID = dt.userID ".
					"WHERE u.archived='N' ".
					"AND p.wheelhours > 0 ".
					"GROUP BY u.userID ".
					"ORDER BY `".mysql_real_escape_string($order)."` ".mysql_real_escape_string($by)." ";
	$query = mysql_query($sql); echo mysql_error();
	$numrows = mysql_num_rows($query);
	
	if ($numrows >= 1)
	{
		$tothours = 0;
		$tothoursused = 0;
		?>
		
		<table border="0" cellpadding="1" cellspacing="1" width="100%">
			<tr class="sp_title">
				<td colspan="12">Users</td>
			</tr>
			<tr class="sp_columns">
				<td>&nbsp;</td>
				<td><a href="<?= $_SERVER["PHP_SELF"]; ?>?order=user&a=<?= $a; ?>&by=<?= getOrder('user'); ?>">Username</a></td>
				<td><a href="<?= $_SERVER["PHP_SELF"]; ?>?order=firstname&a=<?= $a; ?>&by=<?= getOrder('firstname'); ?>">First Name</a></td>
				<td><a href="<?= $_SERVER["PHP_SELF"]; ?>?order=lastname&a=<?= $a; ?>&by=<?= getOrder('lastname'); ?>">Last Name</a></td>
				<td><a href="<?= $_SERVER["PHP_SELF"]; ?>?order=wheeltot&a=<?= $a; ?>&by=<?= getOrder('wheeltot'); ?>">Total DT Hours</a></td>
				<td>Total Used Hours</td>
				<td>Hours Left</td>
				<td><a href="<?= $_SERVER["PHP_SELF"]; ?>?order=dt_cert&a=<?= $a; ?>&by=<?= getOrder('dt_cert'); ?>">DT Certificate</a></td>
				<td><a href="<?= $_SERVER["PHP_SELF"]; ?>?order=dt_date&a=<?= $a; ?>&by=<?= getOrder('dt_date'); ?>">DT Date</a></td>
				<td><a href="<?= $_SERVER["PHP_SELF"]; ?>?order=permit_complete&a=<?= $a; ?>&by=<?= getOrder('permit_complete'); ?>">Gold Cert</a></td>
				<td><a href="<?= $_SERVER["PHP_SELF"]; ?>?order=permit_date&a=<?= $a; ?>&by=<?= getOrder('permit_date'); ?>">Issue Date</a></td>
			</tr>
			<?
			while ($row = mysql_fetch_array($query))
			{
				$dtdate = "";
				if ($row[dtdate]) $dtdate = date("m-d-Y", $row[dtdate]);
				$golddate = "";
				if ($row[golddate]) $golddate = date("m-d-Y", $row[golddate]);
				$used = $hoursused[$row[userID]];
				$hoursleft = $row[wheeltot] - $used;
				
				$tothours += $row[wheeltot];
				$tothoursused += $used;
				?>
				<tr class="sp_data">
					<td><a href="userinfo.php?action=showform&n=<?= $row[userID]; ?>"><img src="<?= $root_dir; ?>images/mglass.gif" title="view/edit" border="0" /></a></td>
					<td><?= $row[user]; ?></td>
					<td><?= $row[firstname]; ?></td>
					<td><?= $row[lastname]; ?></td>
					<td><?= number_format($row[wheeltot]); ?></td>
					<td><?= number_format($used); ?></td>
					<td><?= number_format($hoursleft); ?></td>
					<td><?= $row[dt_cert]; ?></td>
					<td><?= $dtdate; ?></td>
					<td><?= $row[permit_complete]; ?></td>
					<td><?= $golddate; ?></td>
				</tr>
				<?	
			}
			?>
		<tr class="sp_title">
			<td colspan="4">Totals:</td>
			<td><?= number_format($tothours); ?></td>
			<td><?= number_format($tothoursused); ?></td>
			<td><?= number_format($tothours - $tothoursused); ?></td>
			<td colspan='4'>&nbsp;</td>
		</tr>
		</table>
		<?
	}
	else
	{
		?>
		<i>There have not been any users added yet.</i>
		<?
	}
}

include_once("footer.inc.php");

?>
