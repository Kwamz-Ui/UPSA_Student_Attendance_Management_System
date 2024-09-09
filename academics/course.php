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
    			<button class="btn addNew" onclick="openAddForm()">+ Add Course</button>
    		</div>
    		<div class="sectionTable">
    			<h2>Courses</h2>
    			<table>
    				<thead>
    					<tr>
    						<th class="w3">S/n</th>
    						<th class="w7">Code</th>
    						<th class="w15">Name</th>
    						<th class="w5">Type</th>
    						<th class="w7">Day</th>
    						<th class="w6">Start</th>
    						<th class="w6">End</th>
    						<th class="w5">Group</th>
    						<th class="w5">Level</th>
    						<th class="w15">Program</th>
    						<th class="w15">Lecturer</th>
    						<th class="w12">Action</th>
    					</tr>
    				</thead>
    				<tbody>
    					<?php
    					$i = 1;
    						$courseQuery = mysqli_query($connect, "SELECT * FROM course ORDER BY name ASC");
    						while ($courseRes = mysqli_fetch_array($courseQuery)) {
    							$cid = $courseRes['cid'];
    							$code = $courseRes['code'];
    							$name = $courseRes['name'];
    							$type = $courseRes['ctype'];
    							$day = $courseRes['day'];
    							$stime = $courseRes['stime'];
    							$etime = $courseRes['etime'];
    							$level = $courseRes['level'];
    							$pid = $courseRes['pid'];
    							$lid = $courseRes['lid'];
    							$gid = $courseRes['gid']; 

    							$grpQuery = mysqli_query($connect, "SELECT * FROM grouping WHERE gid = '$gid'");
    							$grpRes = mysqli_fetch_array($grpQuery);
    							$gname = $grpRes['name'];

    							$proQuery = mysqli_query($connect, "SELECT * FROM program WHERE pid = '$pid'");
    							$proRes = mysqli_fetch_array($proQuery);
    							$pname = $proRes['name'];

    							$lecQuery = mysqli_query($connect, "SELECT * FROM lecturer WHERE lid = '$lid'");
    							$lecRes = mysqli_fetch_array($lecQuery);
    							$title = $lecRes['title'];
    							$fname = $lecRes['firstname'];
    							$lname = $lecRes['lastname']; ?>
    						<tr>
    							<td><?php echo $i;?></td>
    							<td><?php echo $code;?></td>
    							<td><?php echo $name;?></td>
    							<td><?php
    								if ($type == 1) {
    									echo "General";
    								} elseif ($type == 2) {
    									echo "Common";
    								}
    								else{
    									echo "Elective";
    								}
    							?></td>
    							<td><?php
    								if ($day == 1) {
    									echo "Sunday";
    								}elseif ($day == 2) {
    									echo "Monday";
    								}
    								elseif ($day == 3) {
    									echo "Tuesday";
    								}
    								elseif ($day == 4) {
    									echo "Wednesday";
    								}
    								elseif ($day == 5) {
    									echo "Thursday";
    								}
    								elseif ($day == 6) {
    									echo "Friday";
    								}
    								else{
    									echo "Saturday";
    								}
    							?></td>
    							<td><?php echo $stime;?></td>
    							<td><?php echo $etime;?></td>
    							<td><?php echo $gname;?></td>
    							<td><?php echo $level;?></td>
    							<td><?php echo $pname;?></td>
    							<td><?php echo $title.". ".$fname." ".$lname;?></td>
    							<td class="tdAction">
    								<form action="course.php" method="POST">
    									<input type="hidden" name="id" value="<?php echo $cid; ?>">
    									<input type="submit" name="courseEdit" value="Edit" class="btn edit">
    								</form>
    								<form action="crud.php" method="POST">
    									<input type="hidden" name="id" value="<?php echo $cid; ?>">
    									<input type="submit" name="courseDelete" value="Delete" class="btn delete">
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

    	if (isset($_POST['courseEdit'])) {
    		$id = $_POST['id'];
    		$courseSQL = mysqli_query($connect, "SELECT * FROM course WHERE cid = '$id'");
    		$cres = mysqli_fetch_array($courseSQL);
    		$cid = $cres['cid'];
    		$code = $cres['code'];
    		$name = $cres['name'];
    		$type = $cres['ctype'];
    		$day = $cres['day'];
    		$stime = $cres['stime'];
    		$etime = $cres['etime'];
    		$level = $cres['level'];
    		$pid = $cres['pid'];
    		$lid = $cres['lid'];
    		$gid = $cres['gid'];?>
    <div id="updateCourse-modal">
    	<div class="addCourse-modal-data">
    		<form action="crud.php" method="POST">
    			<div class="modalTitle">
    				<h2>Add Course</h2>
    			</div>
    			<div class="modalContent">
    				<div class="modalData">
    					<label>Course Code</label>
    					<select name="code">
    						<option value="<?php echo $code; ?>"><?php echo $code; ?></option>
    						<option value="BGEC101">BGEC101</option>
    						<option value="BGEC102">BGEC102</option>
    						<option value="BGEC103">BGEC103</option>
    						<option value="BGEC104">BGEC104</option>
    						<option value="BGEC105">BGEC105</option>
    						<option value="BGEC105">BGEC106</option>
    						<option value="BCPC118">BCPC101</option>
    						<option value="BCPC119">BCPC102</option>
    						<option value="BCPC220">BCPC203</option>
    						<option value="BCPC221">BCPC204</option>
    						<option value="BCPC322">BCPC305</option>
    						<option value="BCPC323">BCPC306</option>
    						<option value="BCPC424">BCPC407</option>
    						<option value="BCPC425">BCPC408</option>
    						<option value="BMKT101">BMKT101</option>
    						<option value="BMKT102">BMKT102</option>
    						<option value="BMKT201">BMKT201</option>
    						<option value="BMKT202">BMKT202</option>
    						<option value="BMKT301">BMKT301</option>
    						<option value="BMKT302">BMKT302</option>
    						<option value="BMKT401">BMKT401</option>
    						<option value="BMKT402">BMKT402</option>
    						<option value="BBAF101">BBAF101</option>
    						<option value="BBAF102">BBAF102</option>
    						<option value="BBAF201">BBAF201</option>
    						<option value="BBAF202">BBAF202</option>
    						<option value="BBAF301">BBAF301</option>
    						<option value="BBAF302">BBAF302</option>
    						<option value="BBAF401">BBAF401</option>
    						<option value="BBAF402">BBAF402</option>
    						<option value="BITM101">BITM101</option>
    						<option value="BITM102">BITM102</option>
    						<option value="BITM201">BITM201</option>
    						<option value="BITM202">BITM202</option>
    						<option value="BITM301">BITM301</option>
    						<option value="BITM302">BITM302</option>
    						<option value="BITM401">BITM401</option>
    						<option value="BITM402">BITM402</option>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Course Name</label>
    					<input type="text" name="cname" value="<?php echo $name; ?>">
    				</div>
    				<div class="modalData">
    					<label>Course Type</label>
    					<select name="ctype">
    						<option value="<?php echo $type; ?>">
    							<?php if ($type == 1) {
    								echo "General";
    							} elseif ($type == 2) {
    								echo "Common";
    							}else{
    								echo "Elective";
    							} ?>
    						</option>
    						<option value="1">General</option>
    						<option value="2">Common</option>
    						<option value="3">Elective</option>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Day</label>
    					<select name="day">
    						<option value="<?php echo $day; ?>">
    							<?php if ($day == 1) {
    								echo "Sunday";
    							} elseif ($day == 2) {
    								echo "Monday";
    							} elseif ($day == 3) {
    								echo "Tuesday";
    							} elseif ($day == 4) {
    								echo "Wednesday";
    							} elseif ($day == 5) {
    								echo "Thursday";
    							} elseif ($day == 6) {
    								echo "Friday";
    							}else{
    								echo "Saturday";
    							} ?>
    						</option>
    						<option value="1">Sunday</option>
    						<option value="2">Monday</option>
    						<option value="3">Tuesday</option>
    						<option value="4">Wednesday</option>
    						<option value="5">Thursday</option>
    						<option value="6">Friday</option>
    						<option value="7">Saturday</option>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Start Time</label>
    					<input type="time" name="stime" value="<?php echo $stime; ?>">
    				</div>
    				<div class="modalData">
    					<label>End Time</label>
    					<input type="time" name="etime" value="<?php echo $etime; ?>">
    				</div>
    				<div class="modalData">
    					<label>Level</label>
    					<select name="level">
    						<option value="<?php echo $level; ?>"><?php echo $level; ?></option>
    						<option value="100">100</option>
    						<option value="200">200</option>
    						<option value="300">300</option>
    						<option value="400">400</option>
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
    					<label>Lecturer</label>
    					<select name="lecturer">
    						<option value="<?php echo $lid; ?>">
    							<?php
    								$lecQuery = mysqli_query($connect, "SELECT * FROM lecturer WHERE lid = '$lid'");
    								$lecRes = mysqli_fetch_array($lecQuery);
    								echo $lecRes['title'].". ".$lecRes['firstname']." ".$lecRes['lastname'];
    							?>
    						</option>
    						<?php
    							$lecQuery = mysqli_query($connect, "SELECT * FROM lecturer");
    							while ($lecRes = mysqli_fetch_array($lecQuery)) {
    								$lid = $lecRes['lid'];
    								$fname = $lecRes['firstname'];
    								$lname = $lecRes['lastname']; ?>
    							<option value="<?php echo $lid;?>"><?php echo $fname." ".$lname;?></option>
    						<?php } ?>
    					</select>
    				</div>
    				<div class="modatBtn">
    					<input type="hidden" name="id" value="<?php echo $cid;?>">
    					<input type="submit" name="updatecourse" value="Update Course" class="btn">
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
    <?php	}else{ ?>

    <div id="addCourse-modal">
    	<div class="addCourse-modal-data">
    		<form action="crud.php" method="POST">
    			<div class="modalTitle">
    				<h2>Add Course</h2>
    			</div>
    			<div class="modalContent">
    				<div class="modalData">
    					<label>Course Code</label>
    					<select name="code">
    						<option></option>
    						<option value="BGEC101">BGEC101</option>
    						<option value="BGEC102">BGEC102</option>
    						<option value="BGEC103">BGEC103</option>
    						<option value="BGEC104">BGEC104</option>
    						<option value="BGEC105">BGEC105</option>
    						<option value="BGEC105">BGEC106</option>
    						<option value="BCPC118">BCPC101</option>
    						<option value="BCPC119">BCPC102</option>
    						<option value="BCPC220">BCPC203</option>
    						<option value="BCPC221">BCPC204</option>
    						<option value="BCPC322">BCPC305</option>
    						<option value="BCPC323">BCPC306</option>
    						<option value="BCPC424">BCPC407</option>
    						<option value="BCPC425">BCPC408</option>
    						<option value="BMKT101">BMKT101</option>
    						<option value="BMKT102">BMKT102</option>
    						<option value="BMKT201">BMKT201</option>
    						<option value="BMKT202">BMKT202</option>
    						<option value="BMKT301">BMKT301</option>
    						<option value="BMKT302">BMKT302</option>
    						<option value="BMKT401">BMKT401</option>
    						<option value="BMKT402">BMKT402</option>
    						<option value="BBAF101">BBAF101</option>
    						<option value="BBAF102">BBAF102</option>
    						<option value="BBAF201">BBAF201</option>
    						<option value="BBAF202">BBAF202</option>
    						<option value="BBAF301">BBAF301</option>
    						<option value="BBAF302">BBAF302</option>
    						<option value="BBAF401">BBAF401</option>
    						<option value="BBAF402">BBAF402</option>
    						<option value="BITM101">BITM101</option>
    						<option value="BITM102">BITM102</option>
    						<option value="BITM201">BITM201</option>
    						<option value="BITM202">BITM202</option>
    						<option value="BITM301">BITM301</option>
    						<option value="BITM302">BITM302</option>
    						<option value="BITM401">BITM401</option>
    						<option value="BITM402">BITM402</option>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Course Name</label>
    					<input type="text" name="cname" placeholder="Intoduction to French">
    				</div>
    				<div class="modalData">
    					<label>Course Type</label>
    					<select name="ctype">
    						<option></option>
    						<option value="1">General</option>
    						<option value="2">Common</option>
    						<option value="3">Elective</option>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Day</label>
    					<select name="day">
    						<option></option>
    						<option value="1">Sunday</option>
    						<option value="2">Monday</option>
    						<option value="3">Tuesday</option>
    						<option value="4">Wednesday</option>
    						<option value="5">Thursday</option>
    						<option value="6">Friday</option>
    						<option value="7">Saturday</option>
    					</select>
    				</div>
    				<div class="modalData">
    					<label>Start Time</label>
    					<input type="time" name="stime" placeholder="Intoduction to French">
    				</div>
    				<div class="modalData">
    					<label>End Time</label>
    					<input type="time" name="etime" placeholder="Intoduction to French">
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
    					<label>Lecturer</label>
    					<select name="lecturer">
    						<option></option>
    						<?php
    							$lecQuery = mysqli_query($connect, "SELECT * FROM lecturer");
    							while ($lecRes = mysqli_fetch_array($lecQuery)) {
    								$lid = $lecRes['lid'];
    								$fname = $lecRes['firstname'];
    								$lname = $lecRes['lastname']; ?>
    							<option value="<?php echo $lid;?>"><?php echo $fname." ".$lname;?></option>
    						<?php } ?>
    					</select>
    				</div>
    				<div class="modatBtn">
    					<input type="submit" name="addCourse" value="Add Course" class="btn">
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php } ?>
<script>
// Function to open the modal
function openAddForm() {
  document.getElementById('addCourse-modal').style.display = 'block';
}

// Close the modal when clicking outside of it
window.onclick = function(event) {
  var modal = document.getElementById('addCourse-modal');
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>