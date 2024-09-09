<?php

	session_start();

	$local = "localhost";
	$db = "attendance";
	$pass = "";
	$user = "root";

	$connect = mysqli_connect($local,$user,$pass,$db);

	if (!$connect) {
		echo "Check Your database connection";
	}

?>