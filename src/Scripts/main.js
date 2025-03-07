let menu = document.querySelector("button");
let openM = document.getElementById("display-menu");

menu.addEventListener("click", menuStuff);

function menuStuff(){
    openM.classList.toggle("active");
}