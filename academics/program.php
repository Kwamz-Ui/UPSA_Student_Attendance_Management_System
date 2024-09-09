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
    				if (isset($_POST['proEdit'])) {
    					$id = $_POST['id'];
    					$proSel = mysqli_query($connect, "SELECT * FROM program WHERE pid = '$id'");
    					$proRes = mysqli_fetch_array($proSel);
    					$pid = $proRes['pid'];
    					$pname = $proRes['name'];
    					$did = $proRes['did']; 

    					$deptSel = mysqli_query($connect, "SELECT * FROM department WHERE did = '$did'");
    					$deptRes = mysqli_fetch_array($deptSel);
    					$deptid = $deptRes['did'];
    					$dname = $deptRes['name'];
    					?>
    			<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Update Program</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Program name</label>
    							<input type="text" name="pname" value="<?php echo $pname; ?>">
    							<input type="hidden" name="id" value="<?php echo $pid; ?>">
    						</div>
    						<div class="data-form-body-item">
    							<label>Department</label>
    							<select name="department">
    								<option value="<?php echo $deptid; ?>"><?php echo $dname;?></option>
    								<?php
    									$deptQuery = mysqli_query($connect, "SELECT * FROM department");
    									while ($deptRes = mysqli_fetch_array($deptQuery)) {
    										$did = $deptRes['did'];
    										$fname = $deptRes['name']; ?>
    									<option value="<?php echo $did;?>"><?php echo $fname;?></option>
    								<?php } ?>
    							</select>
    						</div>
    						<div class="data-form-body-item">
    							<input type="submit" name="updateprogram" value="Update" id="form-btn">
    						</div>	
    					</div>
    				</form>
    			</div>
    			<?php }else{ ?>
    			<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Add Program</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Program name</label>
    							<input type="text" name="pname" placeholder="Bachelor of science Humanities">
    						</div>
    						<div class="data-form-body-item">
    							<label>Department</label>
    							<select name="department">
    								<option></option>
    								<?php
    									$deptQuery = mysqli_query($connect, "SELECT * FROM department");
    									while ($deptRes = mysqli_fetch_array($deptQuery)) {
    										$did = $deptRes['did'];
    										$fname = $deptRes['name']; ?>
    									<option value="<?php echo $did;?>"><?php echo $fname;?></option>
    								<?php } ?>
    							</select>
    						</div>
    						<div class="data-form-body-item">
    							<input type="submit" name="addprogram" value="Add" id="form-btn">
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
    							<th>Program Name</th>
    							<th>Department Name</th>
    							<th class="thAction">Actions</th>
    						</tr>
    					</thead>
    					<tbody>
    						<?php
    							$proSel = mysqli_query($connect, "SELECT * FROM program");
    							$i=1;
    							while ($proRes = mysqli_fetch_array($proSel)) {
    								$pid = $proRes['pid'];
    								$pname = $proRes['name'];
    								$did = $proRes['did'];

    								$deptQuery = mysqli_query($connect, "SELECT * FROM department WHERE did = '$did'");
									$deptrow = mysqli_fetch_assoc($deptQuery);
									$dname = $deptrow['name'];
									 ?>
    							<tr>
    								<td><?php echo $i; ?></td>
    								<td><?php echo $pname; ?></td>
    								<td><?php echo $dname; ?></td>
    								<td class="forAction">
    									<form action="program.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $pid; ?>">
    										<input type="submit" name="proEdit" value="Edit" class="btn edit">
    									</form>
    									<form action="crud.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $pid; ?>">
    										<input type="submit" name="proDelete" value="Delete" class="btn delete">
    									</form>
    								</td>
    							</tr>
    						<?php	$i++;}
    						?>
    					</tbody>
    				</table>
    			</div>
    		</div>
    	</div>
    </div>

</body>
</html>