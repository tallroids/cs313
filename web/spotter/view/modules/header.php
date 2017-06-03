<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="initial-scale=1">
	<link type="text/css" rel="stylesheet" href="view/styles.css">
	<script src="view/scripts.js"></script>
</head>

<body>
	<header>
		<form id="header" action="./" method="POST">
			<button type="submit" name="action" value="showHome" <?php if($thisPage=="home" ) { echo 'class="currPage"'; } ?>>Home</button>
			<button type="submit" name="action" value="showBrowse" <?php if($thisPage=="browse" ) { echo 'class="currPage"'; } ?>>Browse Locations</button>
			<button type="submit" name="action" value="showSubmit" <?php if($thisPage=="submit" ) { echo 'class="currPage"'; } ?>>Submit Location</button>
			<button type="submit" name="action" value="logout" <?php if($thisPage=="logout" ) { echo 'class="currPage"'; } ?>>Logout</button>
		</form>
	</header>
