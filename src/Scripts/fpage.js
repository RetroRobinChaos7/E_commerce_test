let frontPI = Array.from(document.getElementsByClassName("item-block"));

for (var i = 0; i <frontPI.length; i++){
  frontPI[i].addEventListener("click", glowSet);

  frontPI[i].addEventListener("dblclick", function(){
    const itemID = this.getAttribute("data-id");
    window.location.href = `../Item/item.php?id=${itemID}`;
  });
}

function glowSet(event){
    event.stopPropagation();
  for (var x = 0; x < frontPI.length;x++){
    frontPI[x].classList.remove("item-block-selected");
  }
  this.classList.add("item-block-selected");
}
document.body.addEventListener("click", function() {
    for (let i = 0; i < frontPI.length; i++) {
        frontPI[i].classList.remove("item-block-selected");

    }
});