// CONTENEDOR DE DATOS EN CLIENTE
let coches = [];

// PUNTO DE ENTRADA DEL SCRIPT
document.addEventListener("DOMContentLoaded", function () {
    cargarDatos();
});


// FUNCIÓN QUE CARGA DE DATOS
function cargarDatos() {
    fetch("api/cars.php")
        .then(response => response.json())
        .then(data => {
            // CARGA DE DATOS ASINCRONA
            coches = data;
            mostrarDatos(); // MOSTRAR DATOS TRAS CARGAR ASINCRONAMENTE
        })
        .catch(error => {
            console.error("Error al obtener los datos del servidor:", error);
        });
}

// FUNCIÓN QUE MUESTRA LOS DATOS CARGADOS
function mostrarDatos() {
    let rows = ``;

    // CREAR FILAS DE TABLA HTML CON DATOS
    // COMO UN FOREACH
    for (let coche of coches) {
        rows += `<tr><td>${coche.modelo}</td><td>${coche.marca}</td><td>${coche.ano}</td><td>${coche.precio}</td></tr>`;
    }

    // CREAR LA ESTRUCTURA DE TABLA
    let html = `
    <table id="cochesTable">
        <thead>
            <tr><th>Modelo</th><th>Marca</th><th>Año</th><th>Precio</th></tr>
        </thead>
        <tbody id="cochesData">
            ${rows}
        </tbody>
    </table>
    `;

    // INSERTAR TABLA EN EL BODY
    document.body.innerHTML = html;
}

