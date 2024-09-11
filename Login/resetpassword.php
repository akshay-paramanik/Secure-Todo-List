<?php
session_start();
if(!isset($_SESSION['username'])){
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Reset</title>
    <script
    src="https://kit.fontawesome.com/27f8f9f2f9.js"
    crossorigin="anonymous"
  ></script>
    <link rel="stylesheet" href="login.css" />
  </head>
  <body>
    <div class="container">
      <h2>Reset your password</h2>
      <form id="registrationForm" action="../process/action.php" method="post">
      <div class="form-group email-group">
          <label for="email">Enter Email</label>
          <input type="email" id="email" name="email" required />
          <p>

              <button type="button" onclick="getOTP()" id="email-btn">Get OTP</button>
          </p>
        </div>  
      <div class="form-group otp-group">
          <label for="email">Enter OTP</label>
          <input type="number" id="otp" name="otp" required />
          <p>

              <button type="button" onclick="checkOPT()" id="otp-btn">Verify</button>
          </p>
        </div>
        <div class="form-group password-group">
          <label for="password" name="password">New Password</label>
          <input type="password" id="password" name="password" required />
        </div>
        <p id="password-show">
          <i class="fa-solid show-hide fa-eye-slash" id="hide" onclick="showHide(1,'hide','show','password')">show</i>
          <i class="show-hide fa-solid fa-eye" onclick="showHide(0,'hide','show','password')" id="show">hide</i>
        </p>
        <div class="form-group confirm-group">
          <label for="confirmPassword">Confirm Password</label>
          <input type="password" id="confirmPassword" name="password" required />
          <div id="confirmPasswordError" class="error">
            Passwords do not match.
          </div>
        </div>
        <button type="submit" class="submit-btn" name="reset">Reset</button>
      </form>
    </div>
    <script src="reset.js"></script>
  </body>
</html>
<?php

}else{
  header("location:../index.php");
}
?>