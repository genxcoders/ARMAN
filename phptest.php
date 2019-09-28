<?php require_once( 'couch/cms.php' ); ?>
<cms:template title="Google Map Test" parent="_test_" />
<!-- Google Map API Key: AIzaSyALgy0eXowx6-fKyDWdfaqYiZPjE6Aue-8 -->
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <title>Google Maps JavaScript API v3 Example: Map Geolocation</title>
        <link href="http://code.google.com/apis/maps/documentation/javascript/examples/default.css" rel="stylesheet" type="text/css" />
        <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        position: absolute;
        top: 5px;
        left: 50%;
        margin-left: -180px;
        width: 350px;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
      }
      #latlng {
        width: 225px;
      }
    </style>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyALgy0eXowx6-fKyDWdfaqYiZPjE6Aue-8&sensor=true"></script>
        <script type="text/javascript" src="http://code.google.com/apis/gears/gears_init.js"></script>
        <cms:pages masterpage='generate-sos.php'>
        <script type="text/javascript">
            var initialLocation;
            var india = new google.maps.LatLng(20.5937, 78.9629);
            var nagpur = new google.maps.LatLng(21.1458, 79.0882);
            var browserSupportFlag =  new Boolean();



            function initialize() {
                var myOptions = {
                    zoom: 6,
                    mapTypeId: google.maps.MapTypeId.HYBRID
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                myListener = google.maps.event.addListener(map, 'click', function(event) {
                    placeMarker(event.latLng);
                    google.maps.event.removeListener(myListener);
                });
                google.maps.event.addListener(map, 'drag', function(event) {
                    placeMarker(event.latLng);
                    google.maps.event.removeListener(myListener);
                });

                // Try W3C Geolocation (Preferred)
                if(navigator.geolocation) {
                    browserSupportFlag = true;
                    navigator.geolocation.getCurrentPosition(function(position) {
                        initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
                        map.setCenter(initialLocation);
                    }, function() {
                        handleNoGeolocation(browserSupportFlag);
                    });
                    // Try Google Gears Geolocation
                } else if (google.gears) {
                    browserSupportFlag = true;
                    var geo = google.gears.factory.create('beta.geolocation');
                    geo.getCurrentPosition(function(position) {
                        initialLocation = new google.maps.LatLng(position.latitude,position.longitude);
                        map.setCenter(initialLocation);
                    }, function() {
                        handleNoGeoLocation(browserSupportFlag);
                    });
                    // Browser doesn't support Geolocation
                } else {
                    browserSupportFlag = false;
                    handleNoGeolocation(browserSupportFlag);
                }
              
              //alert(initialLocation);

                function handleNoGeolocation(errorFlag) {
                    if (errorFlag === true) {
                        alert("Geolocation service failed.");
                        initialLocation = newyork;
                    } else {
                        alert("Your browser doesn't support geolocation. We've placed you in Siberia.");
                        initialLocation = siberia;
                    }
                }

                function placeMarker(location) {
                    var marker = new google.maps.Marker({
                        position: location,
                        map: map,
                        draggable: true
                    });
                    map.setCenter(location);
                    var markerPosition = marker.getPosition();
                    populateInputs(markerPosition);
                    google.maps.event.addListener(marker, "drag", function (mEvent) {
                        populateInputs(mEvent.latLng);
                    });
                }
                function populateInputs(pos) {
                    document.getElementById("t1").value=pos.lat()
                    document.getElementById("t2").value=pos.lng();
                }
            }

        </script>
        </cms:pages>
    </head>
    <body onload="initialize()">
        <div id="map_canvas" style="width: 500px; height: 500px"></div>
        <input type="text" id="t1" name="t1" />
        <input type="text" id="t2" name="t2" />
    </body>
</html>
<?php COUCH::invoke( K_IGNORE_CONTEXT ); ?>