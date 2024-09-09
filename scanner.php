<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>QR Code Scanner</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div id="scanner">
        <div id="qr-reader"></div>
        <a href="login.php" class="result"><div id="qr-reader-results"></div></a>
    </div>

    <script src="https://unpkg.com/html5-qrcode"></script>

    <script>
        var resultContainer = document.getElementById('qr-reader-results');
        var lastResult, countResults = 0;

        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                // Handle on success condition with the decoded message.
                // Display the result in the target div instead of the console.
                resultContainer.innerHTML = "" + decodedText;
            }
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "qr-reader", { fps: 10, qrbox: 250 });

        html5QrcodeScanner.render(onScanSuccess);
    </script>
</body>
</html>
