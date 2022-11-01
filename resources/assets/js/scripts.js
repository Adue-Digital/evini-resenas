var sliders = document.getElementsByClassName("resena-slider");
sliders.oninput = function() {
    var output = document.getElementById("resena-"+this.dataset.key+"-value");
    output.innerHTML = this.value + "%";
}