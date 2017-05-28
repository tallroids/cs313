<?php 
session_start();
?>
<?php include "modules/header.php"; 
if(isset($message)){ echo "<h2>{$message}</h2>"; } ?>

<form action="index.php" method="POST">
	<input type="hidden" name="action" value="register">
	<p>First Name</p>
	<input type="text" name="fname">
	<p>Last Name</p>
	<input type="text" name="lname">
	<p>Username</p>
	<input type="text" name="username">
	<p>Password</p>
	<input type="password" name="password">
	<p>Confirm Password</p>
	<input type="password" name="confPassword">
	<button type="submit">Submit</button>
</form>

<?php include "modules/footer.php"; ?>
