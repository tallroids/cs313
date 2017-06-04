<?php
if(!isset($_SESSION)){
session_start();
}
    if(!isset($_SESSION['username'])){
			header("Location: ../");
			session_destroy();
			die();
    }else{
			$thisPage = "home"; 
			include "modules/header.php";
}

?>
	<main>
		<?php if(isset($message)){ echo "<h2 class='popup'>{$message}</h2>"; } ?>
		<h2>Favorites</h2>
		<ul>
        <?php
          if($locations[0] == ""){
            echo "<p>You haven't saved any locations yet! Click 'Browse' above to see what people have submitted.</p>";
          } else {
            foreach($locations as $location){
            echo '<li><h3><a href="./?action=viewLocation&id='.$location['id'].'&location='.urlencode($location['title']).'">'.($location['title']).'</a></h3> <p>'.$location['description'].'</p></li>';
          }
            
          }
        ?>
		</ul>
      <h2>Your Locations</h2>
		<ul>
        <?php
          if($yourLocations[0] == ""){
            echo "<p>You have not submitted any locations yet! Click 'Submit Location' above to add your own location.</p>";
          } else {
              foreach($yourLocations as $location){
              echo '<li><h3><a href="./?action=viewLocation&id='.$location['id'].'&location='.urlencode($location['title']).'">'.($location['title']).'</a></h3> <p>'.$location['description'].'</p></li>';
			}
          }
        ?>
		</ul>
	</main>
	<?php include "modules/footer.php"; ?>
