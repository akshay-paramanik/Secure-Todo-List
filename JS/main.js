// Selectors

const toDoInput = document.querySelector(".todo-input");
const toDoBtn = document.querySelector(".todo-btn");
const toDoList = document.querySelector(".todo-list");
const standardTheme = document.querySelector(".standard-theme");
const lightTheme = document.querySelector(".light-theme");
const darkerTheme = document.querySelector(".darker-theme");
const penddingTask = document.querySelector(".pendding-task");
const completeTask = document.querySelector(".completed-task");
const lists = document.querySelector("#myUnOrdList");
penddingTask.addEventListener("click", () => {
  penddingTask.classList.add("active");
  completeTask.classList.remove("active");
  req = new XMLHttpRequest();
  req.open("GET", `process/action.php?status=pendding`, true);
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      lists.innerHTML = req.responseText;
    }
  };
  req.send();
});

def = new XMLHttpRequest();
def.open("GET", `process/action.php?status=pendding`, true);
def.onreadystatechange = function () {
  if (def.readyState == 4 && def.status == 200) {
    lists.innerHTML = def.responseText;
  }
};
def.send();
completeTask.addEventListener("click", () => {
  completeTask.classList.add("active");
  penddingTask.classList.remove("active");
  req = new XMLHttpRequest();
  req.open("GET", `process/action.php?Work=completeWork&class=completed`, true);
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      lists.innerHTML = req.responseText;
    }
  };
  req.send();
});
// Event Listeners

toDoBtn.addEventListener("click", addToDo);
standardTheme.addEventListener("click", () => changeTheme("standard"));
lightTheme.addEventListener("click", () => changeTheme("light"));
darkerTheme.addEventListener("click", () => changeTheme("darker"));

// Check if one theme has been set previously and apply it (or std theme if not found):
let savedTheme = localStorage.getItem("savedTheme");
savedTheme === null
  ? changeTheme("standard")
  : changeTheme(localStorage.getItem("savedTheme"));

// Functions;
function addToDo(event) {
  // Prevents form from submitting / Prevents form from relaoding;

  if (toDoInput.value === "") {
    alert("You must write something!");
  }
}

function deleteTask(id, itemId) {
  const item = document.getElementById(`${itemId}`);
  req = new XMLHttpRequest();
  req.open("GET", `process/action.php?req=delete&id=${id}`, true);
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      item.parentElement.classList.add("fall");
    }
  };
  req.send();
}
function completeEvent(id, itemId) {
  const item = document.getElementById(`${itemId}`);
  req = new XMLHttpRequest();
  req.open("GET", `process/action.php?request=completed&id=${id}`, true);
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      item.parentElement.classList.add("completed");
    }
  };
  req.send();
}

// Change theme function:
function changeTheme(color) {
  localStorage.setItem("savedTheme", color);
  savedTheme = localStorage.getItem("savedTheme");

  document.body.className = color;
  // Change blinking cursor for darker theme:
  color === "darker"
    ? document.getElementById("title").classList.add("darker-title")
    : document.getElementById("title").classList.remove("darker-title");

  document.querySelector("input").className = `${color}-input`;
  // Change todo color without changing their status (completed or not):
  document.querySelectorAll(".todo").forEach((todo) => {
    Array.from(todo.classList).some((item) => item === "completed")
      ? (todo.className = `todo ${color}-todo completed`)
      : (todo.className = `todo ${color}-todo`);
  });
  // Change buttons color according to their type (todo, check or delete):
  document.querySelectorAll("button").forEach((button) => {
    Array.from(button.classList).some((item) => {
      if (item === "check-btn") {
        button.className = `check-btn ${color}-button`;
      } else if (item === "delete-btn") {
        button.className = `delete-btn ${color}-button`;
      } else if (item === "todo-btn") {
        button.className = `todo-btn ${color}-button`;
      }
    });
  });
}
