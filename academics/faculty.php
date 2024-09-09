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

    <div id="Content-holder hide">
    	<div class="content-items-width-space">
    		<div class="main-content">
    			
    			<?php 
    				if (isset($_POST['facEdit'])) {
    					$fid = $_POST['id'];

    					$facSel = mysqli_query($connect, "SELECT * FROM faculty WHERE fid = '$fid'");
    					$facRes = mysqli_fetch_array($facSel);
    					$id = $facRes['fid'];
    					$name = $facRes['name']; ?>
    				<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Update Faculty</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Faculty name</label>
    							<input type="text" name="name" value="<?php echo $name; ?>">
    							<input type="hidden" name="id" value="<?php echo $id; ?>">
    						</div>
    						<div class="data-form-body-item">
    							<input type="submit" name="updatefaculty" value="Update" id="form-btn">
    						</div>	
    					</div>
    				</form>
    			</div>
    			<?php }else{ ?>
    				<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Add Faculty</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Faculty name</label>
    							<input type="text" name="fname" placeholder="Faculty of UPSA">
    						</div>
    						<div class="data-form-body-item">
    							<input type="submit" name="addfaculty" value="Add" id="form-btn">
    						</div>	
    					</div>
    				</form>
    			</div>
    			<?php } ?>
    			<div class="content-right">
    				<table>
    					<thead>
    						<tr>
    							<th>S/n</th>
    							<th>Faculty Name</th>
    							<th class="thAction">Actions</th>
    						</tr>
    					</thead>
    					<tbody>
    						<?php
    							$facSel = mysqli_query($connect, "SELECT * FROM faculty");
    							$i=1;
    							while ($facRes = mysqli_fetch_array($facSel)) {
    								$fid = $facRes['fid'];
    								$fname = $facRes['name'];?>
    							<tr>
    								<td><?php echo $i; ?></td>
    								<td><?php echo $fname; ?></td>
    								<td class="forAction">
    									<form action="faculty.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $fid; ?>">
    										<input type="submit" name="facEdit" value="Edit" class="btn edit" onclick="hidemain()">
    									</form>
    									<form action="crud.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $fid; ?>">
    										<input type="submit" name="facDelete" value="Delete" class="btn delete">
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