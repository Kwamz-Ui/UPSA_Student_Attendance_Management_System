<?php

	include '../database/dbconnect.php';

	// This will check if admin is logged in else it will redirect to index page
	if (!isset($_SESSION['admin'])) {
		header('location:index.php');
	}

	$date = date('Y-m-d');

	$fsql = mysqli_query($connect,"SELECT fid FROM faculty");//This will select all the ids in the table
	$fnum = mysqli_num_rows($fsql);//this will count the total ids in the table

	$dsql = mysqli_query($connect,"SELECT did FROM department");//This will select all the ids in the table
	$dnum = mysqli_num_rows($dsql);//this will count the total ids in the table

	$psql = mysqli_query($connect,"SELECT pid FROM program");//This will select all the ids in the table
	$pnum = mysqli_num_rows($psql);//this will count the total ids in the table

	$csql = mysqli_query($connect,"SELECT cid FROM course");//This will select all the ids in the table
	$cnum = mysqli_num_rows($csql);//this will count the total ids in the table

	$gsql = mysqli_query($connect,"SELECT gid FROM grouping");//This will select all the ids in the table
	$gnum = mysqli_num_rows($gsql);//this will count the total ids in the table

	$ssql = mysqli_query($connect,"SELECT sid FROM student");//This will select all the ids in the table
	$snum = mysqli_num_rows($ssql);//this will count the total ids in the table

	$lsql = mysqli_query($connect,"SELECT lid FROM lecturer");//This will select all the ids in the database
	$lnum = mysqli_num_rows($lsql);//this will count the total ids in the database

	$asql = mysqli_query($connect,"SELECT id FROM attendclass WHERE attend_date = '$date'");//This will select all the ids in the database
	$anum = mysqli_num_rows($asql);//this will count the total ids in the database*/

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
	<title>UPSA STUDENT ATTENDANCE SYSTEM - HOME</title>
</head>
<body>

	<?php include 'nav.php'; ?>

	<div id="dashboard">
		<div class="main-box">
			<div class="box">
				<div class="box-top">
					<h1><?php echo $fnum; ?></h1>
					<p>Total number of Faculties</p>
				</div>
				<div class="box-bottom">
					<a href="faculty.php">More >>></a>
				</div>
			</div>
			<div class="box">
				<div class="box-top">
					<h1><?php echo $dnum; ?></h1>
					<p>Total number of Departments</p>
				</div>
				<div class="box-bottom">
					<a href="department.php">More >>></a>
				</div>
			</div>
			<div class="box">
				<div class="box-top">
					<h1><?php echo $pnum; ?></h1>
					<p>Total number of Programs</p>
				</div>
				<div class="box-bottom">
					<a href="program.php">More >>></a>
				</div>
			</div>
			<div class="box">
				<div class="box-top">
					<h1><?php echo $cnum; ?></h1>
					<p>Total number of Courses</p>
				</div>
				<div class="box-bottom">
					<a href="course.php">More >>></a>
				</div>
			</div>
			<div class="box">
				<div class="box-top">
					<h1><?php echo $lnum; ?></h1>
					<p>Total number of Lecturers</p>
				</div>
				<div class="box-bottom">
					<a href="lecturer.php">More >>></a>
				</div>
			</div>
			<div class="box">
				<div class="box-top">
					<h1><?php echo $snum; ?></h1>
					<p>Total number of Students</p>
				</div>
				<div class="box-bottom">
					<a href="student.php">More >>></a>
				</div>
			</div>
			<div class="box">
				<div class="box-top">
					<h1><?php echo $gnum; ?></h1>
					<p>Total number of Groups</p>
				</div>
				<div class="box-bottom">
					<a href="group.php">More >>></a>
				</div>
			</div>
			<div class="box">
				<div class="box-top">
					<h1><?php echo $anum; ?></h1>
					<p>Total number of Student Present</p>
				</div>
				<div class="box-bottom">
					<a href="attendance.php">More >>></a>
				</div>
			</div>	
		</div>
	</div>

</body>
</html>