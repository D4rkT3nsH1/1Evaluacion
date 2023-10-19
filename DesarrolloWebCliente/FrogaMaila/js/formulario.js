var nameInput = document.getElementById("nombre");
var edadInput = document.getElementById("edad");
var correoInput = document.getElementById("email");
var estudiosInput = document.getElementById("estudios");
var checkInput = document.getElementById("acepto");
var form = document.getElementById("pago");


nameInput.addEventListener("input", function () {
    var regexNombre = /^[a-zA-Z]{2,15}$/;
    var regexDigitos = /\d/;
    var mensaje = "";

    if (regexDigitos.test(nameInput.value)) {
        console.log("numeros")
        mensaje = "No puede contener números";
        nameInput.value = nameInput.value.slice(0, -1);

    } else if (!regexNombre.test(nameInput.value)) {
        mensaje = "El nombre debe contener un mínimo dos caracteres";

    } else {
        console.log("Nombre válido");
    }

    nameInput.setCustomValidity(mensaje);
});

edadInput.addEventListener("input", function () {
    var regexLetras = /[a-zA-Z]/;
    var regexDigitos = /\d/;
    var mensaje = "";

    if (regexLetras.test(edadInput.value)) {
        console.log("letras");
        edadInput.value = edadInput.value.slice(0, -1);

    } else if (regexDigitos.test(edadInput.value)) {
        if (edadInput.value >= 10 && edadInput.value <= 100) {
            console.log("Válido");
        } else {
            mensaje = "La edad debe ser mayor o igual que 10 y menor e igual que 100";
        }

    } else {
        console.log("Edad no válida");
    }

    edadInput.setCustomValidity(mensaje);
});

correoInput.addEventListener("blur", function () {
    var regexCorreo = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    var mensaje = "";
    if (!regexCorreo.test(correoInput.value)) {
        mensaje = "El correo no tiene un formato válido";
    } else {
        console.log("Correo válido")
    }
    correoInput.setCustomValidity(mensaje);
});

form.addEventListener("submit", function (event) {
    var mensaje = "";

    if (estudiosInput.value === "") {
        mensaje += "Debes seleccionar un elemento en el combo estudios.\n";
    }

    if (!checkInput.checked) {
        mensaje += "Debes aceptar las condiciones.\n";
    }

    if (mensaje !== "") {
        event.preventDefault();
        alert(mensaje);
    }
});