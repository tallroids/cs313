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

  $getPublicLocations = $db->prepare('SELECT id, title, description, categoryId FROM locations WHERE isPublic = true;');

  $getYourLocations = $db->prepare('SELECT id, title, description FROM locations WHERE authorId = :userId;');
  
  $getFavoriteLocations = $db->prepare('SELECT DISTINCT * FROM favorites JOIN locations ON locations.id = favorites.locationId where userId = :id;');
  
  $getCategories = $db->prepare('SELECT * FROM categories');
  
  $addLocation = $db->prepare('INSERT INTO locations(title, description, lat, lon, authorId, categoryId, isPublic) VALUES (:title, :description, :lat, :lon, :author, :category, :isPublic);');

  $getLocationById = $db->prepare('SELECT * FROM locations WHERE id = :id;');

  $saveLocation = $db->prepare('INSERT INTO favorites (userId, locationId) values (:userId, :locationId);');
  
  $getAuthor = $db->prepare('SELECT authorId FROM locations WHERE id = :locationId;');
  
  $updateLocation = $db->prepare('UPDATE locations SET (title, description, isPublic, categoryId) = (:title, :description, :isPublic, :categoryId) WHERE id=:locationId;');
  
  $checkIsSaved = $db->prepare('SELECT COUNT(*) FROM favorites WHERE userid=:userId AND locationId=:locationId;');

  $removeLocation = $db->prepare('DELETE FROM favorites WHERE locationId = :locationId AND userId = :userId;');

  $register = $db->prepare('INSERT INTO users (fname, lname, username, password) VALUES (:fname, :lname, :username, :password);');
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}


?>