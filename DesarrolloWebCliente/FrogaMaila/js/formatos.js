var radios = document.querySelectorAll("input[type='radio']");
var contenidosDiv = document.getElementById("content");

for (var i = 0; i < radios.length; i++) {
    radios[i].addEventListener("click", function () {
        if (this.checked) {
            var radioValue = this.value;
            console.log(radioValue);

            contenidosDiv.addEventListener("mouseover", function (event) {
                if (radioValue == "miColor") {
                    if (event.target.classList.contains("box")) {
                        var idDelDiv = event.target.id;
                        var div = document.getElementById(idDelDiv);
                        div.style.backgroundColor = "red";
                    }
                } else if (radioValue == "miTamano") {
                    if (event.target.classList.contains("box")) {
                        var idDelDiv = event.target.id;
                        var div = document.getElementById(idDelDiv);
                        div.style.fontSize = "40px";
                    }
                }
            });
            contenidosDiv.addEventListener("mouseout", function (event) {
                if (radioValue == "miColor") {
                    if (event.target.classList.contains("box")) {
                        var idDelDiv = event.target.id;
                        var div = document.getElementById(idDelDiv);
                        div.style.backgroundColor = "blue";
                    }
                } else if (radioValue == "miTamano") {
                    if (event.target.classList.contains("box")) {
                        var idDelDiv = event.target.id;
                        var div = document.getElementById(idDelDiv);
                        div.style.fontSize = "15px";
                    }
                }
            });
        }
    });
}
