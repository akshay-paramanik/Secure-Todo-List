<?php
session_start();
if(!isset($_SESSION['username'])){
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <script
    src="https://kit.fontawesome.com/27f8f9f2f9.js"
    crossorigin="anonymous"
  ></script>
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <div class="container">
      <h2>Log In</h2>
      <form id="registrationForm" action="../process/action.php" method="post">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
          <label for="password" name="password">Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <p id="password-show">
          <i class="fa-solid show-hide fa-eye-slash" id="hide" onclick="showHide(1)">show</i>
          <i class="show-hide fa-solid fa-eye" onclick="showHide(0)" id="show">hide</i>
        </p>
        <p><a href="resetpassword.php">Forget password?</a></p>
        <button type="submit" class="submit-btn" name="login">Login</button>
        <p><a href="signUp.php">Create new Accound</a></p>
        <div id="successMessage" class="success">Loged in Successful</div>
      </form>
    </div>
    <script src="login.js">
    </script>
  </body>
</html>
<?php

}else{
  header("location:../index.php");
}
?>