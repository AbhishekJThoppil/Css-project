<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Household Chores</title>
    <link rel="stylesheet" href="./css/site.css" />
</head>
<?php
$title = 'Login';
require 'shared/header.php';
?>

  <h2>Login</h2>
  
  <?php
  if (!empty($_GET['invalid'])) {
    echo '<h4>INVALID LOGIN</h4>';
  }
  ?>
  <h5>Please enter your credentials.</h5>
  <form method="post" action="validate.php">
    <fieldset>
      <label for="username">Username:</label>
      <input name="username" id="username" required type="email" placeholder="email@gmail.com" />
    </fieldset>
    <fieldset>
      <label for="password">Password:</label>
      <input type="password" name="password" id="password" required />
    </fieldset>
    <button class="offset-button">Login</button>
  </form>
</main>
</body>
</html>


































