document.addEventListener("DOMContentLoaded", function () {

    document.getElementById("btnInsert").addEventListener("click", execInsertUsuario);

    // comprobaciones

    document.getElementById("usuario").addEventListener("keypress", function () {
        return admitir_solo_letras(event)
    })

    document.getElementById("correo").addEventListener("keypress", function () {
        return comprobarArroba(event)
    })

    document.getElementById("pasahitza").addEventListener("keypress", function () {
        return comprobar_longitudPasahitza(event)
    })

});

function admitir_solo_letras(tecla) {
    if (tecla.key < "A" || tecla.key > "z") {
        tecla.preventDefault();
    }
}


var kont = 0;
function comprobarArroba(event) {
    //console.log(event.key);

    if (event.key == "@") {
        kont++;
    }

    if (kont > 1 && event.key == "@") {
        event.preventDefault();
    }
}
var cont = 0
function comprobar_longitudPasahitza(e) {
    //console.log(e.key)
    if (e.key) {
        cont++
    }
}



//////////////////////////////////////////////////

// Con esta funcion podremos insertar usuarios despues de las comprobaciones basicas
function execInsertUsuario() {

    var nombre = document.getElementById("usuario").value;
    var correo = document.getElementById("correo").value;
    var pasahitza = document.getElementById("pasahitza").value;

    if (nombre.trim().length == 0 || pasahitza.trim().length == 0 || correo.trim().length == 0) {

        alert("Datuak falta zaizkizu sartzeko")
        return false;
    } else {
        var url = "/controller/controller_insert_usuario.php";
        var data = { 'nombre': nombre, 'correo': correo, 'pasahitza': pasahitza };

        fetch(url, {
            method: 'POST', // or 'POST'
            body: JSON.stringify(data), // data can be `string` or {object}!
            headers: { 'Content-Type': 'application/json' }  //input data
        })
            .then(res => res.json()).then(result => {

              //  console.log(result.usuarios);
              //  alert(result.usuarios);
                

                document.getElementById("usuario").value = "";
                document.getElementById("correo").value = "";
                document.getElementById("pasahitza").value = "";
                window.location.href = "/view/paginas/registrarse.html"

            })
            .catch(error => console.error('Error status:', error));
    }

};


