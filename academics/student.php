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

    <div id="course-container">
    	<div class="course-container-space-width">
    		<div class="sectionadd">
    			<button class="btn addNew" onclick="openAddForm()">+ Add Student</button>
    		</div>
    		<div class="sectionTable">
    			<h2>Student</h2>
    			<table>
    				<thead>
    					<tr>
    						<th>S/n</th>
    						<th>ID</th>
    						<th>Fullname</th>
    						<th>Phone</th>
    						<th>Email</th>
    						<th>Level</th>
    						<th>Program</th>
    						<th>Group</th>
    						<th>Action</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    					$i = 1;
    						$stuQuery = mysqli_query($connect, "SELECT * FROM student ORDER BY pid, level");
    						while ($stuRes = mysqli_fetch_array($stuQuery)) {
    							$sid = $stuRes['sid'];
    							$fname = $stuRes['firstname'];
    							$lname = $stuRes['lastname'];
    							$phone = $stuRes['phone'];
    							$semail = $stuRes['semail'];
    							$level = $stuRes['level'];
    							$gid = $stuRes['gid'];
    							$pid = $stuRes['pid'];

    							$grpQuery = mysqli_query($connect, "SELECT * FROM grouping WHERE gid = '$gid'");
    							$grpRes = mysqli_fetch_array($grpQuery);
    							$group = $grpRes['name'];

    							$proQuery = mysqli_query($connect, "SELECT * FROM program WHERE pid = '$pid'");
    							$proRes = mysqli_fetch_array($proQuery);
    							$program = $proRes['name'];
    							?>
    						<tr>
    							<td><?php echo $i;?></td>
    							<td><?php echo $sid;?></td>
    							<td><?php echo $fname." ".$lname;?></td>
    							<td><?php echo $phone;?></td>
    							<td><?php echo $semail;?></td>
    							<td><?php echo $level;?></td>
    							<td><?php echo $program;?></td>
    							<td><?php echo $group;?></td>
    							<td class="tdAction">
    								<form action="student.php" method="POST">
    									<input type="hidden" name="id" value="<?php echo $sid; ?>">
    									<input type="submit" name="stuEdit" value="Edit" class="btn edit">
    								</form>
    								<form action="crud.php" method="POST">
    									<input type="hidden" name="id" value="<?php echo $sid; ?>">
    									<input type="submit" name="stuDelete" value="Delete" class="btn delete">
    								</form>
    							</td>
    						</tr>
    					<?php $i++;} ?>
    				</tbody>
    			</table>
    		</div>
    	</div>
    </div>

    <?php
    	if (isset($_POST['stuEdit'])) {
    		$sid = $_POST['id'];

    		$stuQuery = mysqli_query($connect, "SELECT * FROM student WHERE sid = '$sid'");
    		$stuRes = mysqli_fetch_array($stuQuery);
    		$id = $stuRes['sid'];
    		$fname = $stuRes['firstname'];
    		$lname = $stuRes['lastname'];
    		$phone = $stuRes['phone'];
    		$semail = $stuRes['semail'];
        $pass = $stuRes['password'];
    		$level = $stuRes['level'];
    		$gid = $stuRes['gid'];
    		$pid = $stuRes['pid'];

    		$grpQuery = mysqli_query($connect, "SELECT * FROM grouping WHERE gid = '$gid'");
    		$grpRes = mysqli_fetch_array($grpQuery);
    		$group = $grpRes['name'];

    		$proQuery = mysqli_query($connect, "SELECT * FROM program WHERE pid = '$pid'");
    		$proRes = mysqli_fetch_array($proQuery);
    		$program = $proRes['name'];?>
    <div id="updateStudent-modal">
    	<div class="updateStudent-modal-data">
    		<form action="crud.php" method="POST">
    			<div class="modalTitle">
    				<h2>Add Student</h2>
    			</div>
    			<div class="modalContent">
    				<div class="modalData">
    					<label>Index Number</label>
    					<input type="text" name="sid" value="<?php echo $sid; ?>">
    				</div>
    				<div class="modalData">
    					<label>First Name</label>
    					<input type="text" name="fname" value="<?php echo $fname; ?>">
    				</div>
    				<div class="modalData">
    					<label>Last Name</label>
    					<input type="text" name="lname" value="<?php echo $lname; ?>">
    				</div>
    				<div class="modalData">
    					<label>Phone Number</label>
    					<input type="text" name="phone" value="<?php echo $phone; ?>" pattern="[0-9]*">
    				</div>
    				<div class="modalData">
    					<label>Student Email</label>
    					<input type="text" name="semail" value="<?php echo $semail; ?>">
    				</div>
            <div class="modalData">
              <label>Password</label>
              <input type="text" name="pass" placeholder="********">
            </div>
    				<div class="modalData">
    					<label>Level</label>
    					<select name="level">
    						<option value="<?php echo $level;?>"><?php echo $level;?></option>
    						<option value="100">100</option>
    						<option value="200">200</option>
    						<option value="300">300</option>
    						<option value="400">400</option>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Program</label>
    					<select name="program">
    						<option value="<?php echo $pid; ?>">
    							<?php
    								$proQuery = mysqli_query($connect, "SELECT * FROM program WHERE pid = '$pid'");
    								$proRes = mysqli_fetch_array($proQuery);
    								echo $proRes['name'];
    							?>
    						</option>
    						<?php
    							$proQuery = mysqli_query($connect, "SELECT * FROM program");
    							while ($proRes = mysqli_fetch_array($proQuery)) {
    							$pid = $proRes['pid'];
    							$pname = $proRes['name']; ?>
    						<option value="<?php echo $pid;?>"><?php echo $pname;?></option>
    						<?php } ?>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Group</label>
    					<select name="group">
    						<option value="<?php echo $gid; ?>">
    							<?php
    								$grpQuery = mysqli_query($connect, "SELECT * FROM grouping WHERE gid = '$gid'");
    								$grpRes = mysqli_fetch_array($grpQuery);
    								echo $grpRes['name'];
    							?>		
    						</option>
    						<?php
    							$grpQuery = mysqli_query($connect, "SELECT * FROM grouping");
    							while ($grpRes = mysqli_fetch_array($grpQuery)) {
    								$gid = $grpRes['gid'];
    								$gname = $grpRes['name']; ?>
    							<option value="<?php echo $gid;?>"><?php echo $gname;?></option>
    						<?php } ?>
    					</select>
    				</div>
    				<div class="modatBtn">
              <input type="hidden" name="sid" value="<?php echo $id; ?>">
              <input type="hidden" name="mainpass" value="<?php echo $pass; ?>">
    					<input type="submit" name="updatestudent" value="Update" class="btn">
              <button type="button" class="btn delete" onclick="closeUpdateForm()">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
    <?php	}else{ ?>
    <div id="addStudent-modal">
    	<div class="addStudent-modal-data">
    		<form action="crud.php" method="POST">
    			<div class="modalTitle">
    				<h2>Add Student</h2>
    			</div>
    			<div class="modalContent">
    				<div class="modalData">
    				<?php $idnum = rand(10000000, 99999999); ?>
    					<label>Index Number</label>
    					<input type="text" name="sid" value="<?php echo $idnum; ?>" readonly>
    				</div>
    				<div class="modalData">
    					<label>First Name</label>
    					<input type="text" name="fname" placeholder="Kofi">
    				</div>
    				<div class="modalData">
    					<label>Last Name</label>
    					<input type="text" name="lname" placeholder="Ampong">
    				</div>
    				<div class="modalData">
    					<label>Phone Number</label>
    					<input type="text" name="phone" placeholder="0123456789" pattern="[0-9]*">
    				</div>
    				<div class="modalData">
    					<label>Student Email</label>
    					<input type="text" name="semail" value="<?php echo $idnum."@upsa.edu"; ?>" readonly>
    				</div>
    				<div class="modalData">
    					<label>Password</label>
    					<input type="password" name="pass" placeholder="********">
    				</div>
    				<div class="modalData">
    					<label>Level</label>
    					<select name="level">
    						<option></option>
    						<option value="100">100</option>
    						<option value="200">200</option>
    						<option value="300">300</option>
    						<option value="400">400</option>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Program</label>
    					<select name="program">
    						<option></option>
    						<?php
    							$proQuery = mysqli_query($connect, "SELECT * FROM program");
    							while ($proRes = mysqli_fetch_array($proQuery)) {
    							$pid = $proRes['pid'];
    							$pname = $proRes['name']; ?>
    						<option value="<?php echo $pid;?>"><?php echo $pname;?></option>
    						<?php } ?>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Group</label>
    					<select name="group">
    						<option></option>
    						<?php
    							$grpQuery = mysqli_query($connect, "SELECT * FROM grouping");
    							while ($grpRes = mysqli_fetch_array($grpQuery)) {
    								$gid = $grpRes['gid'];
    								$gname = $grpRes['name']; ?>
    							<option value="<?php echo $gid;?>"><?php echo $gname;?></option>
    						<?php } ?>
    					</select>
    				</div>
    				<div class="modatBtn">
    					<input type="submit" name="addstudent" value="Add Student" class="btn">
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
    <?php } ?>

<script>
// Function to open the modal
function openAddForm() {
  document.getElementById('addStudent-modal').style.display = 'block';
}

function closeUpdateForm() {
  document.getElementById('updateStudent-modal').style.display = 'none';
  window.location.href = 'student.php';
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
  var modal = document.getElementById('addStudent-modal');
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>