<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>SQL demonstration</title>
	<?php include "head.php"
    ?>
</head>

<body class="container">
	<div id="body">
		<div class="row">
			<div class="col-md-12" id="header">
				<h2 id="title">Submit Scripture Topic</h2>
			</div>
		</div>
		<div class="row" id="center">
			<div class="col-md-4" id="center-middle">


				<form action='submit.php' method="post">
					<input type="text" name="book" placeholder="Book"><br>
					<input type="text" name="chapter" placeholder="Chapter"><br>
					<input type="text" name="verse" placeholder="Verse"><br>
					<input type="text" name="content" placeholder="Content"><br>
					<?php
							$dbconn = pg_connect("dbname=scripture user=postgres password=taLLr0ids*");
						if (!$dbconn){
							echo "An error occurred.\n";
							exit;
						}

						$result = pg_query($dbconn, "SELECT book, chapter, verse, content FROM scripture");
						if (!$result) {
							echo "An error occurred.\n";
							exit;
						}
						
						$categories = pg_query($dbconn, "SELECT id, name FROM topics");
						if (!$result) {
							echo "An error occurred.\n";
							exit;
						}
						while ($row = pg_fetch_row($categories)) {
						echo "<input type='checkbox' name='topics' value='$row[0]' id='$row[0]'><label for='$row[0]'>$row[1]</label><br>";
    				}
					?>
						<input type="submit">
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" id="footer"></div>
		</div>
	</div>
</body>

</html>
