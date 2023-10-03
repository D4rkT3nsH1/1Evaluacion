var newPass = document.getElementById("newPass");
var radios = document.querySelectorAll("input[type='radio']")

newPass.style.display = "none";

radios.forEach(function (radio) {
    radio.addEventListener("change", function () {
        if (radio.value === "changepassword" && radio.checked) {
            newPass.style.display = "flex";
        } else {
            newPass.style.display = "none";
        }
    });
});
