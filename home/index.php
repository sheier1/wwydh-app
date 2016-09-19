<?php

    include "../helpers/conn.php";

    // BACKEND:0 change homepage location query to ORDER BY RAND() LIMIT 3
    $q = $conn->prepare("SELECT l.*, COUNT(DISTINCT i.id) AS ideas, GROUP_CONCAT(DISTINCT f.feature SEPARATOR '[-]') AS features FROM locations l LEFT JOIN ideas i ON i.location_id = l.id LEFT JOIN location_features f ON f.location_id = l.id GROUP BY l.id LIMIT 3");
    $q->execute();

    $data = $q->get_result();
    $locations = [];

    while ($row = $data->fetch_array(MYSQLI_ASSOC)) {
        if (isset($row["features"])) $row["features"] = explode("[-]", $row["features"]);
        array_push($locations, $row);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzAMBl8WEWkqExNw16kEk40gCOonhMUmw&callback=initMap" async defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script type="text/javascript">
            // convert location data from php to javascript using JSON
            var locations = jQuery.parseJSON('<?php echo str_replace("'", "\'", json_encode($locations)) ?>');

            function initMap() {
                // Create a map object and specify the DOM element for display.
                var map = new google.maps.Map(document.getElementById('map'), {
                  center: {lat: parseFloat(locations[0].latitude), lng: parseFloat(locations[0].longitude)},
                  scrollwheel: false,
                  zoom: 14
                });

                $(locations).each(function() {
                    var marker = new google.maps.Marker({
                        map: map,
                        position: {lat: parseFloat(this.latitude), lng: parseFloat(this.longitude)},
                        address: this.mailing_address
                    });

                    marker.addListener("click", function() {
                        alert(this.address); // FRONTEND:10 change the map marker click listener to trigger location popup
                    })
                })
            }

        </script>
        <style type="text/css">
            .location_image {
                height: 100px;
                width: 100px;
                background-position: center;
                background-size: cover;
                float: left;
            }

            .location {
                width: 100%;
                clear: both;
                margin-bottom: 10px;
                padding-bottom: 10px;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
                overflow: hidden;
            }

            .location:last-child {
                border-bottom-width: 0px;
            }
        </style>
    </head>
    <body>
        <div id="nav">
            <div id="logo"></div>
            <div id="main_nav"></div>
            <div id="user_nav"></div>
        </div>
        <div id="map" style="height: 500px"></div>
        <div id="explore">
            <div id="locations">
                <?php
                foreach($locations as $l) { ?>
                    <div class="location">
                        <?php if ($l["ideas"] > 0) { ?>
                            <div class="ideas_count"><?php echo $l["ideas"] ?></div>
                        <?php } ?>
                        <div class="location_image" style="background-image: url(../helpers/location_images/<?php if (isset($l['image'])) echo $l['image']; else echo "pin.png";?> );"></div>
                        <div class="address"><?php echo $l["mailing_address"] ?></div>
                        <?php if (isset($l["features"])) { ?>
                            <div class="features">
                                <span>Features:</span>
                                    <ul>
                                        <?php foreach ($l["features"] as $f) { ?>
                                            <li><?php echo $f ?></li>
                                        <?php } ?>
                                    </ul>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
                ?>
            </div>
            <div id="projects">

            </div>
        </div>
        <div id="about"></div>
        <div id="how"></div>
        <div id="contact"></div>
        <div id="footer"></div>
    </body>
</html>
