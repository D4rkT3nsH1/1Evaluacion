$(document).ready(function () {
    var TotalButacas = [100, 150, 75, 50];
    var ButacasLibres = [100, 150, 75, 50];
    var numerosGenerados = [];

    var PeliculasPorId = {
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

    var salasPeli = $('.eleccionesPelicula');
    var divPelis = $('.imagen');

    function enseñarPeliculas() {
        var numRandom;

        salasPeli.each(function (index) {
            do {
                numRandom = Math.round(Math.random() * (11 - 1) + 1);
            } while (numerosGenerados.includes(numRandom));

            numerosGenerados.push(numRandom);

            $(divPelis[index]).attr("id", numRandom);
            $(divPelis[index]).attr("data-id", index);
            $(salasPeli[index]).attr("id", numRandom);
            $(salasPeli[index]).find('img').attr("src", "IMG/" + numRandom + ".jpg");
        });

        console.log(numerosGenerados);
    }

    var anteriorDiv = -1;
    var idDelDivClicado;
    var numSala;

    salasPeli.on("click", function () {
        idDelDivClicado = $(this).attr("id");
        numSala = $(this).parent().data("id");
        console.log("numSala: " + numSala)
        console.log("ID clicado: " + idDelDivClicado);

        var pelicula = null;
        var sinopsis = null;

        if (anteriorDiv != -1) {
            $('#' + anteriorDiv).css("border", "none");
        }
        anteriorDiv = idDelDivClicado;
        $('#' + idDelDivClicado).css("border", "5px solid yellow");

        $.each(PeliculasPorId, function (clave, valor) {
            if (valor == idDelDivClicado) {
                pelicula = clave;
                sinopsis = SinopsisPeliculas[idDelDivClicado];
                console.log(pelicula);
                return false;
            }
        });

        $("#tituloPeli").html("Película seleccionada => " + pelicula);
        $("#sinopsisPeli").html("Sinopsis => " + sinopsis);

        if (pelicula != null) {
            $("#compraentradas").css("display", "block");
        }
    });

    var numeroEntradas = $("#numeroEntradas");
    var tipoEntrada = $("#tipo");
    var precioEntradaStr = $("#precio");
    var precioEntrada;
    var totalEntradas = $("#total");
    var totalCalc;

    precioEntrada = 7.9;
    precioEntradaStr.val("7.9 €");

    tipoEntrada.on("change", function () {
        switch (tipoEntrada.val()) {
            case "1":
                precioEntradaStr.val("7.9 €");
                precioEntrada = 7.9;
                break;
            case "2":
                precioEntradaStr.val("5.5 €");
                precioEntrada = 5.5;
                break;
            default:
                break;
        }
    });
    numeroEntradas.on("input", function () {
        totalCalc = numeroEntradas.val() * precioEntrada;
        totalEntradas.val(totalCalc.toFixed(2));
    });

    $('#formuCompra').submit(function (event) {
        event.preventDefault();
        var numeroEntradasVal = numeroEntradas.val();
        console.log(numeroEntradasVal + " = numEntradas");
        console.log(numSala + " = numSala");

        if (ButacasLibres[numSala] < numeroEntradasVal) {
            window.alert("No hay tantas entradas disponibles");
        } else {
            $("#butacas").html("Butacas totales " + TotalButacas[numSala] + ", butacas libres: " + (ButacasLibres[numSala] - numeroEntradasVal));
            ButacasLibres[numSala] = ButacasLibres[numSala] - numeroEntradasVal;
        }
    });

    enseñarPeliculas();
});