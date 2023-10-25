$(document).ready(function () {

    function mostrarTodas() {
        $(".pelis_accion, .pelis_historica, .pelis_infantil, .series_accion, .series_historica, .series_infantil").each(function () {
            $(this).parent().show();
        });
    }

    function ocultarTodas() {
        $(".pelis_accion, .pelis_historica, .pelis_infantil, .series_accion, .series_historica, .series_infantil").each(function () {
            $(this).parent().hide();
        });
    }

    var textoPeli;

    $(".pelis_accion, .pelis_historica, .pelis_infantil, .series_accion, .series_historica, .series_infantil").on("click", function () {
        textoPeli = $(this).closest("figure").find("div");
        $('.texto').hide();
        textoPeli.addClass("texto");
        textoPeli.removeAttr("style");
    });

    $(document).on("click", ".texto", function () {
        $(this).hide();
    });

    $("#header").on("click", function () {
        mostrarTodas();
    });

    $("#accion").on("click", function (event) {
        event.preventDefault();
        ocultarTodas();
        $(".series_accion, .pelis_accion").each(function () {
            $(this).parent().show();
        });
    });

    $("#historicas").on("click", function (event) {
        event.preventDefault();
        ocultarTodas();
        $(".series_historica, .pelis_historica").each(function () {
            $(this).parent().show();
        });
    });

    $("#infantiles").on("click", function (event) {
        event.preventDefault();
        ocultarTodas();
        $(".series_infantil, .pelis_infantil").each(function () {
            $(this).parent().show();
        });
    });
});
