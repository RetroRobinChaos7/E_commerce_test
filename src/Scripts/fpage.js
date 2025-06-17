const frontPI = Array.from(document.getElementsByClassName("item-block"));

for (let i = 0; i < frontPI.length; i++) {
  frontPI[i].addEventListener("click", glowSet);

  frontPI[i].addEventListener("dblclick", function () {
    const itemID = this.getAttribute("data-id");
    const basePath = getRootPath();
    window.location.href = `${basePath}e_commerce_test/src/Pages/Item/item.php?id=${itemID}`;
  });
}

function glowSet(event) {
  event.stopPropagation();
  for (let x = 0; x < frontPI.length; x++) {
    frontPI[x].classList.remove("item-block-selected");
  }
  this.classList.add("item-block-selected");
}

document.body.addEventListener("click", function () {
  for (let i = 0; i < frontPI.length; i++) {
    frontPI[i].classList.remove("item-block-selected");
  }
});

function getRootPath() {
  const path = window.location.pathname;
  const depth = path.split("/").length - 2;
  return "../".repeat(depth);
}
