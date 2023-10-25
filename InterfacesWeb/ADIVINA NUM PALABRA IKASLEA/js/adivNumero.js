$(document).ready(function () {
    var numaleat, intentos;

    function generarNumeroAleatorio() {
        return Math.floor(Math.random() * 50) + 1;
    }

    function mostrarMensaje(mensaje) {
        $('#tabla td').eq(intentos - 1).css('background-color', 'red');
        $('#resultado').text(mensaje);
    }

    function NuevaPartida() {
        numaleat = generarNumeroAleatorio();
        intentos = 0;
        $('#tabla td').css('background-color', 'white');
    }

    $('#generarNumero').click(function () {
        NuevaPartida();
        $('#resultado').text('');
        $('#gameArea').show();
    });

    $('#comprobar').click(function () {
        intentos++;
        console.log(numaleat);

        var numeroUsuario = parseInt($('#numeroUsuario').val());

        if (isNaN(numeroUsuario)) {
            mostrarMensaje('FALTA INTRODUCIR NUMERO');
        } else if (numeroUsuario > 50) {
            mostrarMensaje('ERROR. EL NUMERO NO PUEDE SER MAYOR QUE 50');
        } else if (numeroUsuario === numaleat) {
            mostrarMensaje('FELICIDADES! Has acertado el número\nEl numero era: ' + numaleat);
            $('#tabla td').css('background-color', 'green');
            $('#comprobar').hide();
            $('#volverJugar').show();
            $('#volverJugar').click(function () {
                NuevaPartida();
                $('#resultado').hide();
                $('#volverJugar').hide();
            });
        } else {
            if (intentos === 5) {
                mostrarMensaje('Ha agotado los 5 intentos SIN ACERTAR\nEl numero era: ' + numaleat);
                $('#tabla td').eq(intentos - 1).css('background-color', 'red');
            } else if (numeroUsuario > numaleat) {
                mostrarMensaje('EL NUMERO DEBE SER MENOR');
            } else {
                mostrarMensaje('EL NUMERO DEBE SER MAYOR');
            }
        }

        $('#numeroUsuario').val('');
    });
});
