function izena() {
    let izena = window.prompt('Como te llamas?')
    agurra(izena)
}

function agurra(izena){
let froga = document.getElementById("froga")
froga.innerHTML("Hola " + izena + "!!!")
}