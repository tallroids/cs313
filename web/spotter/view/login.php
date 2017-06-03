<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1">
  <link type="text/css" rel="stylesheet" href="view/styles.css">
  <script src="view/scripts.js"></script>
</head>

<body>
  <form id="login" action="./" method="POST">
    <h1 id="logo">S<span></span>otter</h1>
    <input type="hidden" name="action" value="login">
    <p>Username</p>
    <input type="text" name="username" autofocus>
    <p>Password</p>
    <input type="password" name="password">
    <button type="submit">Login</button>
    <?php
        $thisPage = 'login';
          if(isset($message)){ echo "<p class='error'>{$message}</p>"; }
        ?>
      <p>Don't have an account? <a href="index.php?action=showRegister">Register</a></p>
  </form>
  <?php include "modules/footer.php"; ?>