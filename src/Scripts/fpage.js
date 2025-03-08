let frontPI = Array.from(document.getElementsByClassName("item-block"));

console.log(frontPI);
for (var i =0; i < frontPI.length;i++){
    frontPI[i].addEventListener("click", glowSet);
}
function glowSet(event){
    event.stopPropagation();
  for (var x = 0; x < frontPI.length;x++){
    frontPI[x].className = "item-block";
  }
  this.className = "item-block-selected";
}
document.body.addEventListener("click", function() {
    for (let i = 0; i < frontPI.length; i++) {
        frontPI[i].className = "item-block";
    }
});