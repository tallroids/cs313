<?php
session_start();
    if(!isset($_SESSION['user'])){
			header("Location: ../index.php");
			session_destroy();
			die();
    }else{
			$thisPage = "submit"; 
			include "modules/header.php";
}

//$db = require '../model/db.php';
?>
	<main>
		<h1>Spotter</h1>
		<h2>Submit a Location</h2>
		<form action="../index.php" method="post" id="submit">
			<div>
				<input type="hidden" name="action" value="submit">
			</div>
			<div>
				<label for="title">Title</label><input type="text" name="title" id="title">
			</div>
			<div>
				<label for="description">Description</label><textarea form="submit" name="description" id="description"></textarea>
			</div>
			<div>
				<label for="yes">Yes</label><input type="radio" name="ispublic" value="true" id="yes">
			</div>
			<div>
				<label for="no">No</label><input type="radio" name="ispublic" value="true" id="no">
			</div>
			<div>
				<button type="submit">Submit</button>
			</div>
		</form>
	</main>
	<?php include "modules/footer.php"; ?>
