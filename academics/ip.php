<?php
// Function to get the correct IP address of the user's device
function getClientIP() {
    $ipAddress = '';

    // Check if the HTTP_X_FORWARDED_FOR header is set and not empty
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Split the list of IP addresses
        $ips = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);

        // Loop through the list and extract the last non-private IP address
        foreach ($ips as $ip) {
            $ip = trim($ip);
            if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                $ipAddress = $ip;
                break;
            }
        }
    }

    // If HTTP_X_FORWARDED_FOR is not set or empty, use REMOTE_ADDR
    if (empty($ipAddress)) {
        $ipAddress = $_SERVER['REMOTE_ADDR'];
    }

    return $ipAddress;
}

// Get the IP address of the user's device
$ipAddress = getClientIP();

// Display the IP address
echo "Your IP Address: " . $ipAddress;
?>
