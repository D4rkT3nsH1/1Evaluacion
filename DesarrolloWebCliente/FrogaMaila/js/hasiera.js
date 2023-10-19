var anteriorFoto = document.getElementById("anterior");
var siguienteFoto = document.getElementById("siguiente");
var imagen = document.getElementById("imgContenedor");
var botonesDiv = document.getElementById("buttonDIV");
var indexFoto = 0;

for (let i = 0; i < 6; i++) {
    var boton = document.createElement("button")
    boton.textContent = i;
    boton.setAttribute("id", i);
    botonesDiv.appendChild(boton);
}

botonesDiv.addEventListener("click", function (event) {
    if (event.target.tagName === "BUTTON") {
        var idDelBoton = event.target.id;
        imagen.setAttribute("src", "img/wallpaper_" + idDelBoton + ".jpg")
    }
});

anteriorFoto.addEventListener("click", function () {
    indexFoto--;
    if (indexFoto == -1) {
        indexFoto = 5;
    }
    imagen.setAttribute("src", "img/wallpaper_" + indexFoto + ".jpg")
});

siguienteFoto.addEventListener("click", function () {
    indexFoto++;
    if (indexFoto == 6) {
        indexFoto = 0;
    }
    imagen.setAttribute("src", "img/wallpaper_" + indexFoto + ".jpg")
});