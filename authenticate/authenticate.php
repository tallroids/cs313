<?php 
session_start();

$pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$name = $_POST["name"];

if ($pass == "5678"){
    $_SESSION["name"] = $name;
    header('Location: home.php');
    die();
} else {
    header('Location: login.php');
    session_destroy();
    die();
}
?>