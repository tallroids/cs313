<?php

// default Heroku Postgres configuration URL
$dbUrl = getenv('DATABASE_URL');

if (empty($dbUrl)) {
 // example localhost configuration URL with postgres username and a database called cs313db
 $dbUrl = "postgres://postgres:taLLr0ids@localhost:5433/spotter";
}
$dbopts = parse_url($dbUrl);
$dbHost = $dbopts["host"];
$dbPort = $dbopts["port"];
$dbUser = $dbopts["user"];
$dbPassword = $dbopts["pass"];
$dbName = ltrim($dbopts["path"],'/');

try
{
	$db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);
  
    $getPass = $db->prepare('SELECT password FROM users WHERE username = :username;');
	$getPass->bindParam(':username', $username);
	
	$getUserId = $db->prepare('SELECT id FROM users WHERE username = :username;');
	$getUserId->bindParam(':username', $username);
  
	$getPublicLocations = $db->prepare('SELECT id, title, description FROM locations WHERE isPublic = true;');
  
	$getFavoriteLocations = $db->prepare('select distinct * from favorites join locations on locations.id = favorites.locationId where userId = :id;');
	
	$addLocation = $db->prepare('INSERT INTO locations(title, description, lat, lon, isPublic) values (:title, :description, :lat, :lon, :isPublic);');
	$addLocation->bindParam(':title', $title);
	$addLocation->bindParam(':description', $description);
	$addLocation->bindParam(':lat', $lat);
	$addLocation->bindParam(':lon', $lon);
	$addLocation->bindParam(':isPublic', $isPublic);
	
	$getLocationById = $db->prepare('SELECT * FROM locations WHERE id = :id;');
	
	$saveLocation = $db->prepare('INSERT INTO favorites (userId, locationId) values (:userId, :locationId);');
	
    $checkIsSaved = $db->prepare('SELECT COUNT(locationId = :locationId AND userId = :userId) from favorites;');
    
    $removeLocation = $db->prepare('DELETE FROM favorites WHERE locationId = :locationId AND userId = :userId;');
    
	$register = $db->prepare('INSERT INTO users (fname, lname, username, password) values (:fname, :lname, :username, :password);');
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}


?>