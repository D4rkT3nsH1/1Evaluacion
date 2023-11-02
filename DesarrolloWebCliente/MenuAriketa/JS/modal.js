$(document).ready(function () {
    var platosSeleccionados = [];
    var descuento = 1;
    var precioTotal = 0;

    if (window.location === "ELEGIR_PRODUCTO.html?view=platos#") {
        $('#comboMenus').hide();
    }

    function actualizarPrecioTotal() {
        precioTotal = 0;
        for (var i = 0; i < platosSeleccionados.length; i++) {
            precioTotal += platosSeleccionados[i].precio;
        }
        $("#precioTotal").text("Precio Total: " + precioTotal + "€");
    }

    function mostrarPlatosSeleccionados() {
        var listaPlatos = $("#listaPlatosSeleccionados");
        listaPlatos.empty();

        for (var i = 0; i < platosSeleccionados.length; i++) {
            var listItem = $("<li>").text(platosSeleccionados[i].titulo + " ===> Precio: " + platosSeleccionados[i].precio + "€");
            listaPlatos.append(listItem);
        }
    }

    function aplicarDescuento() {
        var precioPostDescuento = precioTotal * descuento;
        $('#precioTotalPostDescuento').text("Precio post descuento " + precioPostDescuento + "€");
    }

    function cargarPlatosEnSeccion(platos, seccionId) {
        var seccion = $("#" + seccionId);
        seccion.empty();

        for (var i = 0; i < platos.length; i++) {
            var cardHtml = `
            <div class="card" data-basico="${platos[i].basico}" data-especial="${platos[i].especial}">
              <img src="${platos[i].imagen}" alt=""/>
              <p>${platos[i].titulo}</p>
              <p><span>${platos[i].precio}€</span><input type="checkbox" class="classCheckbox" value="${platos[i].precio}" data-titulo="${platos[i].titulo}">Seleccionar</p>
            </div>
          `;
            seccion.append(cardHtml);
        }
    }

    $.getJSON("JSON/datosPlatos.json", function (data) {
        cargarPlatosEnSeccion(data[0].datos, "PrimerosPlatos");
        cargarPlatosEnSeccion(data[1].datos, "SegundosPlatos");
        cargarPlatosEnSeccion(data[2].datos, "PostresPlatos");
    });

    $(document).on("change", ".classCheckbox", function () {
        var precioPlato = parseFloat($(this).val());
        var tituloPlato = $(this).data("titulo");

        if (this.checked) {
            platosSeleccionados.push({ titulo: tituloPlato, precio: precioPlato });
        } else {
            platosSeleccionados = platosSeleccionados.filter(function (plato) {
                return plato.titulo !== tituloPlato;
            });
        }

        mostrarPlatosSeleccionados();
        actualizarPrecioTotal();
    });

    $("#elemCompra").click(function () {
        if (platosSeleccionados.length === 0) {
            alert("Debes seleccionar al menos un plato.");
            return;
        }

        $("#Pedido").fadeIn(400);
    });

    $("#edad").keyup(function () {
        var edad = parseInt($(this).val());
        if (isNaN(edad)) {
            $("#direccion").prop("disabled", true);
            $("#btnComprar").prop("disabled", true);
            return;
        }

        if (edad < 18) {
            $("#descuento").text("Descuento del 10%");
            $("#precioTotalPostDescuento").show();
            descuento = 0.9;
            aplicarDescuento();
        } else if (edad > 65) {
            $("#descuento").text("Descuento del 20%");
            $("#precioTotalPostDescuento").show();
            descuento = 0.8;
            aplicarDescuento();
        } else {
            $("#descuento").text("");
            $("#precioTotalPostDescuento").hide();
            descuento = 1;
            aplicarDescuento();
        }

        $("#direccion").prop("disabled", false);
    });

    $("#direccion").on("input", function () {
        if ($(this).val().trim() === "") {
            $("#btnComprar").prop("disabled", true);
        } else {
            $("#btnComprar").prop("disabled", false);
        }
    });

    $("#btnComprar").click(function () {
        alert("Pedido realizado");
        window.location.href = "index.html";
    });

    $("#btnCancelar").click(function () {
        $("#Pedido").fadeOut(500);
    });
});
