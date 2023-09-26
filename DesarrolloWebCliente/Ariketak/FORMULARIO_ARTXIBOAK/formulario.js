var correoInput = document.getElementById("correo");
var mensajeErrorCorreo = document.getElementById("mensajeErrorCorreo");
var correoValido = 0;

correoInput.addEventListener("blur", function () {
    var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (!regexCorreo.test(correoInput.value)) {
        mensajeErrorCorreo.textContent = "El correo no es válido\n\n(correo@correo.com)";
        correoValido = -1;
    } else {
        mensajeErrorCorreo.textContent = "";
        correoValido = 0;
    }
});

var passInput1 = document.getElementById("klabe1");
var passInput2 = document.getElementById("klabe2");
var mensajeError = document.getElementById("mensajeError");

passInput1.addEventListener("input", function () {
    if (passInput1.value != passInput2.value) {
        mensajeError.textContent = "Las contraseñas deben coincidir";
    } else {
        mensajeError.textContent = "";
    }
});

passInput2.addEventListener("input", function () {
    if (passInput1.value != passInput2.value) {
        mensajeError.textContent = "Las contraseñas deben coincidir";
    } else {
        mensajeError.textContent = "";
    }
});

var nombreInput = document.getElementById("fname");
var apellidoInput = document.getElementById("apellido");

nombreInput.addEventListener("input", function () {
    if (nombreInput.value != "" || nombreInput.value != null) {
        apellidoInput.disabled = false;
    } else {
        apellidoInput.disabled = true;
    }
});

function AbrirPopUp() {
    var nuevaVentana = window.open("bigarrenLehioa.html?", "PopUp-BigarrenLehioa", "width=500,height=400");
    nuevaVentana.focus();
}

function validarFormulario() {
    var formulario = document.getElementById("finscripcion");
    var elementosFormulario = formulario.elements;
    var camposVacios = 0;

    for (var i = 0; i < elementosFormulario.length; i++) {
        var elemento = elementosFormulario[i];

        if (elemento.tagName == "INPUT" && elemento.value.trim() == "") {
            camposVacios++;
        }
    }

    if (camposVacios > 0) {
        alert("Por favor, complete todos los campos.");
        return false;
    } else if (passInput1.value != passInput2.value) {
        alert("Las contraseñas deben coincidir");
        return false;
    } else if (correoValido == -1) {
        alert("El Correo debe ser válido");
        return false;
    }

    return true;
}




