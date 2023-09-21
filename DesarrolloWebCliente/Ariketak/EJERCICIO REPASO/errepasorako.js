var imagen = document.getElementById("irudia");

imagen.addEventListener("mouseover", function () {
    imagen.src = "bulls.png";
});

imagen.addEventListener("mouseout", function () {
    imagen.src = "celtics.jpg";
});

var radioButtons = document.getElementsByName("radio");
var parrafos = document.getElementsByTagName("p");

var seleccionTexto = document.getElementById("seleccionTexto");

seleccionTexto.addEventListener("click", function () {
    var opcionSeleccionada;
    for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].checked) {
            opcionSeleccionada = radioButtons[i].id;
            break;
        }
    }

    console.log(opcionSeleccionada)

    if (opcionSeleccionada === "uno") {
        for (var i = 0; i < parrafos.length; i++) {
            parrafos[i].style.fontSize = 10;
        }
    } else if (opcionSeleccionada === "dos") {
        for (var i = 0; i < parrafos.length; i++) {
            parrafos[i].style.fontSize = 15;
        }
    } else if (opcionSeleccionada === "tres") {
        for (var i = 0; i < parrafos.length; i++) {
            parrafos[i].style.fontSize = 18;
        }
    }
});

function SeccionarStr() {
    var palabraStr = document.getElementById("palabra").value;
    var zonaBotones = document.getElementById("ZonaBotones");

    zonaBotones.innerHTML = "";

    for (var i = 0; i < palabraStr.length; i++) {
        var letra = palabraStr.charAt(i); 
        var boton = document.createElement("button");
        boton.textContent = letra; 
        zonaBotones.appendChild(boton);
    }
}

