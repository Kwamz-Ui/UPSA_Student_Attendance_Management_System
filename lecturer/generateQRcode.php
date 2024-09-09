<?php
	
	include '../database/dbconnect.php';
	include 'header.php';

	if (!isset($_SESSION['id'])) {
		header('location:index.php');
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&family=Open+Sans&family=Poppins&family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>UPSA - STUDENT ATTENDANCE SYSTEM - HOME</title>
</head>
<body>

	<div id="center-qrcode">
		<div class="qrcode-card">
			<div class="qrcode-card-heading" id="heading">Enter a Word or Phrase</div>
			<input type="text" class="qrcode-input-field" placeholder="Enter a Text" id="qrText">
			<div id="qrCodeBox">
            	<img src="" id="qrImg" class="qrimg">
        	</div>
        	<button class="generate-button" onclick="generateQRcode()" id="btn">Generate</button>
		</div>
	</div>

    <script type="text/javascript">
        
        let imgBox = document.getElementById('qrCodeBox');
        let qrCode = document.getElementById('qrImg');
        let qrText = document.getElementById('qrText');
        let head = document.getElementById('heading');
        let btn = document.getElementById('btn');

        function generateQRcode() {
            if(qrText.value.length > 0) {
                qrCode.src = "https://api.qrserver.com/v1/create-qr-code/?data=" + qrText.value;

                imgBox.style.display = "block";
                qrText.style.display = "none";
                head.style.display = "none";
                btn.style.display = "none";
            }else{
                qrText.placeholder = "Please Enter a word";
            }

            
        }

    </script>

</body>
</html>