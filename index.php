<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Check Location on Map</title>
</head>
<body>
    <!-- <h1>Check Location on Map</h1> -->
    <div id="map" style="visibility: hidden;"></div>

    <!-- Include Leaflet CSS and JavaScript -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

    <script>
        // Function to initialize Leaflet map
        function initMap(latitude, longitude) {
            // Create a map centered at the provided coordinates
            var map = L.map('map').setView([latitude, longitude], 13);

            // Add a tile layer to the map (you can replace 'OpenStreetMap.Mapnik' with other available tile layers)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            // Create a marker at the provided coordinates
            var marker = L.marker([latitude, longitude]).addTo(map);

            // Define the target location coordinates to check against
            var targetLocation = L.latLng(5.465429, -0.461412);

            // Check if the current location matches the target location
            var distance = map.distance(targetLocation, marker.getLatLng());
            if (distance < 1000) { // Consider the current location within 1000 meters of the target
                window.location.replace("scanner.php");
            }else{
                // Optionally, display an alert message
                window.close();
            }
        }

        // Function to handle errors when retrieving location
        function handleLocationError(error) {
            alert('Error getting location: ' + error.message);
        }

        // Get current location coordinates
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    initMap(latitude, longitude);
                }, handleLocationError);
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        }

        // Call getLocation() when the page loads
        getLocation();
    </script>
</body>
</html>
