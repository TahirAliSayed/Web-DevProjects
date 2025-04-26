<?php
include("SessionValidator.php");
include("../Assets/Connection/Connection.php");

if (isset($_GET["ch"])) {
    $_SESSION["ch"] = $_GET["ch"];
    $_SESSION["mail"] = $_GET["mail"];
    header("Location:SendRequest.php");
}

if(isset($_POST["btnsend"]))
{

        $complaint=$_POST["txtdetails"];






                $insqry="insert into tbl_request(request_details,request_date,workshop_id,user_id)values('".$complaint."',curdate(),'".$_SESSION["ch"]."','".$_SESSION["uid"]."')";
                if($conn->query($insqry))
                {

                ?>
                    <script>
                    alert("Success..")
                    location.href="ViewRequest.php";
                    </script>
                    <?php


                 }
}

include("Head.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Send Request</title>
<script 
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDemjDyY3Nn3pBOy3hc8BZtzbpoXTa7sf0&callback=initMap" 
  defer>
</script>
<style>
  #map {
    width: 100%;
    height: 300px;
    border: 1px solid #ccc;
    margin-top: 10px;
  }
</style>
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
          alert("Location access denied! Using default location (Mazgaon, Mumbai).");
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
</head>

<body>
<div id="tab" align="center">
  <h2>Request</h2>
  <form id="form1" name="form1" method="post" action="">
    <table border="1" cellpadding="5" cellspacing="0">
      <tr align="center">
        <td>Details</td>
        <td><textarea name="txtdetails" id="txtdetails" cols="45" rows="5"></textarea></td>
      </tr>
      <tr align="center">
        <td>Location</td>
        <td>
          <div id="map"></div>
          <input type="hidden" name="latitude" id="latitude">
          <input type="hidden" name="longitude" id="longitude">
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <input type="submit" name="btnsend" id="btnsend" value="Submit" />
          <input type="reset" name="btncancel" id="btncancel" value="Cancel" />
        </td>
      </tr>
    </table>
  </form>
</div>
</body>

<?php include("Foot.php"); ?>
</html>
