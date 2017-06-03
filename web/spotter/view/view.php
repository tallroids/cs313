<?php
if(!isset($_SESSION)){
session_start();
}
    if(!isset($_SESSION['username'])){
			header("Location: ../");
			session_destroy();
			die();
    }else{
			$thisPage = "view"; 
			include "modules/header.php";
}

?>
	<main id="view">
		<div class="header">
			<h2>
				<?php echo $location['title']; ?>
			</h2>
            <?php 
                if($isSaved > 0){
			         echo "<a onclick='removeLocation(".$location["id"].")' class='button'>Remove From Favorites</a>";
                } else {
			         echo "<a onclick='saveLocation(".$location["id"].")' class='button'>Save</a>";
    
                }
                if($location['authorid'] == $_SESSION['userId']){
			       echo "<a href='./?action=showEditLocation&locationId={$location["id"]}' class='button'>Edit</a>";
                }
            ?>
		</div>
		<div id="map"></div>
        <h2 class='popup'><?php if(isset($message)){ echo $message; } ?></h2>
		<script>
			function initMap() {
				var uluru = {
					lat: <?php echo $location['lat']; ?>,
					lng: <?php echo $location['lon']; ?>
				};
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 10,
					center: uluru
				});
				var marker = new google.maps.Marker({
					position: uluru,
					map: map
				});
			}

		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5vzxhhGrSlKwQHbetNCtBuGeM2L5dloE&callback=initMap">

		</script>
		<p>
			<?php echo $location['description']; ?>
		</p>
	</main>
	<?php include "modules/footer.php"; ?>
