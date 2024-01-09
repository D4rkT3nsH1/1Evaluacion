var app = angular.module("app", []);
app.controller('PruebaController', function ($scope) {
    $scope.estilo = {
        color: "#FFFFFF",
        backgroundColor: 'black'
    }
    $scope.mensaje = "HOLA MUNDO";
    $scope.CambiarColor = function () {
        $scope.estilo.color = "#FF0000"
    }
})