document.addEventListener("DOMContentLoaded", function () {
    Componentes();
});

// Esta funcion nos servira para ver una lista de componenetes, para eso creamos un div donde se meteran cartas
function Componentes() {
    var url = "/controller/controller_getComponentes.php";

    fetch(url)

        .then(res => res.json()).then(result => {

            var componente = result.componentes;
          //  console.log(componente)


            for (var i = 0; i < componente.length; i++) {
                var html =/*html*/`
                    <div class="carta ${i}">
                        <h3>Tipo ${componente[i].tipo}</h3>
                        <h3>Marka ${componente[i].objMarca.nombre}</h3>
                        <img class="producto_img" src="${componente[i].img_componentes}">
                        <p>Prezioa ${componente[i].precio}$</p>
                        <button type='button' class='btn btn-outline-success'>Erosi</button>
                    </div>
                    `
                document.getElementById("section").innerHTML += html
            }

            document.querySelectorAll(".componentes").forEach(el => {
                el.addEventListener('click', event => {
                    

                    document.getElementById("section").innerHTML = ""

                    for (var i = 0; i < componente.length; i++) {
                        if (event.target.id == componente[i].tipo) {

                            var html =/*html*/`
                            <div class="carta ${i}">
                                <h3>Tipo ${componente[i].tipo}</h3>
                                <h3>Marka ${componente[i].objMarca.nombre}</h3>
                                <img src="${componente[i].img_componentes}">
                                <p>Prezioa ${componente[i].precio}$</p>
                                <button type='button' class='btn btn-outline-success'>Erosi</button>
                            </div>
                            `

                            document.getElementById("section").innerHTML += html

                        }
                    }

                    // console.log(event.target)
                    // console.log(event.target.id)
                })
            })

        })
        .catch(error => console.error('Error status:', error));

}