// Obtener la URL actual
const currentURL = window.location.search;
const currentURL1 = window.location.href;

console.log(currentURL);
console.log(currentURL1);

// Crear un objeto URLSearchParams con los parámetros de la URL
const urlParams = new URLSearchParams(currentURL.split('?')[1]);

// Obtener los valores de los parámetros
const ncorreo = urlParams.get('ncorreo');
const nklabe1 = urlParams.get('nklabe1');
const nklabe2 = urlParams.get('nklabe2');
const firstname = urlParams.get('firstname');
const lastname = urlParams.get('lastname');
const fnacimi = urlParams.get('fnacimi');
const Curso = urlParams.get('Curso');

var emailTable = document.getElementById("emailTable").textContent = ncorreo;
var firstnameTable = document.getElementById("firstnameTable").textContent = firstname;
var lastnameTable = document.getElementById("lastnameTable").textContent = lastname;
var dateTable = document.getElementById("dateTable").textContent = firstname;
var subjectTable = document.getElementById("subjectTable").textContent = Curso;