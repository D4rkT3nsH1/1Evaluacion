document.addEventListener("DOMContentLoaded", function () {
    //document.getElementById("btnSop").addEventListener("click", borrar);

    document.getElementById("correo").addEventListener("keypress", function () {
        return comprobarArroba(event)
    })

    document.getElementById("usuario").addEventListener("keypress", function () {
        return admitir_solo_letras(event)
    })

});

// COMPROBACIONES
var kont = 0;
function comprobarArroba(event) {
   // console.log(event.key);

    if (event.key == "@") {
        kont++;
    }

    if (kont > 1 && event.key == "@") {
        event.preventDefault();
    }
}

function admitir_solo_letras(tecla) {
    if (tecla.key < "A" || tecla.key > "z") {
        tecla.preventDefault();
    }
}

