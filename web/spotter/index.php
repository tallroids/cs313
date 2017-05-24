<?php 
session_start();

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if(!isset($action)){
	$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
if(!isset($action)){
	 if(!isset($_SESSION["username"])){
		 $action = 'showLogin';
	 } else {
		 $action = 'showHome';
	 }
}

if ($action == 'login'){
	include 'model/db.php';
	$pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	$getPass->execute();
	$password2 = $getPass->fetch();
	if($pass == $password2[0]){
		$_SESSION['username'] = $username;
		$getUserId->execute();
		$userId = $getUserId->fetch();
		$_SESSION['userId'] = $userId[0];
    $action = 'showHome';
	} else{
		$message = 'invalid login';
		include 'view/login.php';
		die();
	}
}

$userId = $_SESSION['userId'];
$username = $_SESSION['username'];
include 'model/db.php';

if($action == 'logout'){
	session_destroy();
	include 'view/login.php';
	die();
}
if($action == 'showLogin'){
	include 'view/login.php';
	die();
} else if($action == 'showHome'){
	$getFavoriteLocations->execute();
	$locations = $getFavoriteLocations->fetchAll();
	include 'view/home.php';
	die();
} else if($action == 'showBrowse'){
	$getPublicLocations->execute();
	$locations = $getPublicLocations->fetchAll();
	include 'view/browse.php';
	die();
} else if($action == 'viewLocation'){
	$locationId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
	$getLocationById->bindParam(':id', $locationId);
	$getLocationById->execute();
	$location = $getLocationById->fetch();
	include 'view/view.php';
	die();
} else if($action == 'saveLocation'){
	$locationId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
	$userId = $_SESSION['userId'];
	$saveLocation->bindParam(':locationId', $locationId);
	$saveLocation->bindParam(':userId', $userId);
	$saveLocation->execute();
	$rowCount = $saveLocation->rowCount();
	if($rowCount == 1){
		$message = "Saved";
	}
	include 'view/view.php';
	die();
} else if($action == 'showSubmit'){
	include 'view/submit.php';
	die();
} else if($action == 'submit'){
	
	$title = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
	$description = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING);
	$isPublic = filter_input(INPUT_GET, 'isPublic', FILTER_VALIDATE_BOOLEAN);
	$lat = filter_input(INPUT_GET, 'lat', FILTER_VALIDATE_FLOAT);
	$lon = filter_input(INPUT_GET, 'lng', FILTER_VALIDATE_FLOAT);
	
	include 'model/db.php';
	$addLocation->execute();
	
	$rowsAffected = $addLocation->rowCount();
	
	if($rowsAffected == 1){
		header("HTTP/10.2.1 200 OK");
	} else {
		header("HTTP/10.4.1 400 Bad Request");
		die();
	}
} else {
	include 'view/login.php';
	session_destroy();
	die();
}

?>
