<?php

	include '../database/dbconnect.php';

	if (isset($_POST['login'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		$lecQuery = mysqli_query($connect, "SELECT * FROM lecturer WHERE username = '$user' AND password = '$pass'");
		if (mysqli_num_rows($lecQuery) > 0) {
			$lecRes = mysqli_fetch_array($lecQuery);
			$_SESSION['id'] = $lecRes['lid'];
			$_SESSION['email'] = $lecRes['lid'];
			header('location:generateQRcode.php');
		}else{
			header('location:index.php');
		}
		

	}

?>
