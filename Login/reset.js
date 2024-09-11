let otp = document.querySelector("#otp");
let otpBtn = document.querySelector("#otp-btn");
let passwordBox = document.getElementById("password");
let confirmPasswordBox = document.getElementById("confirmPassword");
let passGroup = document.querySelector(".password-group");
let confirmGroup = document.querySelector(".confirm-group");
let passShow = document.querySelector("#password-show");
let email = document.querySelector("#email");
let emailBtn = document.querySelector("#email-btn");
let otpGroup = document.querySelector(".otp-group");
let emailGroup = document.querySelector(".email-group");
let submitBtn = document.querySelector(".submit-btn");

passGroup.style.display = "none";
confirmGroup.style.display = "none";
passShow.style.display = "none";
otpGroup.style.display = "none";
submitBtn.style.display = "none";

function getOTP() {
  let emailValue = email.value;
  req = new XMLHttpRequest();
  req.open("GET", `../process/action.php?emailVal=${emailValue}`, true);
  req.onreadystatechange = function () {
    setTimeout(() => {
      if (req.readyState == 4 && req.status == 200) {
        alert("check your email!");
        otpGroup.style.display = "block";
        emailGroup.style.display = "none";
      } else {
        alert("you are not register.");
      }
    }, 500);
  };
  req.send();
}

function checkOPT() {
  let otpVal = otp.value;
  let emailValue = email.value;
  req = new XMLHttpRequest();
  req.open(
    "GET",
    `../process/action.php?otpVal=${otpVal}&emailValue=${emailValue}`,
    true
  );
  req.onreadystatechange = function () {
    setTimeout(() => {
      if (req.readyState == 4 && req.status == 200) {
        alert("Verified!!");
        otpGroup.style.display = "none";
        passGroup.style.display = "block";
        confirmGroup.style.display = "block";
        passShow.style.display = "block";
        submitBtn.style.display = "block";
      } else {
        alert("OPT not match");
      }
    }, 500);
  };
  req.send();
}

function showHide(id, hideP, showP, pass) {
  const show = document.getElementById(showP);
  const hide = document.getElementById(hideP);
  const passwordChose = document.getElementById(pass);
  if (id == 1) {
    hide.addEventListener("click", () => {
      show.style.display = "block";
      hide.style.display = "none";
      passwordChose.type = "text";
    });
  } else if (id == 0) {
    show.addEventListener("click", () => {
      hide.style.display = "block";
      show.style.display = "none";
      passwordChose.type = "password";
    });
  }
}
document
  .getElementById("registrationForm")
  .addEventListener("submit", function (event) {
    let password = passwordBox.value;
    let confirmPassword = confirmPasswordBox.value;

    let passwordError = document.getElementById("passwordError");
    let confirmPasswordError = document.getElementById("confirmPasswordError");

    // Reset error messages
    passwordError.style.display = "none";
    confirmPasswordError.style.display = "none";

    // Password validation
    const passwordPattern =
      /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordPattern.test(password)) {
      passwordError.style.display = "block";
      return;
    }

    // Confirm password validation
    if (password !== confirmPassword) {
      confirmPasswordError.style.display = "block";
      return;
    }
  });
