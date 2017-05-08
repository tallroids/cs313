<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Store</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>

    <body>
        <main>
        <h1>Store</h1>
        <?php if(isset($message)){echo "<p class='message'>".$message."</p>";}?>
            <form class = "tile" id="tetons" action="cartOps.php" method="POST">
                <h2>Teton Sunrise</h2>
                <img src="images/tetons.jpg">
                <input type="hidden" name="productName" value="Teton Sunrise">
                <span>Quantity: </span>
                <input type="number" name="quantity">
                <input type="hidden" name="action" value="add">
                <button type="submit" form="tetons">Add to Cart</button>
            </form>
            <form class = "tile" id="trees" action="cartOps.php" method="POST">
                <h2>Tree Sunset</h2>
                <img src="images/trees.jpg">
                <input type="hidden" name="productName" value="Tree Sunset">
                <span>Quantity: </span>
                <input type="number" name="quantity">
                <input type="hidden" name="action" value="add">
                <button type="submit" form="trees">Add to Cart</button>
            </form>
            <form class = "tile" id="stars" action="cartOps.php" method="POST">
                <h2>Star Trails</h2>
                <img src="images/stars.jpg">
                <input type="hidden" name="productName" value="Star Trails">
                <span>Quantity: </span>
                <input type="number" name="quantity">
                <input type="hidden" name="action" value="add">
                <button type="submit" form="stars">Add to Cart</button>
            </form>
            <form class = "tile" id="falls" action="cartOps.php" method="POST">
                <h2>Falls Creek Falls</h2>
                <img src="images/falls.jpg">
                <input type="hidden" name="productName" value="Falls Creek Falls">
                <span>Quantity: </span>
                <input type="number" name="quantity">
                <input type="hidden" name="action" value="add">
                <button type="submit" form="falls">Add to Cart</button>
            </form>
            <form action="cart.php" method="post">
                <button type="submit">View Cart</button>
            </form>
        </main>
    </body>

    </html>