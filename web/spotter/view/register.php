<?php 
session_start();
?>
<?php include "modules/header.php"; 
if(isset($message)){ echo "<h2>{$message}</h2>"; } ?>
<script>
	function checkPass(ele) {
		var container = document.getElementById('passMsg');
		var msg = "";
		if (!/\d/.test(ele.value)) {
			msg += "Password must contain a number<br>";
		} else {
			msg += "";
		}
		if (ele.value.length < 8) {
			msg += "Password must be at least 8 characters long";
		} else {
			msg += "";
		}
		submit = document.getElementById('submit')
		if (msg == "") {
			submit.disabled = false;
			document.querySelector('.error').setAttribute('style', 'display:none')
		} else {
			submit.disabled = true;
			document.querySelector('.error').setAttribute('style', 'display:inline-block')
		}
		container.innerHTML = msg;
	}

	function confPassword() {
		var 1 = document.getElementById('password').value
	}

</script>
<form action="index.php" method="POST">
	<input type="hidden" name="action" value="register">
	<p>First Name</p>
	<input type="text" name="fname">
	<p>Last Name</p>
	<input type="text" name="lname">
	<p>Username</p>
	<input type="text" name="username">
	<p>Password (must contain at least 8 characters and a number)</p>
	<input type="password" name="password" onchange="checkPass(this)" id="password"><span id="passMsg" class="error"></span>
	<p>Confirm Password</p>
	<input type="password" name="confPassword" onchange="checkMatch" id="confPass">
	<button type="submit" id="submit">Submit</button>
</form>

<?php include "modules/footer.php"; ?>
