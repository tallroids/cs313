<?php 
session_start();
    if(isset($_SESSION['name'])){
        $name = $_SESSION['name'];
        echo "<h1>Welcome {$name}</h1>";
        die();
    } else {
        header("Location: login.php");
        session_destroy();
        die();
    }
?>