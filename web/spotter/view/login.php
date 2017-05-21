<?php 
session_start();
?>
<?php include "modules/header.php"; 
if(isset($message)){ echo "<h2>{$message}</h2>"; } ?>

<form action="index.php" method="POST">
	<input type="hidden" name="action" value="login">
	<p>Username</p>
	<input type="text" name="username">
	<p>Password</p>
	<input type="password" name="password">

	<button type="submit">Submit</button>
</form>

<?php include "modules/footer.php"; ?>
