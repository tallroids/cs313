<?php
if(!isset($_SESSION)){
session_start();
}
    if(!isset($_SESSION['username'])){
			header("Location: ../");
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
                      <td><input type='text' id='name' required/> </td>
                  </tr>
                  <tr>
                      <td>Description:</td>
                      <td><input type='text' id='description' required/> </td>
                  </tr>
                  <tr>
                      <td>Publish Publicly?</td>
                      <td><select id='isPublic'>
                       <option value=true SELECTED>Yes</option>
                       <option value=false>No</option>
                       </select></td>
                  </tr>
                  <tr>
                    <td>Category:</td>
                    <td><select id="category">
                      <?php
                        foreach($categories as $category){
                        echo "<option value='{$category['id']}'>{$category['title']}</option>";
                      }
                      ?>
                    </select></td>
                  </tr>
					<tr>
						<td></td>
						<td><input type='button' value='Save' onclick='saveData()' /></td>
					</tr>
				</table>
			</div>
      <p>Step 1. Click a point on the map above to add a marker.</p>
      <p>Step 2. Click the marker to add information and save the location.</p>
			<div id="message" style="display:none">Location saved</div>
			<script>
				var map;
				var marker;
				var infowindow;
				var messagewindow;

				function initMap() {
					var usa = {
						lat: 40.834,
						lng: -99.3603
					};
					map = new google.maps.Map(document.getElementById('map'), {
						center: usa,
						zoom: 4
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
                    var category = document.getElementById('category').value;
					var latlng = marker.getPosition();
					var url = 'index.php?action=submit&name=' + name + '&description=' + description +
						'&isPublic=' + isPublic + '&lat=' + latlng.lat() + '&lng=' + latlng.lng() + '&category=' + category;

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
