<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$action = $_POST["action"];
$productName = $_POST["productName"];
$quantity = $_POST["quantity"];

if($action == "add"){
    
$_SESSION[$productName] = $quantity;
$message = "Successfully added {$productName} to cart!";
include "index.php";
    die();
} else if($action == "remove"){
    unset($_SESSION[$productName]);
    $message = "successfully removed $productName from cart";
    include "cart.php";
    die();
} else {
    $message = "An Error Occured";
    include "index.php";
    die();
}
?>