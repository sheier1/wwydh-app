<?php

    include "../helpers/conn.php";

    $q = $conn->prepare("SELECT * FROM locations"); // change with where clause (select closest 4-10 locations)
    $q->execute();

    $data = $q->get_result();

    $row = $data->fetch_array(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <script type="text/javascript">
            function initMap() {
                navigator.geolocation.getCurrentPosition(function(location) {
                    var lat = location.coords.latitude;
                    var lng = location.coords.longitude;

                    var newLat = parseFloat("<?php echo $row["latitude"] ?>");
                    var newLng = parseFloat("<?php echo $row["longitude"] ?>");

                    var newLat1 = 39.363661;
                    var newLng1 = -76.610457;

                    var myLatLng = {lat: lat, lng: lng};
                    var position = {lat: newLat, lng: newLng};
                    var position2 = {lat: newLat1, lng: newLng1}

                    // Create a map object and specify the DOM element for display.
                    var map = new google.maps.Map(document.getElementById('map'), {
                      center: myLatLng,
                      scrollwheel: false,
                      zoom: 11
                    });

                    var marker = new google.maps.Marker({
                        map: map,
                        position: position
                    });

                    new google.maps.Marker({
                        map: map,
                        position: position2
                    })
                })
            }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzAMBl8WEWkqExNw16kEk40gCOonhMUmw&callback=initMap" async defer></script>
    </head>
    <body>
        <div id="nav"></div>
        <div id="map" style="height: 500px">

        </div>
        <div id="explore"></div>
        <div id="about"></div>
        <div id="how"></div>
        <div id="contact"></div>
        <div id="footer"></div>
    </body>
</html>
