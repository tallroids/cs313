<?php
session_start();
    if(!isset($_SESSION['username'])){
			header("Location: ../index.php");
			session_destroy();
			die();
    }else{
			$thisPage = "submit"; 
			include "modules/header.php";
}

?>
	<main>
		<?php
			if(isset($message)){ echo "<h2 class='message'>{$message}</h2>"; } 
		?>
			<h2>Submit a Location</h2>
			<div id="map" height="460px" width="100%"></div>
			<div id="form" style="display:none">
				<table>
					<tr>
						<td>Name:</td>
						<td><input type='text' id='name' /> </td>
					</tr>
					<tr>
						<td>Description:</td>
						<td><input type='text' id='description' /> </td>
					</tr>
					<tr>
						<td>Publish Publicly?</td>
						<td><select id='isPublic'> +
                 <option value=true SELECTED>Yes</option>
                 <option value=false>No</option>
                 </select> </td>
					</tr>
					<tr>
						<td></td>
						<td><input type='button' value='Save' onclick='saveData()' /></td>
					</tr>
				</table>
			</div>
			<div id="message" style="display:none">Location saved</div>
			<script>
				var map;
				var marker;
				var infowindow;
				var messagewindow;

				function initMap() {
					var california = {
						lat: 37.4419,
						lng: -122.1419
					};
					map = new google.maps.Map(document.getElementById('map'), {
						center: california,
						zoom: 13
					});

					infowindow = new google.maps.InfoWindow({
						content: document.getElementById('form')
					})

					messagewindow = new google.maps.InfoWindow({
						content: document.getElementById('message')
					});

					google.maps.event.addListener(map, 'click', function(event) {
						marker = new google.maps.Marker({
							position: event.latLng,
							map: map
						});


						google.maps.event.addListener(marker, 'click', function() {
							document.getElementById('form').style = "display: block";
							infowindow.open(map, marker);
						});

					});
				}

				function saveData() {
					var name = escape(document.getElementById('name').value);
					var description = escape(document.getElementById('description').value);
					var isPublic = document.getElementById('isPublic').value;
					var latlng = marker.getPosition();
					var url = 'index.php?action=submit&name=' + name + '&description=' + description +
						'&isPublic=' + isPublic + '&lat=' + latlng.lat() + '&lng=' + latlng.lng();

					downloadUrl(url, function(data, responseCode) {

						if (responseCode == 200 && data.length <= 1) {
							infowindow.close();
							document.getElementById('message').style = "display: block";
							messagewindow.open(map, marker);
						}
					});
				}

				function downloadUrl(url, callback) {
					var request = window.ActiveXObject ?
						new ActiveXObject('Microsoft.XMLHTTP') :
						new XMLHttpRequest;

					request.onreadystatechange = function() {
						if (request.readyState == 4) {
							request.onreadystatechange = doNothing;
							callback(request.responseText, request.status);
						}
					};

					request.open('GET', url, true);
					request.send(null);
				}

				function doNothing() {}

			</script>
			<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5vzxhhGrSlKwQHbetNCtBuGeM2L5dloE&callback=initMap"></script>
	</main>

	<?php include "modules/footer.php"; ?>
