var correoInput = document.getElementById("correo");
var mensajeErrorCorreo = document.getElementById("mensajeErrorCorreo");
var correoValido = 0;

var passInput1 = document.getElementById("klabe1");
var passInput2 = document.getElementById("klabe2");
var mensajeError = document.getElementById("mensajeError");

var nombreInput = document.getElementById("fname");
var apellidoInput = document.getElementById("apellido");

var fechaInput = document.getElementById("fnacimiento");

correoInput.addEventListener("blur", function () {
    var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    if (!regexCorreo.test(correoInput.value)) {
        mensajeErrorCorreo.textContent = "El correo no es válido (ejemplo@ejemplo.com)";
        correoValido = -1;
    } else {
        mensajeErrorCorreo.textContent = "";
        correoValido = 0;
    }
});



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


nombreInput.addEventListener("input", function () {
    if (nombreInput.value != "" || nombreInput.value != null) {
        apellidoInput.disabled = false;
    } else {
        apellidoInput.disabled = true;
    }
});

var cursos = document.querySelectorAll('input[type="radio"][name="Curso"]');
for (let i = 0; i < cursos.length; i++) {
    var curso = cursos[i];
    if (curso.selected) {
        curso.value = curso.selected;
    }
}

var nuevaVentana;

function AbrirPopUp() {
    nuevaVentana = window.open("bigarrenLehioa.html?ncorreo=" + correoInput.value + "&firstname=" + nombreInput.value + "&lastname=" + apellidoInput.value + "&fnacimi=" + fechaInput.value + "&Curso=" + curso.value, "PopUp-BigarrenLehioa", "width=600,height=500");
    nuevaVentana.focus();
}

function NuevaVentana() {
    nuevaVentana = window.open("", _blank);
    nuevaVentana.focus();
}

function CerrarPopUp() {
    nuevaVentana.close()
}

function validarFormulario() {
    var inputsFormulario = document.getElementsByTagName("input");
    var camposVacios = 0;

    for (var i = 0; i < inputsFormulario.length; i++) {
        var elemento = inputsFormulario[i];

        if (elemento.value.trim() == "") {
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




