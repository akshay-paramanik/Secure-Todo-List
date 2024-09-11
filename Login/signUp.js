document
  .getElementById("registrationForm")
  .addEventListener("submit", function (event) {
    let email = document.getElementById("email").value;
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("confirmPassword").value;

    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");
    let confirmPasswordError = document.getElementById("confirmPasswordError");
    let successMessage = document.getElementById("successMessage");

    // Reset error messages
    emailError.style.display = "none";
    passwordError.style.display = "none";
    confirmPasswordError.style.display = "none";
    successMessage.style.display = "none";

    // Email validation
    const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
      emailError.style.display = "block";
      event.preventDefault();
      return;
    }

    // Password validation
    const passwordPattern =
      /^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!passwordPattern.test(password)) {
      passwordError.style.display = "block";
      event.preventDefault();
      return;
    }

    // Confirm password validation
    if (password !== confirmPassword) {
      confirmPasswordError.style.display = "block";
      event.preventDefault();
      return;
    }

    // If all validations pass
    successMessage.style.display = "block";
  });
