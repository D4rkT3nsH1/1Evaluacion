tarjetas = [["AMERICA", "Machu Picchu Peru", "IRUDIAK/machu picchu.jpg", "10", "2100"], ["ASIA", "Vietnam", "IRUDIAK/vietnam.jpg", "1", "2800"], ["AFRICA", "Cataratas Victoria", "IRUDIAK/africa victoria.jpg", "11", "3000"], ["EUROPA", "Croacia", "IRUDIAK/croacia.jpg", "8", "1200"], ["OCEANIA", "Australia", "IRUDIAK/australia.jpg", "2", "3200"], ["ASIA", "Taj Mahal", "IRUDIAK/tajmahal.jpg", "4", "2500"], ["AFRICA", "Piramides de Egipto", "IRUDIAK/egipto.jpg", "7", "2100"], ["EUROPA", "Roma", "IRUDIAK/roma.jpg", "6", "1000"], ["AMERICA", "Amazonas", "IRUDIAK/ecuadoramazonia.jpg", "0", "2300"], ["OCEANIA", "Nueva Zelanda", "IRUDIAK/new_zealand.jpg", "11", "3400"]]
texto = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam ac bibendum purus. Cras gravida, nisl at egestas pharetra, sapien sapien varius tellus, imperdiet laoreet urna ante ac elit. Nullam ac libero non ante luctus egestas id a erat. Fusce id diam in ante blandit porttitor et sit amet dolor"

var cardsDiv = document.getElementById("seccion");

document.getElementById("btnTravel").addEventListener("click", function () {
    window.open("BIDAIAK_AZTERK_2.html", "BIDAIAK2", "width=700, height=700")
})

window.addEventListener("load", function () {
    tarjetas.forEach((tarjeta) => {
        var [continente, viaje, imagen] = tarjeta;
        var cardDiv = document.createElement("div");
        cardDiv.classList.add("irudia");
        cardDiv.id = continente;
        cardDiv.dataset.id = viaje;


        cardDiv.innerHTML = `
                <h3>${viaje}</h3>
                <img src="${imagen}" alt="${viaje}" />
                <div class="texto">
                <p>${texto}</p>
                </div>
            `;

        cardDiv.addEventListener("click", function () {
            mostrarDetalles(viaje);
        });

        cardsDiv.appendChild(cardDiv);
    });
});

function mostrarDetalles(viaje) {
    var tarjetaSeleccionada = tarjetas.find(tarjeta => tarjeta[1] === viaje);
    if (tarjetaSeleccionada) {
        var [continente, viaje, imagen, mes, precio] = tarjetaSeleccionada;

        var url = `BIDAIAK_AZTERK_2.html?continente=${continente}&viaje=${viaje}&imagen=${imagen}&mes=${mes}&precio=${precio}`;
        var popup = window.open(url, 'Popup', 'width=900, height=700');

        popup.addEventListener("load", function () {
            var selectContinent = popup.document.getElementById("selectContinent");
            var selectTravel = popup.document.getElementById("selectTravel");

            var contenidoViaje = popup.document.getElementById("divSeccion");
            if (contenidoViaje) {
                contenidoViaje.innerHTML = '';
                var cardDiv = popup.document.createElement("div");
                var cardDiv2 = popup.document.createElement("div");

                cardDiv.classList.add("irudia");
                cardDiv2.classList.add("texto");

                cardDiv.innerHTML = `
                <h3>${viaje}</h3>
                <img src="${imagen}" alt="${viaje}" />
                `;
                cardDiv2.innerHTML = `
                <p>${texto}</p>
                `;
            }
            contenidoViaje.appendChild(cardDiv);
            contenidoViaje.appendChild(cardDiv2);

            selectContinent.value = continente;
            var option = popup.document.createElement("option");
            option.text = viaje;
            option.value = viaje;
            selectTravel.appendChild(option);
            selectTravel.value = viaje;

            var event = new Event('change');
            selectTravel.dispatchEvent(event);
        });
    }
}