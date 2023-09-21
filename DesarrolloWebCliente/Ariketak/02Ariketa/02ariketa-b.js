document.addEventListener("DOMContentLoaded", function() {

    let elements = document.querySelectorAll("input");
    elements.forEach(element => {
        element.addEventListener("click", function(){
            alert(element.value)
        })
    });
} )