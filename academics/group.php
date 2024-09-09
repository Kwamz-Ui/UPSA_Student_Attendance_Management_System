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
    			if (isset($_POST['grpEdit'])) {
    				$id = $_POST['id'];

    				$grpQuery = mysqli_query($connect, "SELECT * FROM grouping WHERE gid = '$id'");
    				$grpRes = mysqli_fetch_array($grpQuery);
    				$gid = $grpRes['gid'];
    				$gname = $grpRes['name']; ?>
	    		<div class="content-left">
	    			<form action="crud.php" method="POST">
	    				<div class="data-form-top">
	    					<h2>Update Group</h2>
	    				</div>
	    				<div class="data-form-body">
	    					<div class="data-form-body-item">
	    						<label>Group name</label>
	    						<input type="text" name="gname" value="<?php echo $gname; ?>">
	    					</div>
	    					<div class="data-form-body-item">
	    						<input type="hidden" name="id" value="<?php echo $gid; ?>">
	    						<input type="submit" name="updategroup" value="Update" id="form-btn">
	    					</div>	
	    				</div>
	    			</form>
    			</div>
    		<?php }else{ ?>
    			<div class="content-left">
    				<form action="crud.php" method="POST">
    					<div class="data-form-top">
    						<h2>Add Group</h2>
    					</div>
    					<div class="data-form-body">
    						<div class="data-form-body-item">
    							<label>Group name</label>
    							<input type="text" name="gname" placeholder="Group1 or Group 1">
    						</div>
    						<div class="data-form-body-item">
    							<input type="submit" name="addgroup" value="Add" id="form-btn">
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
    							<th>Group Name</th>
    							<th class="thAction">Actions</th>
    						</tr>
    					</thead>
    					<tbody>
    						<?php
    							$facSel = mysqli_query($connect, "SELECT * FROM grouping");
    							$i=1;
    							while ($facRes = mysqli_fetch_array($facSel)) {
    								$gid = $facRes['gid'];
    								$name = $facRes['name'];?>
    							<tr>
    								<td><?php echo $i; ?></td>
    								<td><?php echo $name; ?></td>
    								<td class="forAction">
    									<form action="group.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $gid; ?>">
    										<input type="submit" name="grpEdit" value="Edit" class="btn edit">
    									</form>
    									<form action="crud.php" method="POST">
    										<input type="hidden" name="id" value="<?php echo $gid; ?>">
    										<input type="submit" name="grpDelete" value="Delete" class="btn delete">
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