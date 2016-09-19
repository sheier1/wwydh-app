<?php

    include "../helpers/conn.php";

    // TODO:0 change location select query to count ideas and grab features for each location
    $q = $conn->prepare("SELECT l.* FROM locations l "); // pulls all locations right now, do we want to keep this?
    $q->execute();

    $data = $q->get_result();
    $locations = [];

    while ($row = $data->fetch_array(MYSQLI_ASSOC)) array_push($locations, $row);
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript">
            // convert location data from php to javascript using JSON
            var locations = jQuery.parseJSON('<?php echo str_replace("'", "\'", json_encode($locations)) ?>');

            // TODO:10 implement a way to sort locations array by closest. Thinking a load file that grabs current location (or doesn't) and then calls this page with $_GET vars?

            function initMap() {
                navigator.geolocation.getCurrentPosition(function(location) {
                    var lat = location.coords.latitude;
                    var lng = location.coords.longitude;

                    var myLatLng = {lat: lat, lng: lng};

                    // Create a map object and specify the DOM element for display.
                    var map = new google.maps.Map(document.getElementById('map'), {
                      center: {lat: parseFloat(locations[0].latitude), lng: parseFloat(locations[0].longitude)},
                      scrollwheel: false,
                      zoom: 13
                    });

                    $(locations).each(function() {
                        var marker = new google.maps.Marker({
                            map: map,
                            position: {lat: parseFloat(this.latitude), lng: parseFloat(this.longitude)},
                            address: this.mailing_address
                        });

                        marker.addListener("click", function() {
                            alert(this.address);
                        })
                    })
                })
            }

        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzAMBl8WEWkqExNw16kEk40gCOonhMUmw&callback=initMap" async defer></script>
    </head>
    <body>
        <div id="nav">
            <div id="logo"></div>
            <div id="main_nav"></div>
            <div id="user_nav"></div>
        </div>
        <div id="map" style="height: 500px"></div>
        <div id="explore">
            <div>
                <?php
                foreach($locations as $l) { ?>
                    <div class="location">
                        <div class="location_image"></div>
                        <div class="address"><?php echo $l["address"] ?></div>
                        <div class="features">
                            <span>Features:</span>
                                <ul>
                                    <?php foreach ($locations["features"] as $f) { ?>

                                    <?php } ?>
                                </ul>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
        </div>
        <div id="about"></div>
        <div id="how"></div>
        <div id="contact"></div>
        <div id="footer"></div>
    </body>
</html>
