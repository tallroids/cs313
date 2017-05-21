<?php 
session_start();
include 'model/db.php';

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if(!isset($action)){
	$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
if(!isset($action)){
	 if(!isset($_SESSION["user"])){
		 $action = 'showLogin';
	 } else {
		 $action = 'showHome';
	 }
}

if ($action == 'login'){
	$pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	
	if ($pass == "5678"){
    $_SESSION['user'] = $username;
    $action = 'showHome';
	} else {
		$message = 'invalid login';
		include 'view/login.php';
		die();
	}
}
if($action == 'showLogin'){
	include 'view/login.php';
	die();
} else if($action == 'showHome'){
	$locations = $getFavoriteLocations->fetchAll(PDO::FETCH_ASSOC);
	include 'view/home.php';
} else if($action == 'showBrowse'){
	$locations = $getPublicLocations->fetchAll(PDO::FETCH_ASSOC);
	include 'view/browse.php';
} else if($action == 'showSubmit'){
	include 'view/submit.php';
} else {
	include 'view/login.php';
	session_destroy();
	die();
}

?>
