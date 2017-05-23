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
} else if($action == 'showBrowse'){
	$getPublicLocations->execute();
	$locations = $getPublicLocations->fetchAll();
	include 'view/browse.php';
} else if($action == 'showSubmit'){
	include 'view/submit.php';
} else {
	include 'view/login.php';
	session_destroy();
	die();
}

?>
