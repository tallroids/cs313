<?php
session_start();
    if(!isset($_SESSION['username'])){
			header("Location: ../index.php");
			session_destroy();
			die();
    }else{
			$thisPage = "home"; 
			include "modules/header.php";
}

?>
	<main>
		<h2>Favorites</h2>
		<ul>
			<?php
				foreach($locations as $location){
				echo '<li><h3><a href="index.php?action=viewLocation&id='.$location['id'].'&location='.urlencode($location['title']).'">'.($location['title']).'</a></h3> <p>'.$location['description'].'</p></li>';
			}
			?>
		</ul>
	</main>
	<?php include "modules/footer.php"; ?>