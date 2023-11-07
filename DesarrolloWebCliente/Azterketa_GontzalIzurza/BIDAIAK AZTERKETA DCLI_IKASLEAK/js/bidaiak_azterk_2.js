tarjetas = [["AMERICA", "Machu Picchu Peru", "IRUDIAK/machu picchu.jpg", "10", "2100"],
["ASIA", "Vietnam", "IRUDIAK/vietnam.jpg", "1", "2800"],
["AFRICA", "Cataratas Victoria", "IRUDIAK/africa victoria.jpg", "11", "3000"],
["EUROPA", "Croacia", "IRUDIAK/croacia.jpg", "8", "1200"],
["OCEANIA", "Australia", "IRUDIAK/australia.jpg", "2", "3200"],
["ASIA", "Taj Mahal", "IRUDIAK/tajmahal.jpg", "4", "2500"],
["AFRICA", "Piramides de Egipto", "IRUDIAK/egipto.jpg", "7", "2100"],
["EUROPA", "Roma", "IRUDIAK/roma.jpg", "6", "1000"],
["AMERICA", "Amazonas", "IRUDIAK/ecuadoramazonia.jpg", "0", "2300"],
["OCEANIA", "Nueva Zelanda", "IRUDIAK/new_zealand.jpg", "11", "3400"]];

texto = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac bibendum purus. Cras gravida, nisl at egestas pharetra, sapien sapien varius tellus, imperdiet laoreet urna ante ac elit. Nullam ac libero non ante luctus egestas id a erat. Fusce id diam in ante blandit porttitor et sit amet dolor"


var formulario2 = document.getElementById("formulario2");
var selectContinent = document.getElementById("selectContinent");
var selectTravel = document.getElementById("selectTravel");
var cardsDiv = document.getElementById("divSeccion");
var cardDiv = document.createElement("div");
var cardDiv2 = document.createElement("div");

var meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
var mes = "";
var precio = 0;

document.getElementById("btnSubmit").addEventListener("click", function (event) {
    event.preventDefault();

    var menoresFree = parseInt(document.getElementById("menoresFree").value);
    var menores = parseInt(document.getElementById("menores").value);
    var de18a65 = parseInt(document.getElementById("de18a65").value);
    var masde65 = parseInt(document.getElementById("masde65").value);

    var totalPersons = menoresFree + menores + de18a65 + masde65;
    if (totalPersons > 7) {
        document.getElementById("menoresFree").value = 0;
        document.getElementById("menores").value = 0;
        document.getElementById("de18a65").value = 0;
        document.getElementById("masde65").value = 0;

        alert("No pueden ser más de 7 personas")
    } else {

        formulario2.style.display = "block"

        var precioMenoresFree = 0;
        var precioMenores = precio * 0.7;
        var precioDe18a65 = precio;
        var precioMasde65 = precio * 0.8;

        var totalPrice = (menoresFree * precioMenoresFree) +
            (menores * precioMenores) +
            (de18a65 * precioDe18a65) +
            (masde65 * precioMasde65);

        document.getElementById("menorFreeReserva").value = menoresFree;
        document.getElementById("menorFreePrice").value = precioMenoresFree;
        document.getElementById("menorFreeTot").value = menoresFree * precioMenoresFree;

        document.getElementById("menoresReserva").value = menores;
        document.getElementById("menoresPrice").value = precioMenores;
        document.getElementById("menoresTot").value = menores * precioMenores;

        document.getElementById("adultoReserva").value = de18a65;
        document.getElementById("adultoPrice").value = precioDe18a65;
        document.getElementById("adultoTot").value = de18a65 * precioDe18a65;

        document.getElementById("more65Reserva").value = masde65;
        document.getElementById("more65Price").value = precioMasde65;
        document.getElementById("more65Tot").value = masde65 * precioMasde65;

        document.getElementById("priceReser").value = precio;
        document.getElementById("totalPrice").value = totalPrice;
    }

});

function updateContent() {
    var selectedOption = selectTravel.options[selectTravel.selectedIndex];
    if (selectedOption) {
        var imagenURL = "";


        for (var i = 0; i < tarjetas.length; i++) {
            if (tarjetas[i][1] === selectedOption.value) {
                imagenURL = tarjetas[i][2];
                mes = tarjetas[i][3];
                precio = tarjetas[i][4];
                break;
            }
        }

        if (imagenURL) {
            cardDiv.classList.add("irudia");
            cardDiv2.classList.add("texto");
            cardDiv.innerHTML = `
                <h3>${selectedOption.value}</h3>
                <img src="${imagenURL}" alt="${selectedOption.value}" />
            `;
            cardDiv2.innerHTML = `
            <p>${texto}</p>
            `;
        }
    }
    var nombreMes = meses[parseInt(mes)];

    document.getElementById("dateDeparture").value = nombreMes;
    var labelTemporada = document.getElementById("temporada");
    if (mes == 6 || mes == 7 || mes == 11) {
        labelTemporada.innerHTML = "High season";
    } else if (mes == 9 || mes == 10 || mes == 1) {
        labelTemporada.innerHTML = "Low season";
    } else {
        labelTemporada.innerHTML = "";
    }


    if (labelTemporada.textContent == "High season") {
        labelTemporada.style.display = "block";
        labelTemporada.style.backgroundColor = "";
    } else if (labelTemporada.textContent == "Low season") {
        labelTemporada.style.display = "block";
        labelTemporada.style.backgroundColor = "green";
    } else {
        labelTemporada.style.display = "none";
    }
}

selectTravel.addEventListener("change", updateContent);
updateContent();

selectContinent.addEventListener("change", function () {
    var selectedContinent = selectContinent.value;

    var selectedOption;

    selectTravel.innerHTML = "";

    for (var i = 0; i < tarjetas.length; i++) {
        if (tarjetas[i][0] === selectedContinent) {
            var option = document.createElement("option");
            option.text = tarjetas[i][1];
            option.value = tarjetas[i][1];
            selectTravel.appendChild(option);

            if (!selectedOption) {
                selectedOption = option;
            }
        }
    }

    if (selectedOption) {
        updateContent();

        var firstChild = cardsDiv.firstChild;

        if (firstChild) {
            cardsDiv.removeChild(firstChild);
        }

        cardsDiv.appendChild(cardDiv);
        cardsDiv.appendChild(cardDiv2);
    }

});