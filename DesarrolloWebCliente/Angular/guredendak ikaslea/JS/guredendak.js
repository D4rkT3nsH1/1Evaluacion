debugger;
let productos;
function cargarDatos() {
    $.ajax({
        url: "../controller/controlador_consulta_productos.php",
        type: "GET",
        dataType: 'json',
        success: function (data) {
            console.log("Datos obtenidos:", data);
            productos = data;
            renderizarProductos(data);
        },
        error: function (error) {
            console.error("Error al obtener los datos del servidor:", error);
        }
    });
}

console.log("Productos:", productos);

document.addEventListener("DOMContentLoaded", function () {

    // Obtener referencias a los elementos del DOM
    const menu = document.getElementById("menu");
    const zonaConsulta = document.getElementById("zonaConsulta");
    const zonaCarro = document.getElementById("zonaCarro");
    const zonaInsertar = document.getElementById("zonaInsertar");

    ocultarModales();

    // Manejar clics en el menú
    menu.addEventListener("click", function (event) {
        const targetId = event.target.id;

        // Ocultar todos los modales
        ocultarModales();

        // Mostrar el modal correspondiente al elemento clicado
        if (targetId === "uno") {
            zonaConsulta.classList.remove("oculto");
        } else if (targetId === "dos") {
            zonaInsertar.classList.remove("oculto");
        } else if (targetId === "cuatro") {
            zonaCarro.classList.remove("oculto");
        }
    });

    // Función para ocultar todos los modales
    function ocultarModales() {
        zonaConsulta.classList.add("oculto");
        zonaCarro.classList.add("oculto");
        zonaInsertar.classList.add("oculto");
    }
    
    // Variable para manejar el carro
    let carrito = [];

    // Función para renderizar los productos en la zonaConsulta
    function renderizarProductos(productos) {
        const zonaConsulta = document.getElementById("zonaConsulta");
        zonaConsulta.innerHTML = "";

        productos.forEach((producto) => {
            const card = document.createElement("div");
            card.classList.add("card", "tablaProductos");

            card.innerHTML = `
                <p>${producto.tipo}</p>
                <p><img width="125px" height="75px" class="Cprod" src="${producto.foto}"></p>
                <p>${producto.nombre}</p>
                <p>PRECIO: <span>${producto.precio} €</span></p>
                <p>Disponibles:&nbsp; ${producto.cantidad} &nbsp;unidades</p>
                <button onclick="addToCart(${productos.indexOf(producto)})">Add to Cart</button>
                <p>
                    <img src="IMG/images.jpg" class="txiki" style="cursor: pointer;" />
                    <img src="IMG/modif.png" class="txiki" style="cursor: pointer;" />
                </p>
            `;

            zonaConsulta.appendChild(card);
        });
    }

    // Función para añadir productos al carro
    window.addToCart = function (index) {
        const producto = productos[index];
        if (producto.cantidad > 0) {
            carrito.push({ ...producto, cantidadCarro: 1 });
            producto.cantidad--;
            renderizarProductos();
            renderizarCarro();
        }
    };

    // Función para renderizar el carro
    function renderizarCarro() {
        const zonaCarro = document.getElementById("zonaCarro");
        const tablaCarro = zonaCarro.querySelector("table");
        const btnRealizarCompra = zonaCarro.querySelector("button:first-of-type");
        const btnCancelarCompra = zonaCarro.querySelector("button:nth-of-type(2)");
        const btnVaciarCarro = zonaCarro.querySelector("button:last-of-type");

        // Limpiar tabla del carro
        tablaCarro.innerHTML = `
            <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Cuantos compra</th>
                <th>Total a Pagar</th>
            </tr>
        `;

        // Rellenar tabla con productos en el carro
        carrito.forEach((producto) => {
            const fila = document.createElement("tr");
            fila.innerHTML = `
                <td>${producto.nombre}</td>
                <td>${producto.tipo}</td>
                <td>${producto.precio} €</td>
                <td>${producto.cantidad}</td>
                <td>
                    <button onclick="aumentarCantidad(${carrito.indexOf(producto)})">+</button>
                    <button onclick="disminuirCantidad(${carrito.indexOf(producto)})">-</button>
                </td>
                <td>${producto.precio * producto.cantidadCarro} €</td>
            `;
            tablaCarro.appendChild(fila);
        });

        // Actualizar botones
        btnRealizarCompra.onclick = function () {
            realizarCompra();
        };
        btnCancelarCompra.onclick = function () {
            cancelarCompra();
        };
        btnVaciarCarro.onclick = function () {
            vaciarCarro();
        };
    }

    // Función para aumentar la cantidad de un producto en el carro
    window.aumentarCantidad = function (index) {
        const producto = carrito[index];
        if (producto.cantidad < producto.cantidadCarro + 1) {
            producto.cantidadCarro++;
            renderizarCarro();
            renderizarProductos();
        }
    };

    // Función para disminuir la cantidad de un producto en el carro
    window.disminuirCantidad = function (index) {
        const producto = carrito[index];
        if (producto.cantidadCarro > 1) {
            producto.cantidadCarro--;
            renderizarCarro();
            renderizarProductos();
        }
    };

    // Función para realizar la compra
    function realizarCompra() {
        // Actualizar la BD y restar los productos comprados
        carrito.forEach((producto) => {
            const productoBD = productos.find((p) => p.nombre === producto.nombre);
            if (productoBD) {
                productoBD.cantidad -= producto.cantidadCarro;
            }
        });

        // Vaciar el carro
        carrito = [];

        // Actualizar las vistas
        renderizarProductos();
        renderizarCarro();
    }

    // Función para cancelar la compra
    function cancelarCompra() {
        // No se realiza ninguna acción en la BD
        // Se mantiene el carro como está
        renderizarCarro();
    }

    // Función para vaciar el carro
    function vaciarCarro() {
        // Devolver la cantidad de productos al estado inicial
        carrito.forEach((producto) => {
            const productoBD = productos.find((p) => p.nombre === producto.nombre);
            if (productoBD) {
                productoBD.cantidad += producto.cantidadCarro;
            }
        });

        // Vaciar el carro
        carrito = [];

        // Actualizar las vistas
        renderizarProductos();
        renderizarCarro();
    }

    // Inicializar la página
    renderizarProductos();
    renderizarCarro();
});
