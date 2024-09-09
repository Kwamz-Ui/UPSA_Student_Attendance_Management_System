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
    				if (isset($_POST['deptEdit'])) {
    					$did = $_POST['id'];

    					$deptSel = mysqli_query($connect, "SELECT * FROM department WHERE did = '$did'");
    					$deptRes = mysqli_fetch_array($deptSel);
    					$id = $deptRes['did'];
    					$dname = $deptRes['name'];
    					$fid = $deptRes['fid'];

    					$facQuery = mysqli_query($connect, "SELECT * FROM faculty WHERE fid = '$fid'");
						$facrow = mysqli_fetch_array($facQuery);
						$facid = $facrow['fid'];
						$facname = $facrow['name']; ?>
				<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Update Department</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Department name</label>
    							<input type="text" name="dname" value="<?php echo $dname; ?>">
    							<input type="hidden" name="id" value="<?php echo $id; ?>">
    						</div>
    						<div class="data-form-body-item">
    							<label>Faculty</label>
    							<select name="faculty">
    								<option value="<?php echo $facid;?>"><?php echo $facname;?></option>
    								<?php
    									$facQuery = mysqli_query($connect, "SELECT * FROM faculty");
    									while ($facRes = mysqli_fetch_array($facQuery)) {
    										$fid = $facRes['fid'];
    										$fname = $facRes['name']; ?>
    									<option value="<?php echo $fid;?>"><?php echo $fname;?></option>
    								<?php } ?>
    							</select>
    						</div>
    						<div class="data-form-body-item">
    							<input type="submit" name="updatedepartment" value="Update" id="form-btn">
    						</div>	
    					</div>
    				</form>
    			</div>
    			<?php }else{ ?>
    			<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Add Department</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Department name</label>
    							<input type="text" name="dname" placeholder="Department of UPSA">
    						</div>
    						<div class="data-form-body-item">
    							<label>Faculty</label>
    							<select name="faculty">
    								<option></option>
    								<?php
    									$facQuery = mysqli_query($connect, "SELECT * FROM faculty");
    									while ($facRes = mysqli_fetch_array($facQuery)) {
    										$fid = $facRes['fid'];
    										$fname = $facRes['name']; ?>
    									<option value="<?php echo $fid;?>"><?php echo $fname;?></option>
    								<?php } ?>
    							</select>
    						</div>
    						<div class="data-form-body-item">
    							<input type="submit" name="adddepartment" value="Add" id="form-btn">
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
    							<th>Department Name</th>
    							<th>Faculty Name</th>
    							<th class="thAction">Actions</th>
    						</tr>
    					</thead>
    					<tbody>
    						<?php
    							$deptSel = mysqli_query($connect, "SELECT * FROM department");
    							$i=1;
    							while ($deptRes = mysqli_fetch_array($deptSel)) {
    								$did = $deptRes['did'];
    								$dname = $deptRes['name'];
    								$fid = $deptRes['fid'];

    								$facQuery = mysqli_query($connect, "SELECT * FROM faculty WHERE fid = '$fid'");
									$facrow = mysqli_fetch_array($facQuery);
									$fname = $facrow['name'];
									 ?>
    							<tr>
    								<td><?php echo $i; ?></td>
    								<td><?php echo $dname; ?></td>
    								<td><?php echo $fname; ?></td>
    								<td class="forAction">
    									<form action="department.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $did; ?>">
    										<input type="submit" name="deptEdit" value="Edit" class="btn edit">
    									</form>
    									<form action="crud.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $did; ?>">
    										<input type="submit" name="deptDelete" value="Delete" class="btn delete">
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