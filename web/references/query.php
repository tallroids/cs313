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
				<h2 id="title">Scripture Resources</h2>
			</div>
		</div>
		<div class="row" id="center">
			<div class="col-md-4" id="center-middle">
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

    while ($row = pg_fetch_row($result)) {
      echo "<span style='font-weight: bold;'>$row[0] $row[1]:$row[2]</span> -  $row[3]";
      echo "<br />\n";
    }

          ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" id="footer"></div>
		</div>
	</div>
</body>

</html>
