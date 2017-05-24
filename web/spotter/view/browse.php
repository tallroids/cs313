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
		<h2>Browse</h2>
		<form action="index.php" method="post">
			<input type="hidden" action="index.php" method="post">
			<ul>
				<?php
				foreach($locations as $location){
				echo '<li><h3><a href="index.php?action=viewLocation&id='.$location['id'].'&location='.urlencode($location['title']).'">'.($location['title']).'</a></h3> <p>'.$location['description'].'</p></li>';
			}
			?>
			</ul>
		</form>
	</main>
	<?php include "modules/footer.php"; ?>
