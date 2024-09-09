<?php

	include 'database/dbconnect.php';
	if (!isset($_SESSION['sid'])) {
		header('location:login.php');
	}

	$id = $_SESSION['sid'];
	$level = $_SESSION['level'];
	$gid = $_SESSION['gid'];
	$pid = $_SESSION['pid'];

	$historySQL = "SELECT * FROM attendclass ac JOIN course c ON ac.cid = c.cid JOIN lecturer l ON ac.lid = l.lid WHERE ac.sid = '$id' AND c.level = '$level' AND c.gid = '$gid' AND c.pid = '$pid' ORDER BY name";
	$historyQuery = mysqli_query($connect, $historySQL);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UPSA - Student Attendance System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

	<div id="stu-dashboard">

		<div id="nav">
			<div class="nav-content desktop">
				<a href="dashboard.php">UPSA- ATTENDANCE SYSTEM</a>
				<a href="logout.php"><?php echo $id;?> Logout</a>
			</div>
			<div class="nav-content mobile">
				<a href="dashboard.php">ATTENDANCE SYSTEM</a>
				<a href="logout.php"><?php echo $id;?> Logout</a>
			</div>
		</div>

		<div id="attendhistory">
			<div class="sec-table">
				<h3>History</h3>
				<table>
					<thead>
						<tr>
							<th>S/n</th>
							<th>Course Code</th>
							<th>Course Name</th>
							<th>Lecturer Name</th>
							<th>Date</th>
							<th>Time</th>
						</tr>
					</thead>
					<tbody>
					<?php
						if (mysqli_num_rows($historyQuery) > 0) {
							$i = 1;
							while ($historyRow = mysqli_fetch_array($historyQuery)) {
								$code = $historyRow['code'];
								$name = $historyRow['name'];
								$title = $historyRow['title'];
								$fname = $historyRow['firstname'];
								$lname = $historyRow['lastname'];
								$date = $historyRow['attend_date'];
								$time = $historyRow['attend_time']; ?>
						<tr>
							<td data-label="S/n"><?php echo $i; ?></td>
							<td data-label="Course Code"><?php echo $code; ?></td>
							<td data-label="Course Name"><?php echo $name; ?></td>
							<td data-label="Lecturer Name"><?php echo $title.". ".$fname." ".$lname; ?></td>
							<td data-label="Date"><?php echo $date; ?></td>
							<td data-label="Time"><?php echo $time; ?></td>
						</tr>
					<?php	$i++; }
						}
					?>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</body>
</html>