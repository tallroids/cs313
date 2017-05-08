<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
    $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
    $state = filter_input(INPUT_POST, "state", FILTER_SANITIZE_STRING);
    $zip = filter_input(INPUT_POST, "zip", FILTER_SANITIZE_STRING);
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Order Confirmation</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>

    <body>
        <main>
        <h1>Order Confirmation</h1>
        <h2>Products:</h2>
        <?php
            foreach($_SESSION as $key => $value){
                echo "<p>Product Name: $key Quantity: $value</p>";
            }
        echo "<h2>Shipping to:</h2>";
            echo "<p>$name</p><p>$address</p><p>$state $zip</p>";
            session_destroy();
            die();
        ?>
        </main>
    </body>

    </html>