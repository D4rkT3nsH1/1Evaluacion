function alerta(param) {
    window.alert("Has clickado " + param)
}

document.addEventListener("DOMContentLoaded", function() {

    elements = document.querySelectorAll("input");
    elements.array.forEach(element => {
        element.addEventListener("click", function(){
            alert(this.value)
        })
    });
} )