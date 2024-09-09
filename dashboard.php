<?php

	include 'database/dbconnect.php';
	if (!isset($_SESSION['sid'])) {
		header('location:login.php');
	}

	$id = $_SESSION['sid'];
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
		<div id="dashboard-content">
			<div class="box">
				<div class="top-box">
					<h2>Mark Attendance</h2>
				</div>
				<div class="bottom-box">
					<a href="markattendance.php">Mark Now >>></a>
				</div>
			</div>
			<div class="box">
				<div class="top-box">
					<h2>Check Attendance History</h2>
				</div>
				<div class="bottom-box">
					<a href="attendancehistory.php">See Now >>></a>
				</div>
			</div>
		</div>
	</div>

</body>
</html>