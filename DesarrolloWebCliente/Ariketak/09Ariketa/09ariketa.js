function Bikoitiak() {

  let recuentoNumeros = 0;
  let body = document.getElementsByTagName("body")[0];
  let tabla = document.createElement("table");
  let tblBody = document.createElement("tbody");
  let numerosBikoiti = [];


  for (let index = 0; index <= 100; index++) {
    if (index % 2 == 0) {
      numerosBikoiti.push(index)
    }
  }

  for (let i = 0; i < 10; i++) {
    let hilera = document.createElement("tr");

    for (let j = 0; j < 5; j++) {
      let celda = document.createElement("td");
      recuentoNumeros++;
      let textoCelda = document.createTextNode(numerosBikoiti[recuentoNumeros]);
      celda.appendChild(textoCelda);
      hilera.appendChild(celda);
    }

    tblBody.appendChild(hilera);
  }

  tabla.appendChild(tblBody);
  body.appendChild(tabla);
  tabla.setAttribute("border", "2");

}