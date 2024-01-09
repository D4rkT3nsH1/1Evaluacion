// app.js
var app = angular.module('animalApp', []);

app.controller('AnimalController', function ($scope, $http) {
    $scope.animals = [];
    $scope.results = [];
    $scope.gameStarted = false;

    // Cargar el arreglo de animales desde el archivo JSON
    $http.get('json/animales.json')
        .then(function (response) {
            $scope.animals = response.data;
        })
        .catch(function (error) {
            console.error('Error al cargar el archivo JSON:', error);
        });

    $scope.startGame = function (level) {
        // Lógica para iniciar el juego con el nivel seleccionado
        $scope.gameStarted = true;
    };

    $scope.checkAnswer = function (selectedAnswer, correctAnswer) {
        // Lógica para verificar la respuesta del usuario
        if (selectedAnswer === correctAnswer) {
            $scope.results.push('Correcto');
        } else {
            $scope.results.push('Incorrecto');
        }
    };

    $scope.loadResults = function () {
        // Lógica para cargar resultados
    };
});
