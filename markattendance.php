<?php
	
	error_reporting(0);

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
		<div id="markattendance">
			<?php
				date_default_timezone_set('Europe/London'); 
				$current_time = date("H:i:s");
				$current_date = date("Y-m-d");
				$sel = mysqli_query($connect, "SELECT * FROM course c JOIN student s WHERE c.pid = s.pid AND c.level = s.level AND c.gid = s.gid AND s.sid = '$id'");
				if (mysqli_num_rows($sel) > 0) {
					while ($row = mysqli_fetch_array($sel)) {
						$sid = $row['sid'];
						$fname = $row['firstname'];
						$lname = $row['lastname'];
						$cid = $row['cid'];
						$code = $row['code'];
						$name = $row['name'];
						$day = $row['day'];
						$stime = $row['stime'];
						$etime = $row['etime'];
						$lid = $row['lid'];

						//SELECT LECTURER NAME BASED ON THEIR
						$lecSQL = mysqli_query($connect, "SELECT * FROM lecturer WHERE lid = '$lid'");
						$lecRes = mysqli_fetch_array($lecSQL);
						$lecName = $lecRes['title'].". ".$lecRes['firstname']." ".$lecRes['lastname'];

						//Get Day of the week
						$weekSQL = mysqli_query($connect, "SELECT DAYOFWEEK(now()) as today");
						$weekrow = mysqli_fetch_array($weekSQL);
						$today = $weekrow['today'];

						//Select student id and date from attendance table
						$attendSQL = mysqli_query($connect, "SELECT * FROM attendclass WHERE sid = '$id' AND attend_date = '$current_date'");
						$attendfetch = mysqli_fetch_array($attendSQL);
						$student = $attendfetch['sid'];
						$course = $attendfetch['cid'];
						$attend_date = $attendfetch['attend_date'];
						
					}
					if ($current_date == $attend_date AND $course == $cid) {
						echo "<p class='nocourse'>You have Already marked your attendance.</p>";
					}
					elseif ($current_time >= $stime AND $current_time <= $etime AND $today == $day) { ?>
					<div class="attendanceForm">
						<form action="crud.php" method="POST" class="frmAttend">
							<h2>Attendance Form</h2>
							<div class="frmdata">
								<label>Student ID</label>
								<input type="text" name="sid" value="<?php echo $sid; ?>" readonly>
							</div>
							<div class="frmdata">
								<label>Fullname</label>
								<input type="text" value="<?php echo $fname." ".$lname; ?>" readonly>
							</div>
							<div class="frmdata">
								<label>Course Code</label>
								<input type="text" value="<?php echo $code; ?>" readonly>
							</div>
							<div class="frmdata">
								<label>Course Name</label>
								<input type="text" value="<?php echo $name; ?>" readonly>
							</div>
							<div class="frmdata">
								<label>Lecturer Name</label>
								<input type="text" value="<?php echo $lecName; ?>" readonly>
							</div>
							<div>
								<input type="hidden" name="lid" value="<?php echo $lid; ?>">
								<input type="hidden" name="cid" value="<?php echo $cid; ?>">
								<input type="hidden" name="time" value="<?php echo $current_time; ?>">
								<input type="submit" name="markattendance" value="Mark Attendance" class="button">
							</div>
						</form>
					</div>
			<?php	}else{
						echo "<p class='nocourse'>You have no attendance to mark now.</p>";
					}
			} ?>
		</div>
	</div>

</body>
</html>