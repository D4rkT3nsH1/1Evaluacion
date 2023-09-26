function obtenerValoresDeURL() {
    var queryString = window.location.search;

    var posicion = queryString.indexOf("?") + 1;

    var queryString = queryString.substring(posicion);

    var pares = queryString.split("&");

    var valores = [];

    for (var i = 0; i < pares.length; i++) {
        var par = pares[i].split("=");
        var clave = decodeURIComponent(par[0]);
        var valor = decodeURIComponent(par[1]);
        valores[clave] = valor;
    }

    return valores;
}

var valoresDeURL = obtenerValoresDeURL();

var correo = valoresDeURL["ncorreo"];
var nombre = valoresDeURL["firstname"];
var apellido = valoresDeURL["lastname"];
var fnacimiento = valoresDeURL["fnacimi"];
var curso = valoresDeURL["Curso"];

var emailTabla = document.getElementById("emailTable");
emailTabla.textContent = correo;
console.log("Valor de parametro1: " + correo);

var nombreTabla = document.getElementById("firstnameTable");
nombreTabla.textContent = nombre;
console.log("Valor de parametro2: " + nombre);

var apellidoTabla = document.getElementById("lastnameTable");
apellidoTabla.textContent = apellido;
console.log("Valor de parametro3: " + apellido);

var fnaciTabla = document.getElementById("dateTable");
fnaciTabla.textContent = fnacimiento;
console.log("Valor de parametro4: " + fnacimiento);

var cursoTabla = document.getElementById("subjectTable");
cursoTabla.textContent = curso;
console.log("Valor de parametro5: " + curso);