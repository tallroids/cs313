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
	<main>
		<div class="header">
			<h2>
				<?php echo $location['title']; ?>
			</h2>
            <a href="./?action=deleteLocation&locationId=<?php echo $location["id"]; ?>" class='button'>Delete</a>
		</div>
		<h2 class='popup'><?php if(isset($message)){ echo $message; } ?></h2>
		<div id="map"></div>
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
      <h2>Edit this location:</h2>
      <form action="./" method="post" id="update">
        <input type="hidden" name="action" value="updateLocation">
        <input type="hidden" name="locationId" value="<?php echo $location['id']; ?>">
        <label for="title">Title</label>
        <input name="title" id="title" type="text" value="<?php echo $location['title']; ?>">
        <label for="description">Description</label>
        <textarea form = "update" name="description" id="description"><?php echo $location['description']; ?></textarea>
        <label for="isPublic">Publish Publicly?</label>
        <select id='isPublic' name="isPublic">
          <option value=true <?php if($location['ispublic'] == true){echo 'SELECTED';}?>>Yes</option>
          <option value=false <?php if($location['ispublic'] == false){echo 'SELECTED';}?>>No</option>
        </select>
        <label for="categoryId">Category</label>
        <select id="categoryId" name="categoryId">
          <?php
            foreach($categories as $category){
            echo "<option value='{$category['id']}'";
            if($location['categoryid'] == $category['id']){echo 'SELECTED';};
            echo ">{$category['title']}</option>";
          }
          ?>
        </select>
        <input type="submit" value="Save">
      </form>
		<form action="index.php" method="post">
			<input type="hidden" name="action" value="">
		</form>
	</main>
	<?php include "modules/footer.php"; ?>
