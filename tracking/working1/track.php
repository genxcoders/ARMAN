<?php require_once( '../couch/cms.php' ); ?>
<cms:template title='Tracking' clonable='1' parent="_track_" order="1" >
	<cms:editable name='userid' label='User Id' type='relation' has='one' masterpage='users/index.php'  required='1' order='1' />
	<cms:editable name='user_latitude' label='Latitude' type='text' required="1" order='2' />
	<cms:editable name='user_longitude' label='Longitude' type='text' required="1" order='3' />
	<cms:editable name='status' label='Status' type='text' order='4' />
	<cms:editable name='sosid' label='SOS Id' type='relation' has='one' masterpage='select-sos.php' required="1" order='5' />
</cms:template>
<cms:set userid="<cms:gpc 'userid' method='get' />" scope='global' />
<cms:set user_latitude="<cms:gpc 'user_latitude' method='get' />" scope='global' />
<cms:set user_longitude="<cms:gpc 'user_longitude' method='get' />" scope='global' />
<cms:set sosid="<cms:gpc 'sosid' method='get' />" scope='global' />
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Google Maps Multiple Marker(Pins) Javascript - Tutsmake.com</title>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
		<style type="text/css">
			#map {
				height: 400px;
				/* The height is 400 pixels */
				width: 100%;
				/* The width is the width of the web page */
			}
		</style>
	</head>
	<body>
		<div id="map"></div>
		
		<cms:pages masterpage='select-sos.php' rt_id=k_page_id limit='1' >
			<cms:related_pages 'send_sos'>
				<cms:set latitude="<cms:show sos_lati />" scope="global" />
				<cms:set longitude="<cms:show sos_longi />" scope="global" />
			</cms:related_pages>
		</cms:pages>

		DATA:
		<br>
		<table>
			<thead>
				<tr>
					<td>
						Page Title
					</td>
					<td>
						User Id
					</td>
					<td>
						User Latitude
					</td>
					<td>
						User Longitude
					</td>
					<td>
						SOS ID
					</td>
				</tr>
			</thead>
			<tbody>
				<cms:pages masterpage=k_template_name show_future_entries='1'>
				<tr>
					<td>
						<cms:show k_page_title />
					</td>
					<td>
						<cms:related_pages 'userid'>
							<cms:show ipt_emp_fname /> <cms:show ipt_emp_lname />
						</cms:related_pages>
					</td>
					<td>
						<cms:show user_latitude />
					</td>
					<td>
						<cms:show user_longitude />
					</td>
					<td>
						<cms:related_pages 'sosid'>
							<cms:show k_page_title />::[<cms:show k_page_id />]
						</cms:related_pages>
					</td>
				</tr>
				</cms:pages>
			</tbody>
		</table>

		<script>
	        var map;
	        var InforObj = [];
	        var uluru = {
	            lat: <cms:show latitude />,
	            lng: <cms:show longitude />
	        };

	        var iconBase =
            '<cms:show k_site_link />tracking/';

			var icons = {
				info: {
					icon: iconBase + 'user.png'
				}
			};


	        var markersOnMap = [
	        	<cms:pages masterpage='tracking/track.php'>
	        	{
	                placeName: "<cms:related_pages 'userid'><cms:show ipt_emp_fname /> <cms:show ipt_emp_lname /></cms:related_pages>",
	                type: 'info',
	                LatLng: [{
	                    lat: <cms:show user_latitude />,
	                    lng: <cms:show user_longitude />
	                }]
	            }<cms:if "<cms:not k_paginated_bottom />">,</cms:if>
	        	</cms:pages>
	        ];

	 
	        window.onload = function () {
	            initMap();
	        };
	 
	        function addMarkerInfo() {
	            for (var i = 0; i < markersOnMap.length; i++) {
	                var contentString = '<div id="content"><strong>' + markersOnMap[i].placeName +
	                    '</strong><p></p></div>';
	 
	                const marker = new google.maps.Marker({
	                    position: markersOnMap[i].LatLng[0],
	                    icon: icons[markersOnMap[i].type].icon,
	                    map: map
	                });
	 
	                const infowindow = new google.maps.InfoWindow({
	                    content: contentString,
	                    maxWidth: 200
	                });
	 
	                marker.addListener('click', function () {
	                    closeOtherInfo();
	                    infowindow.open(marker.get('map'), marker);
	                    InforObj[0] = infowindow;
	                });
	                marker.addListener('mouseover', function () {
	                    closeOtherInfo();
	                    infowindow.open(marker.get('map'), marker);
	                    InforObj[0] = infowindow;
	                });
	                marker.addListener('mouseout', function () {
	                    closeOtherInfo();
	                    infowindow.close();
	                    InforObj[0] = infowindow;
	                });
	            }
	        }
	 
	        function closeOtherInfo() {
	            if (InforObj.length > 0) {
	                /* detach the info-window from the marker ... undocumented in the API docs */
	                InforObj[0].set("marker", null);
	                /* and close it */
	                InforObj[0].close();
	                /* blank the array */
	                InforObj.length = 0;
	            }
	        }
	 		


	        
	        function initMap() {
	            map = new google.maps.Map(document.getElementById('map'), {
	                zoom: 10,
	                center: uluru
	            });
	            var marker = new google.maps.Marker({position: uluru, map: map});
	            addMarkerInfo();
	        }

	  //       setInterval(function(){
	  //       	addMarkerInfo();
			// }, 5000);
	    </script>


		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<cms:get_custom_field 'map_api' masterpage='globals.php' />"></script>
		
	</body>
</html>


<?php COUCH::invoke(); ?>