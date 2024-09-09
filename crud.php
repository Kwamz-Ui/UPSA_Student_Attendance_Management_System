<?php

	include 'database/dbconnect.php';

	$_SESSION['error'] = '';

	// This code will select Username and Password from the admin table in the database

	if (isset($_POST['login'])) {
		$email = $_POST['semail'];
		$pass = $_POST['pass'];

		$loginSQL = mysqli_query($connect, "SELECT * FROM student WHERE semail = '$email' AND password = '$pass'");
		if (mysqli_num_rows($loginSQL) > 0) {
			$adminrow = mysqli_fetch_array($loginSQL);
			$_SESSION['sid'] = $adminrow['sid'];
			$_SESSION['firstname'] = $adminrow['firstname'];
			$_SESSION['lastname'] = $adminrow['lastname'];
			$_SESSION['level'] = $adminrow['level'];
			$_SESSION['pid'] = $adminrow['pid'];
			$_SESSION['gid'] = $adminrow['gid'];
			header('location:dashboard.php');
		}else{
			header('location:login.php');
			$_SESSION['error'] = 'Student email or Password incorrect.';
		}
	}


	if (isset($_POST['markattendance'])) {
		$cid = $_POST['cid'];
		$lid = $_POST['lid'];
		$sid = $_POST['sid'];
		$time = $_POST['time'];

		$attendanceSQL = mysqli_query($connect, "INSERT INTO attendclass(cid, lid, sid, attend_time) VALUES ('$cid','$lid','$sid','$time')");
		if ($attendanceSQL) {
			header("location:dashboard.php");
		}else{
			echo mysql_error($connect);
		}
	}

?>