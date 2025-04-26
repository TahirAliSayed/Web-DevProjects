<?php
include("Head.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Location Map</title>

<!-- Correctly load the Google Maps API -->
<script defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDemjDyY3Nn3pBOy3hc8BZtzbpoXTa7sf0&callback=initMap"></script>

<div id="map" style="
    width: 50%; 
    height: 350px; 
    border: 2px solid #333; 
    border-radius: 10px; 
    margin: 30px auto; 
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
    display: flex; 
    justify-content: center; 
    align-items: center;">
</div>


</head>
<body>

<h2 align="center">Users Location</h2>
<div id="map"></div>

<!-- Hidden Fields to Store Coordinates -->


<script>
  let map, marker;

  function initMap() {
    const defaultLocation = { lat: 18.921984, lng: 72.833705 }; 

    map = new google.maps.Map(document.getElementById("map"), {
      center: defaultLocation,
      zoom: 14,
    });

    marker = new google.maps.Marker({
      position: defaultLocation,
      map: map,
      draggable: true,
    });

    // Try to fetch user's current location
    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
        function (position) {
          const userLocation = {
            lat: position.coords.latitude,
            lng: position.coords.longitude,
          };

          // Update map and marker
          map.setCenter(userLocation);
          marker.setPosition(userLocation);

          // Update hidden form fields
          document.getElementById("latitude").value = userLocation.lat;
          document.getElementById("longitude").value = userLocation.lng;
        },
        function () {
          alert("Location access denied!.");
        }
      );
    } else {
      alert("Geolocation is not supported by this browser.");
    }

    // Update hidden fields when marker is dragged
    marker.addListener("dragend", function () {
      document.getElementById("latitude").value = marker.getPosition().lat();
      document.getElementById("longitude").value = marker.getPosition().lng();
    });

    // Set default values in form
    document.getElementById("latitude").value = defaultLocation.lat;
    document.getElementById("longitude").value = defaultLocation.lng;
  }
</script>

<?php include("Foot.php"); ?>
</body>
</html>
