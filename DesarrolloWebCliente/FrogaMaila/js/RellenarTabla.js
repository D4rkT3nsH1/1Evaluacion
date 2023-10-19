var tabla = document.getElementById("hemen");
var boton = document.getElementById("CREAR");
var izenaInput = document.getElementById("Izena");
var abizenaInput = document.getElementById("Abizena");
var notaInput = document.getElementById("Nota");

boton.addEventListener("click", function () {
    var hilera = document.createElement("tr");

    var celda1 = document.createElement("td");
    var celda2 = document.createElement("td");
    var celda3 = document.createElement("td");

    var textoCelda1 = document.createTextNode(izenaInput.value);
    var textoCelda2 = document.createTextNode(abizenaInput.value);
    var textoCelda3 = document.createTextNode(notaInput.value);

    celda1.appendChild(textoCelda1);
    celda2.appendChild(textoCelda2);
    celda3.appendChild(textoCelda3);

    hilera.appendChild(celda1);
    hilera.appendChild(celda2);
    hilera.appendChild(celda3);
    
    tabla.appendChild(hilera);
});