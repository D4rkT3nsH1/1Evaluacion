document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnLog").addEventListener("click", comprobarAdmin);
});

// Con esta funcion comprobamos si el usuario metido es admin o otro
function comprobarAdmin() {
  //  console.log("estoy dentro")
    var nombre = document.getElementById("user").value
    var pass = document.getElementById("pass").value

    var url = "/controller/controller_login.php";
    var data2 = { 'nombre': nombre, 'pasahitza': pass };


    fetch(url, {
        method: 'POST',
        body: JSON.stringify(data2), // data can be `string` or {object}!
        headers: { 'Content-Type': 'application/json' }  //input data 
    })
        .then(res => res.json()).then(result => {
            console.log(result.usuario)

            var usuario = result.usuario;
            console.log(usuario[0].nombre)
            if (usuario[0].tipo == "admin") {
                alert("Admin zara")
                window.location.href = "/view/paginas/admin.html"
            } else if (usuario[0].tipo == "usuario") {
                alert("Ez zara admin")
                window.location.href = "/view/index.html"
            } else {
                alert("AKATSA SAIOA HASTEAN")
                document.getElementById("user").value = ""
                document.getElementById("pass").value = ""
            }

        })
        .catch(error => console.error('Error status:', error));
};