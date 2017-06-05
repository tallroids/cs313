<?php 
if(!isset($_SESSION)){
session_start();
}

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if(!isset($action)){
	$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}
if(!isset($action)){
	 if(!isset($_SESSION["userId"])){
		 $action = 'showLogin';
	 } else {
		 $action = 'showHome';
	 }
}

if($action == 'showLogin'){
	include 'view/login.php';
	die();
} else if ($action == 'login'){
	$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	include 'model/db.php';
	$getPass->execute();
	$password2 = $getPass->fetch()[0];
	if(password_verify($password, $password2)){
		$_SESSION['username'] = $username;
		$getUserId->execute();
		$userId = $getUserId->fetch()[0];
		$_SESSION['userId'] = $userId;
        $action = 'showHome';
	} else{
		$message = 'Invalid login';
		include 'view/login.php';
		die();
	}
} else if($action == 'showRegister'){
	include 'view/register.php';
	die();
} else if($action == 'register'){
	$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
	include 'model/db.php';
	$getUserId->execute();
	$userId = $getUserId->fetch()[0];
	if($userId != null){
		$message = "An account with that username already exists";
		include 'view/register.php';
	} else {
		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		$confPassword = filter_input(INPUT_POST, 'confPassword', FILTER_SANITIZE_STRING);
		if($password != $confPassword){
			$message = "Passwords do not match, please try again";
			include 'view/register.php';
			die();
		} else if(preg_match('~[0-9]~', $password) === 0 || strlen($password) < 8){
			$message = "Passwords does not meet requirements, please try again!";
			include 'view/register.php';
			die();
		} 
		else {
			$hashword = password_hash($password, PASSWORD_DEFAULT);
			$fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
			$lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
            $register->bindParam('fname', $fname);
			$register->bindParam('lname', $lname);
			$register->bindParam('username', $username);
			$register->bindParam('password', $hashword);
			$register->execute();
			$success = $register->rowCount();
			if($success = 1){
				$message = 'Successfully created account, please log in';
				include 'view/login.php';
				die();
			} else {
				$message = 'An error occurred, please try again';
				include 'view/register.php';
			}
		}
	}
	die();
} else {
  $userId = $_SESSION['userId'];
  $username = $_SESSION['username'];
  include 'model/db.php';
}
if($action == 'logout'){
  session_destroy();
  include 'view/login.php';
  die();
} else if($action == 'showHome'){
  $message = filter_input(INPUT_GET, 'message', FILTER_SANITIZE_STRING);
  $getFavoriteLocations->bindParam(':id', $userId);
  $getFavoriteLocations->execute();
  $locations = $getFavoriteLocations->fetchAll();
  $getYourLocations->bindParam(':userId', $userId);
  $getYourLocations->execute();
  $yourLocations = $getYourLocations->fetchAll();
  include 'view/home.php';
  die();
} else if($action == 'showBrowse'){
  $getCategories->execute();
  $categories = $getCategories->fetchAll();
  $getPublicLocations->execute();
  $locations = $getPublicLocations->fetchAll();
  include 'view/browse.php';
  die();
} else if($action == 'viewLocation'){
  $locationId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
  $message = urldecode(filter_input(INPUT_GET, 'message', FILTER_SANITIZE_STRING));
  $getLocationById->bindParam(':id', $locationId);
  $getLocationById->execute();
  $location = $getLocationById->fetch();
  $checkIsSaved->bindParam(':locationId', $locationId);
  $checkIsSaved->bindParam(':userId', $_SESSION['userId']);
  $checkIsSaved->execute();
  $isSaved = $checkIsSaved->fetch()[0];
  include 'view/view.php';
  die();
} else if($action == 'saveLocation'){
  $locationId = filter_input(INPUT_GET, 'locationId', FILTER_VALIDATE_INT);
  $userId = $_SESSION['userId'];
  $saveLocation->bindParam(':locationId', $locationId);
  $saveLocation->bindParam(':userId', $userId);
  $saveLocation->execute();
  $rowCount = $saveLocation->rowCount();
  if($rowCount == 1){
      header("HTTP/10.2.1 200 OK");
  } else {
      header("HTTP/10.4.1 400 Bad Request");
      die();
  }
} else if($action == 'deleteLocation'){
  $locationId = filter_input(INPUT_GET, 'locationId', FILTER_VALIDATE_INT);
  $deleteLocation->bindParam('locationId', $locationId);
  $deleteLocation->execute();
  $rowCount = $deleteLocation->rowCount();
  if($rowCount == 1){
    $message = "Removed location";
  } else {
    $message = "Location not removed";
  }
  header("Location: ./?action=showHome&message=".urlencode($message));
} else if($action == 'removeLocation'){
  $locationId = filter_input(INPUT_GET, 'locationId', FILTER_VALIDATE_INT);
  $userId = $_SESSION['userId'];
  $removeLocation->bindParam(':locationId', $locationId);
  $removeLocation->bindParam(':userId', $userId);
  $removeLocation->execute();
  $rowCount = $removeLocation->rowCount();
  if($rowCount > 0){
      header("HTTP/10.2.1 200 OK");
  } else {
      header("HTTP/10.4.1 400 Bad Request");
      die();
  }
} else if($action == 'showSubmit'){
  $getCategories->execute();
  $categories = $getCategories->fetchAll();
	include 'view/submit.php';
	die();
} else if($action == 'showEditLocation'){
  $getCategories->execute();
  $categories = $getCategories->fetchAll();
  $locationId = filter_input(INPUT_GET, 'locationId', FILTER_VALIDATE_INT);
  $getAuthor->bindParam(':locationId', $locationId);
  $getAuthor->execute();
  $authorId = $getAuthor->fetch()[0];
  $getLocationById->bindParam(':id', $locationId);
  $getLocationById->execute();
  $location = $getLocationById->fetch();
  if($authorId == $_SESSION['userId']){
    include 'view/editLocation.php';
  } else {
    echo $authorId. " ,". $_SESSION['userId'];
    echo "Nice try bozo";
  }
} else if($action == 'updateLocation'){
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
  $isPublic = filter_input(INPUT_POST, 'isPublic', FILTER_VALIDATE_BOOLEAN);
  $categoryId = filter_input(INPUT_POST, 'categoryId', FILTER_VALIDATE_INT);
  $locationId = filter_input(INPUT_POST, 'locationId', FILTER_VALIDATE_INT);
  $updateLocation->bindParam(':locationId', $locationId);
  $updateLocation->bindParam(':title', $title);
  $updateLocation->bindParam(':description', $description);
  $updateLocation->bindParam(':isPublic', $isPublic);
  $updateLocation->bindParam(':categoryId', $categoryId);
  $updateLocation->execute();
  $rowsAffected = $updateLocation->rowCount();
  if($rowsAffected == 1){
    $message = "Updated location!";
  } else {
    $message = "Error updating location";
  }
    header("Location: ./?action=viewLocation&id=".$locationId."&location=".urlencode($location['title'])."&message=".urlencode($message));
    die();
} else if($action == 'submit'){
  $title = filter_input(INPUT_GET, 'name', FILTER_SANITIZE_STRING);
  $description = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING);
  $isPublic = filter_input(INPUT_GET, 'isPublic', FILTER_VALIDATE_BOOLEAN);
  $lat = filter_input(INPUT_GET, 'lat', FILTER_VALIDATE_FLOAT);
  $lon = filter_input(INPUT_GET, 'lng', FILTER_VALIDATE_FLOAT);
  $categoryId = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);

  $addLocation->bindParam(':title', $title);
  $addLocation->bindParam(':description', $description);
  $addLocation->bindParam(':lat', $lat);
  $addLocation->bindParam(':lon', $lon);
  $addLocation->bindParam(':authorId', $userId);
  $addLocation->bindParam(':categoryId', $categoryId);
  $addLocation->bindParam(':isPublic', $isPublic);
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
