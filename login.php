<?php
	
	include 'database/dbconnect.php';

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
	<title>UPSA STUDENT ATTENDANCE SYSTEM - HOME</title>
</head>
<body>

	<div id="center-items">
		<div class="login-box">
			<div class="login-heading">
				<h1>Student Login</h1>
			</div>
			<?php 
				if (isset($_SESSION['error'])) { ?>
					<p class="errormsg"><?php echo $_SESSION['error']; ?></p>
			<?php unset($_SESSION['error']); } ?>
			<div class="login-body">
				<form method="POST" action="crud.php">
					<div class="login-data">
						<label>Student Email</label>
						<input type="email" class="input-field" name="semail" placeholder="Email" required>
					</div>
					<div class="login-data">
						<label>Password</label>
						<input type="password" class="input-field" name="pass" placeholder="Password" required>
					</div>
					<div class="login-data-btn">
						<button type="submit" class="login-button" name="login">Login</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>