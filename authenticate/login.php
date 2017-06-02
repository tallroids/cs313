<?php 
if(!isset($_SESSION)){
session_start();
}
$thisPage = 'login';
?>
<!DOCTYPE html>
    <html>
        <body>
            <form action="authenticate.php" method="POST">
                Name <input type="text" name="name"><br>
                Password <input type="password" name="password">
            <button type="submit">Submit</button>
            </form>
        </body>
        
</html>
