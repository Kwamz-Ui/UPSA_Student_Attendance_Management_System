<?php

	include '../database/dbconnect.php';

	$_SESSION['error'] = '';

	// This code will select Username and Password from the admin table in the database

	if (isset($_POST['login'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];
		$adminSQL = mysqli_query($connect, "SELECT * FROM admin WHERE username = '$user' AND password = '$pass'");
		if (mysqli_num_rows($adminSQL) > 0) {
			$adminSQLRes = mysqli_fetch_assoc($adminSQL);
			$name = $adminSQLRes['username'];
			$_SESSION['admin'] = $name;
			header('location:dashboard.php');
		}
		else{
			header('location:index.php');
			$_SESSION['error'] = "Username or Password incorrect";
		}
	}
	

	/*This codes will insert or add data to the Faculty, Department, Program, Course, Group,
	Lecturer and Student Table*/

	if (isset($_POST['addfaculty'])) {
		$facName = $_POST['fname'];
		$facQuery = "INSERT INTO faculty(name) VALUES('$facName')";
		$facQueryRun = mysqli_query($connect, $facQuery);
		if ($facQueryRun) {
			header('location:faculty.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}

	}

	if (isset($_POST['adddepartment'])) {
		$deptName = $_POST['dname'];
		$facName = $_POST['faculty'];
		$deptQuery = "INSERT INTO department(name,fid) VALUES('$deptName',$facName)";
		$deptQueryRun = mysqli_query($connect, $deptQuery);
		if ($deptQueryRun) {
			header('location:department.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}

	}

	if (isset($_POST['addprogram'])) {
		$proName = $_POST['pname'];
		$did = $_POST['department'];
		$proQuery = "INSERT INTO program(name,did) VALUES('$proName',$did)";
		$proQueryRun = mysqli_query($connect, $proQuery);
		if ($proQueryRun) {
			header('location:program.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}

	}

	if (isset($_POST['addCourse'])) {
		$code = $_POST['code'];
		$name = $_POST['cname'];
		$ctype = $_POST['ctype'];
		$day = $_POST['day'];
		$stime = $_POST['stime'];
		$etime = $_POST['etime'];
		$level = $_POST['level'];
		$group = $_POST['group'];
		$program = $_POST['program'];
		$lecturer = $_POST['lecturer'];
		$courseQuery = "INSERT INTO course(code, name, ctype, day, stime, etime, level, pid, lid, gid) VALUES('$code','$name','$ctype','$day','$stime','$etime','$level','$program','$lecturer','$group')";
		$courseQueryRun = mysqli_query($connect, $courseQuery);
		if ($courseQueryRun) {
			header('location:course.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}

	}

	if (isset($_POST['addgroup'])) {
		$grpName = $_POST['gname'];
		$grpQuery = "INSERT INTO grouping(name) VALUES('$grpName')";
		$grpQueryRun = mysqli_query($connect, $grpQuery);
		if ($grpQueryRun) {
			header('location:group.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}

	}

	if (isset($_POST['addlecturer'])) {
		$title = $_POST['title'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$pass = $_POST['password'];

		$lecQuery = "INSERT INTO lecturer(title, firstname, lastname, email, phone, username, password) VALUES('$title','$fname','$lname','$email','$phone','$uname','$pass')";
		$lecQueryRun = mysqli_query($connect, $lecQuery);
		if ($lecQueryRun) {
			header('location:lecturer.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}

	}

	if (isset($_POST['addstudent'])) {
		$sid = $_POST['sid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$semail = $_POST['semail'];
		$pass = $_POST['pass'];
		$program = $_POST['program'];
		$group = $_POST['group'];
		$level = $_POST['level'];
		$stuQuery = "INSERT INTO student(sid, firstname, lastname, phone, semail, password, level, gid, pid) VALUES('$sid','$fname','$lname','$phone','$semail','$pass','$level','$group','$program')";
		$stuQueryRun = mysqli_query($connect, $stuQuery);
		if ($stuQueryRun) {
			header('location:student.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}

	}


	/*This codes will Delete or Remove data from the Faculty, Department, Program, Course, Group,
	Lecturer and Student Table*/

	if (isset($_POST['facDelete'])) {
		$fid = $_POST['id'];
		$facQuery = mysqli_query($connect, "DELETE FROM faculty WHERE fid = '$fid'");
		if ($facQuery) {
			header('location:faculty.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['deptDelete'])) {
		$did = $_POST['id'];
		$deptQuery = mysqli_query($connect, "DELETE FROM department WHERE did = '$did'");
		if ($deptQuery) {
			header('location:department.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['proDelete'])) {
		$pid = $_POST['id'];
		$proQuery = mysqli_query($connect, "DELETE FROM program WHERE pid = '$pid'");
		if ($proQuery) {
			header('location:program.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['courseDelete'])) {
		$cid = $_POST['id'];
		$courseQuery = mysqli_query($connect, "DELETE FROM course WHERE cid = '$cid'");
		if ($courseQuery) {
			header('location:course.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['lecDelete'])) {
		$lid = $_POST['id'];
		$lecQuery = mysqli_query($connect, "DELETE FROM lecturer WHERE lid = '$lid'");
		if ($lecQuery) {
			header('location:lecturer.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['stuDelete'])) {
		$sid = $_POST['id'];
		$stuQuery = mysqli_query($connect, "DELETE FROM student WHERE sid = '$sid'");
		if ($stuQuery) {
			header('location:student.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['grpDelete'])) {
		$gid = $_POST['id'];
		$grpQuery = mysqli_query($connect, "DELETE FROM grouping WHERE gid = '$gid'");
		if ($grpQuery) {
			header('location:group.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}


	/*This codes will Update data in the Faculty, Department, Program, Course, Group,
	Lecturer and Student Table*/

	if (isset($_POST['updatefaculty'])) {
		$fid = $_POST['id'];
		$name = $_POST['name'];
		$facQuery = mysqli_query($connect, "UPDATE faculty SET name ='$name' WHERE fid = '$fid'");
		if ($facQuery) {
			header('location:faculty.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['updatedepartment'])) {
		$did = $_POST['id'];
		$name = $_POST['dname'];
		$faculty = $_POST['faculty'];
		$deptQuery = mysqli_query($connect, "UPDATE department SET name ='$name', fid = '$faculty' WHERE did = '$did'");
		if ($deptQuery) {
			header('location:department.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['updateprogram'])) {
		$pid = $_POST['id'];
		$pname = $_POST['pname'];
		$dept = $_POST['department'];
		$proQuery = mysqli_query($connect, "UPDATE program SET name ='$pname', did = '$dept' WHERE pid = '$pid'");
		if ($proQuery) {
			header('location:program.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}
	}

	if (isset($_POST['updatelecturer'])) {
		$lid = $_POST['id'];
		$title = $_POST['title'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$uname = $_POST['uname'];
		$pass = $_POST['password'];
		
		$proQuery = mysqli_query($connect, "UPDATE lecturer SET title = '$title', firstname = '$fname', lastname = '$lname', email = '$email', phone = '$phone', username = '$uname', password = '$pass' WHERE lid = '$lid'");
		if ($proQuery) {
			header('location:lecturer.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}	
	}

	if (isset($_POST['updategroup'])) {
		$gid = $_POST['id'];
		$grpName = $_POST['gname'];
		$grpQueryRun = mysqli_query($connect, "UPDATE grouping SET name = '$grpName' WHERE gid = '$gid'");
		if ($grpQueryRun) {
			header('location:group.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";
		}

	}

	if (isset($_POST['updatecourse'])) {
		$cid = $_POST['id'];
		$code = $_POST['code'];
		$name = $_POST['cname'];
		$ctype = $_POST['ctype'];
		$day = $_POST['day'];
		$stime = $_POST['stime'];
		$etime = $_POST['etime'];
		$level = $_POST['level'];
		$group = $_POST['group'];
		$program = $_POST['program'];
		$lecturer = $_POST['lecturer'];

		$courseQuery = mysqli_query($connect, "UPDATE course SET code = '$code',name = '$name',ctype = '$ctype',day = '$day',stime = '$stime',etime = '$etime',level = '$level',pid = '$program',lid = '$lecturer',gid = '$group' WHERE cid = '$cid'");
		if ($courseQuery) {
			header('location:course.php');
		}else{
			$_SESSION['error'] = "Data was not successful.";	
		}
	}

	if (isset($_POST['updatestudent'])) {
		$sid = $_POST['sid'];
		$fname = $_POST['fname'];
		$lname = $_POST['lname'];
		$phone = $_POST['phone'];
		$semail = $_POST['semail'];
		$mainpass = $_POST['mainpass'];
		$pass = $_POST['pass'];
		$program = $_POST['program'];
		$group = $_POST['group'];
		$level = $_POST['level'];

		if (empty($pass)) {
			$stuQuery = mysqli_query($connect, "UPDATE student SET firstname ='$fname', lastname = '$lname', phone ='$phone', semail ='$semail', password = '$mainpass', level ='$level', gid ='$group', pid ='$program' WHERE sid  = '$sid'");
			if ($stuQuery) {
				header('location:student.php');
			}else{
				$_SESSION['error'] = "Data was not successful.";	
			}
		}else{
			$stuQuery = mysqli_query($connect, "UPDATE student SET firstname ='$fname', lastname = '$lname', phone ='$phone', semail ='$semail', password = '$pass', level ='$level', gid ='$group', pid ='$program' WHERE sid  = '$sid'");
			if ($stuQuery) {
				header('location:student.php');
			}else{
				$_SESSION['error'] = "Data was not successful.";	
			}
		}

	}

?>