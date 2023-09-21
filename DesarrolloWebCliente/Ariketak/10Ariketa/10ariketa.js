var numRandom = 0;
var numUsuario;
var numIntentos = 0;
var intentos = [];

function ActivarJuego() {
    document.getElementById("juego").style.display = "flex";
    numRandom = Math.round(Math.random() * (50 - 1) + 1)
    console.log(numRandom)
}

function AdivinarNumero() {

    numUsuario = document.getElementById("numUsuario")
    console.log(numUsuario.value)

    intentos = document.getElementsByClassName('eleccion');

    console.log(intentos);
    console.log(numIntentos);

    if (numUsuario.value > numRandom) {
        document.getElementById('MENSAJE_AYUDA').innerHTML = "El número es menor a " + numUsuario.value;
        document.getElementById('MENSAJE_AYUDA').style.display = "flex";
    } else if (numUsuario.value > 50 || numUsuario.value < 1) {
        document.getElementById('MENSAJE_AYUDA').innerHTML = "El número no es válido (1-50)";
        document.getElementById('MENSAJE_AYUDA').style.display = "flex";
    } else {
        document.getElementById('MENSAJE_AYUDA').innerHTML = "El número es mayor a " + numUsuario.value;
        document.getElementById('MENSAJE_AYUDA').style.display = "flex";
    }

    if (numUsuario.value != numRandom) {
        if (numIntentos < intentos.length) {
            intentos[numIntentos].style.border = '2px solid red';
            intentos[numIntentos].style.backgroundColor = 'rgb(168, 39, 39)';
        }
        numIntentos++
        if (numIntentos == intentos.length) {
            document.getElementById("FALLADO").style.display = "flex";
            document.getElementById('MENSAJE_AYUDA').style.display = "none";
            numIntentos = 0;
        }
    }

    if (numUsuario.value == numRandom) {
        intentos[numIntentos].style.border = '2px solid green';
        intentos[numIntentos].style.backgroundColor = 'rgb(27, 201, 11)';
        document.getElementById("ACERTADO").style.display = "flex";
        document.getElementById('MENSAJE_AYUDA').style.display = "none";
        numIntentos = 0;
    }
}