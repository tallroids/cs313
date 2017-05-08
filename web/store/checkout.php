<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Checkout</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>

    <body>
        <main>
            <h1>Checkout</h1>
        <form action="confirmation.php" method="post">
            <p class="checkout"> Full Name: </p>  
            <input class="checkout" type="text" name="name">
            <br>
            <p class="checkout"> Street Address: </p>  
            <input class="checkout" type="text" name="address">
            <br>
            <p class="checkout"> City: </p>  
            <input class="checkout" type="text" name="city">
            <br>
            <p class="checkout"> State: </p>
            <input class="checkout" type="text" name="state">
            <br>
            <p class="checkout"> Zip Code: </p>
            <input class="checkout" type="number" name="zip">
            <br>
            <button type="submit">Place Order</button>
        </form>
        <form action="cart.php" method="post">
            <button type="submit">Return to Cart</button>
        </form>
        </main>
    </body>

    </html>