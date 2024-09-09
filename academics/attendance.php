<?php

	include '../database/dbconnect.php';

	// This will check if admin is logged in else it will redirect to index page
	if (!isset($_SESSION['admin'])) {
		header('location:index.php');
	}

	$course = isset($_POST['course']) ? $_POST['course'] : '';
	$level = isset($_POST['level']) ? $_POST['level'] : '';
	$group = isset($_POST['group']) ? $_POST['group'] : '';

	$attendanceSQL = "SELECT c.code, c.name as cname, s.sid, s.firstname as fname, s.lastname as lname,
	s.level, s.level, g.name as gname, l.firstname, l.lastname, l.title, ac.attend_date, ac.attend_time
	FROM attendclass as ac
	JOIN student s ON ac.sid = s.sid
	JOIN lecturer l ON ac.lid = l.lid
	JOIN program p ON s.pid = p.pid
	JOIN course c ON ac.cid = c.cid AND s.level = c.level
	JOIN grouping g ON s.gid = g.gid";

	//Append filter to the query
	if (!empty($course)) {
		$attendanceSQL .=" WHERE c.name LIKE'%$course%'";
	}
	if (!empty($level)) {
		$attendanceSQL .=" WHERE s.level = '$level' OR c.level = '$level'";
	}
	if (!empty($group)) {
		$attendanceSQL .=" WHERE g.name LIKE'%$group%'";
	}
	if (!empty($course) AND !empty($level) AND !empty($group)) {
		$attendanceSQL .=" WHERE c.name = '$course' AND (s.level = '$level' OR c.level = '$level') AND g.name = '$group'";
	}

	$attendanceQuery = mysqli_query($connect, $attendanceSQL);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&family=Poppins&family=Roboto&display=swap" rel="stylesheet">
	<title>UPSA STUDENT ATTENDANCE SYSTEM - ATTENDANCE</title>
</head>
<body>

    <?php include 'nav.php'; ?>

    <div id="attendance">
    	<div class="attendance-width-space">
    		<div class="main-search-filter">
    			<form action="" method="POST">
    				<input type="text" placeholder="Course" name="course" autocomplete="off">
    				<input type="text" placeholder="Level" name="level" autocomplete="off">
    				<input type="text" placeholder="Group" name="group" autocomplete="off">
    				<input type="submit" name="filer" value="Filter">
    			</form>
    		</div>
    		<div class="main-table-attendance">
    			<table>
    				<thead>
    					<tr>
    						<th>S/n</th>
    						<th>Code</th>
    						<th>Course Name</th>
    						<th>Lecturer</th>
    						<th>Student ID</th>
    						<th>Fullname</th>
    						<th>Level</th>
    						<th>Group</th>
    						<th>Date</th>
    						<th>Time</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    						if (mysqli_num_rows($attendanceQuery) > 0) {
    							$i=1;
    							while ($rows = mysqli_fetch_array($attendanceQuery)) {
    								$code = $rows['code'];
    								$cname = $rows['cname'];
    								$sid = $rows['sid'];
    								$student = $rows['fname']." ".$rows['lname'];
    								$gname = $rows['gname'];
    								$level = $rows['level'];
    								$lecturer = $rows['title'].". ".$rows['firstname']." ".$rows['lastname'];
    								$date = $rows['attend_date'];
    								$time = $rows['attend_time']; ?>
    						<tr>
    							<td><?php echo $i; ?></td>
    							<td><?php echo $code; ?></td>
    							<td><?php echo $cname; ?></td>
    							<td><?php echo $lecturer; ?></td>
    							<td><?php echo $sid; ?></td>
    							<td><?php echo $student; ?></td>
    							<td><?php echo $level; ?></td>
    							<td><?php echo $gname; ?></td>
    							<td><?php echo $date; ?></td>
    							<td><?php echo $time; ?></td>
    						</tr>
    					<?php   $i++;}
    						}?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>

</body>
</html>