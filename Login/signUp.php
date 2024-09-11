<?php
session_start();
if(!isset($_SESSION['username'])){
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <script
    src="https://kit.fontawesome.com/27f8f9f2f9.js"
    crossorigin="anonymous"
  ></script>
    <link rel="stylesheet" href="signUp.css" />
  </head>
  <body>
    <div class="container">
      <h2>Register</h2>
      <form action="../process/process.php" method="post" id="registrationForm">
        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" required />
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" required />
          <div id="emailError" class="error">Please enter a valid email.</div>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" required />
          <p id="password-show">
          <i class="fa-solid show-hide fa-eye-slash" id="hide" onclick="showHide(1)">show</i>
          <i class="show-hide fa-solid fa-eye" onclick="showHide(0)" id="show">hide</i>
        </p>
          <div id="passwordError" class="error">
            Password must be at least 8 characters long, include letters,
            numbers, and special characters.
          </div>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" id="confirmPassword" name="password" required />
          <div id="confirmPasswordError" class="error">
            Passwords do not match.
          </div>
        </div>
        <input type="submit" class="submit-btn" name="register" value="Register">
        <p>Already have account <a href="login.php">Login</a></p>
        <div id="successMessage" class="success">Registration Successful! Check Your email for verification.</div>
      </form>
    </div>
    <script src="signUp.js"></script>
    <script src="login.js"></script>
  </body>
</html>
<?php

}else{
  header("location:../index.php");
}
?>