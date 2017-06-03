<?php 
if(!isset($_SESSION)){
    session_start();
}
    $thisPage = 'register';
?>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1">
	<link type="text/css" rel="stylesheet" href="view/styles.css">
	<script src="view/scripts.js"></script>
</head>

<body>
  
<form id="login" action="./" method="POST">
	<input type="hidden" name="action" value="register">
	<p>First Name</p>
	<input type="text" name="fname" required>
	<p>Last Name</p>
	<input type="text" name="lname" required>
	<p>Username</p>
	<input type="text" name="username" required>
	<p>Password (Include 8 characters and a number)</p>
	<input type="password" name="password" onchange="checkPass(this)" id="password" required>
	<p>Confirm Password</p>
	<input type="password" name="confPassword" onchange="checkMatch()" id="confPass" required>
    <p id='passMsg' class='error'><?php if(isset($message)){ echo $message; } ?></p>
	<button type="submit" id="submit">Submit</button>
</form>

<?php include "modules/footer.php"; ?>
