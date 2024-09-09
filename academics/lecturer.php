<?php

	include '../database/dbconnect.php';

	// This will check if admin is logged in else it will redirect to index page
	if (!isset($_SESSION['admin'])) {
		header('location:index.php');
	}

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

    <div id="Content-holder">
    	<div class="content-items-width-space">
    		<div class="main-content">
    		<?php 
    			if (isset($_POST['lecEdit'])) {
    				$id = $_POST['id'];
    				$lecSel = mysqli_query($connect, "SELECT * FROM lecturer WHERE lid = '$id'");
    				$lecRes = mysqli_fetch_array($lecSel);
    				$lid = $lecRes['lid'];
    				$title = $lecRes['title'];
    				$fname = $lecRes['firstname'];
    				$lname = $lecRes['lastname'];
    				$email = $lecRes['email'];
    				$phone = $lecRes['phone'];
    				$uname = $lecRes['username'];
    				$pass = $lecRes['password']; ?>
    			<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Update Lecturer</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Title</label>
    							<select name="title">
    								<option value="<?php echo $title ?>"><?php echo $title ?></option>
    								<option value="Dr">Dr</option>
    								<option value="Prof">Prof</option>
    								<option value="Mr">Mr</option>
    								<option value="Mrs">Mrs</option>
    								<option value="Rev">Rev</option>
    							</select>
    						</div>
    						<div class="data-form-body-item">
    							<label>First Name</label>
    							<input type="text" value="<?php echo $fname;?>" name="fname">
    						</div>
    						<div class="data-form-body-item">
    							<label>Last Name</label>
    							<input type="text" value="<?php echo $lname;?>" name="lname">
    						</div>
    						<div class="data-form-body-item">
    							<label>Email</label>
    							<input type="email" value="<?php echo $email;?>" name="email">
    						</div>
    						<div class="data-form-body-item">
    							<label>Phone</label>
    							<input type="text" value="<?php echo $phone;?>" name="phone" placeholder="0123456789" pattern="[0-9]*">
    						</div>
    						<div class="data-form-body-item">
    							<label>Username</label>
    							<input type="text" value="<?php echo $uname;?>" name="uname">
    						</div>
    						<div class="data-form-body-item">
    							<label>Password</label>
    							<input type="password" value="<?php echo $pass;?>" name="password">
    						</div>

    						<div class="data-form-body-item">
    							<input type="hidden" value="<?php echo $lid;?>" name="id">
    							<input type="submit" name="updatelecturer" value="Update" id="form-btn">
    						</div>	
    					</div>
    				</form>
    			</div>
    		<?php }else{ ?>
    			<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Add Lecturer</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Title</label>
    							<select name="title">
    								<option>Select Title</option>
    								<option value="Dr">Dr</option>
    								<option value="Prof">Prof</option>
    								<option value="Mr">Mr</option>
    								<option value="Mrs">Mrs</option>
    								<option value="Rev">Rev</option>
    							</select>
    						</div>
    						<div class="data-form-body-item">
    							<label>First Name</label>
    							<input type="text" name="fname">
    						</div>
    						<div class="data-form-body-item">
    							<label>Last Name</label>
    							<input type="text" name="lname">
    						</div>
    						<div class="data-form-body-item">
    							<label>Email</label>
    							<input type="email" name="email" placeholder="example@mail.com">
    						</div>
    						<div class="data-form-body-item">
    							<label>Phone</label>
    							<input type="text" name="phone" placeholder="0123456789" pattern="[0-9]*">
    						</div>
    						<div class="data-form-body-item">
    							<label>Username</label>
    							<input type="text" name="uname">
    						</div>
    						<div class="data-form-body-item">
    							<label>Password</label>
    							<input type="password" name="password" placeholder="**************">
    						</div>

    						<div class="data-form-body-item">
    							<input type="submit" name="addlecturer" value="Add" id="form-btn">
    						</div>	
    					</div>
    				</form>
    			</div>
    		<?php } ?>
    			<div class="content-right w-77">
    				<table>
    					<thead>
    						<tr>
    							<th>S/n</th>
    							<th>Title</th>
    							<th>Firstname</th>
    							<th>Lastname</th>
    							<th>Email</th>
    							<th>Phone</th>
    							<th>Username</th>
    							<th class="thAction">Actions</th>
    						</tr>
    					</thead>
    					<tbody>
    						<?php
    							$lecSel = mysqli_query($connect, "SELECT * FROM lecturer");
    							$i=1;
    							while ($lecRes = mysqli_fetch_array($lecSel)) {
    								$lid = $lecRes['lid'];
    								$title = $lecRes['title'];
    								$fname = $lecRes['firstname'];
    								$lname = $lecRes['lastname'];
    								$email = $lecRes['email'];
    								$phone = $lecRes['phone'];
    								$uname = $lecRes['username']; ?>
    							<tr>
    								<td><?php echo $i; ?></td>
    								<td><?php echo $title; ?></td>
    								<td><?php echo $fname; ?></td>
    								<td><?php echo $lname; ?></td>
    								<td><?php echo $email; ?></td>
    								<td><?php echo $phone; ?></td>
    								<td><?php echo $uname; ?></td>
    								<td class="forAction">
    									<form action="lecturer.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $lid; ?>">
    										<input type="submit" name="lecEdit" value="Edit" class="btn edit">
    									</form>
    									<form action="crud.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $lid; ?>">
    										<input type="submit" name="lecDelete" value="Delete" class="btn delete">
    									</form>
    								</td>
    							</tr>
    						<?php	$i++;} ?>
    					</tbody>
    				</table>
    			</div>
    		</div>
    	</div>
    </div>

</body>
</html>