<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Cart</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>

    <body>
        <main>
        <h1>Cart</h1>
        <?php if(isset($message)){
            echo "<p class='message'>".$message."</p>";
        }

        foreach($_SESSION as $key => $value){
            echo "<form class='product' action='cartOps.php' method='post'>";
            echo "<p>Product Name: $key Quantity: $value</p>";
            echo "<button type='submit'>Remove from cart</button>";
            echo "<input type='hidden' name='action' value='remove'>";
            echo "<input type='hidden' name='productName' value='$key'>";
            echo "<input type='hidden' name='quantity' value='$value'>";
            echo "</form>";
        }
    ?>
            <form action="index.php" method="post">
                <button type="submit">Continue Shopping</button>
            </form>
            <form action="checkout.php" method="post">
                <button type="submit">Checkout</button>
            </form>
        </main>
    </body>

    </html>