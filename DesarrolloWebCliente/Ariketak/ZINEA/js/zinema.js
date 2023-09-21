var TotalButacas = [100, 150, 75, 50];
var ButacasLibres = [100, 150, 75, 50];
var numerosGenerados = [];

var SeleccionPeliculas = {
    Apocalypto: 1,
    Frozen: 2,
    Beethoven: 3,
    Braveheart: 4,
    Cube: 5,
    Doraemon: 6,
    Dragonball: 7,
    Isabel: 8,
    Ozzy: 9,
    Scoobydoo: 10,
    Troya: 11
};

var SinopsisPeliculas = {
    1: "ApocalyptoApocalyptoApocalyptoApocalypto",
    2: "FrozenFrozenFrozenFrozen",
    3: "BeethovenBeethovenBeethovenBeethoven",
    4: "BraveheartBraveheartBraveheartBravehear",
    5: "CubeCubeCubeCube",
    6: "DoraemonDoraemonDoraemonDoraemon",
    7: "DragonballDragonballDragonballDragonball",
    8: "IsabelIsabelIsabelIsabel",
    9: "OzzyOzzyOzzyOzzy",
    10: "ScoobydooScoobydooScoobydooScoobydoo",
    11: "TroyaTroyaTroyaTroya"
};

var salasPeli = document.getElementsByClassName('eleccionesPelicula');
var divPelis = document.getElementsByClassName('imagen');

function EleccionPelicula() {
    var numRandom

    for (let index = 0; index < salasPeli.length; index++) {
        do {
            numRandom = Math.round(Math.random() * (11 - 1) + 1);
        } while (numerosGenerados.includes(numRandom));

        numerosGenerados.push(numRandom);

        divPelis[index].setAttribute("id", numRandom);
        salasPeli[index].setAttribute("id", numRandom);
        salasPeli[index].firstChild.setAttribute("src", "IMG/" + numRandom + ".jpg");
    }
    console.log(numerosGenerados)
}

var anteriorDiv = -1;

document.addEventListener("DOMContentLoaded", function () {
    Array.from(divPelis).forEach(function (salaPeli) {
        salaPeli.addEventListener("click", function () {
            var idDelDivClicado = salaPeli.id;
            console.log("ID clicado: " + idDelDivClicado);

            var pelicula = null;
            var sinopsis = null;

            if (anteriorDiv != -1) {
                document.getElementById(anteriorDiv).style.border = "none";
            }
            anteriorDiv = idDelDivClicado;
            document.getElementById(idDelDivClicado).style.border = "5px solid yellow";

            for (const clave in SeleccionPeliculas) {
                if (SeleccionPeliculas[clave] == salaPeli.id) {
                    pelicula = clave;
                    sinopsis = SinopsisPeliculas[salaPeli.id];
                    console.log(pelicula);
                    break;
                }
            }

            document.getElementById("tituloPeli").innerHTML = "Película seleccionada => " + pelicula;
            document.getElementById("sinopsisPeli").innerHTML = "Sinopsis => " + sinopsis;

            if (pelicula != null) {
                document.getElementById("compraentradas").style.display = "block";
            }
        });
    });
});



var numeroEntradas = document.getElementById("numeroEntradas");
var tipoEntrada = document.getElementById("tipo");
var precioEntradaStr = document.getElementById("precio");
var precioEntrada;
var totalEntradas = document.getElementById("total");
var totalCalc;

precioEntrada = 7.9;
precioEntradaStr.value = "7.9 €";

function TipoEntrada() {
    switch (tipoEntrada.value) {
        case "1":
            precioEntradaStr.value = "7.9 €";
            precioEntrada = 7.9;
            break;
        case "2":
            precioEntradaStr.value = "5.5 €";
            precioEntrada = 5.5;
            break;

        default:
            break;
    }

    totalCalc = numeroEntradas.value * precioEntrada;
    totalEntradas.value = totalCalc.toFixed(2);
}

function CheckEntradas() {

}
