<?php

try
{
  $user = 'postgres';
	$password = 'taLLr0ids*';
	$db = new PDO('pgsql:host=127.0.0.1;port=5432;dbname=spotter', $user, $password);

  $getPublicLocations = $db->query('SELECT title, description, coordinates FROM locations WHERE isPublic = true;');
  $getFavoriteLocations = $db->query('SELECT title, description, coordinates, ispublic FROM locations;');
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}


?>
