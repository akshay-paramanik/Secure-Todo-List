const show = document.getElementById("show");
const hide = document.getElementById("hide");
const password = document.getElementById("password");
function showHide(id) {
  if (id == 1) {
    hide.addEventListener("click", () => {
      show.style.display = "block";
      hide.style.display = "none";
      password.type = "text";
    });
  } else if (id == 0) {
    show.addEventListener("click", () => {
      hide.style.display = "block";
      show.style.display = "none";
      password.type = "password";
    });
  }
}
