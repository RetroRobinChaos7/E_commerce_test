let menu = document.getElementById("dropdown-btn");
let openM = document.getElementById("display-menu");
let login = document.getElementById("login");
let userName = document.getElementById("user-profile");

menu.addEventListener("click", menuStuff);

function menuStuff(){
    openM.classList.toggle("active");
}