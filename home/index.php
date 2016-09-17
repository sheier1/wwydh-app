<?php

?>
<!DOCTYPE html>
<html>
    <head>
        <script>
              function initMap() {
                var myLatLng = {lat: -25.363, lng: 131.044};

                // Create a map object and specify the DOM element for display.
                var map = new google.maps.Map(document.getElementById('map'), {
                  center: myLatLng,
                  scrollwheel: false,
                  zoom: 4
                });

                // Create a marker and set its position.
                var marker = new google.maps.Marker({
                  map: map,
                  position: myLatLng,
                  title: 'Hello World!'
                });
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
