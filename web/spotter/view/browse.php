<?php
session_start();
    if(!isset($_SESSION['username'])){
			header("Location: ../index.php");
			session_destroy();
			die();
    }else{
			$thisPage = "browse"; 
			include "modules/header.php";
}

?>
	<main>
		<h1>Spotter</h1>
		<h2>Browse</h2>
		<ul>
			<?php
				foreach($locations as $location){
				echo '<li><h3>'.$location['title'].'</h3> <p>'.$location['description'].'</p></li>';
			}
			?>
		</ul>
	</main>
	<?php include "modules/footer.php"; ?>
