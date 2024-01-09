// app.js
var app = angular.module('animalApp', []);

app.controller('AnimalController', function ($scope, $http) {
    $scope.animals = [];
    $scope.results = {};
    $scope.gameStarted = false;

    // Cargar el arreglo de animales desde el archivo JSON
    $http.get('json/animales.json')
        .then(function (response) {
            $scope.animals = response.data;
            console.log($scope.animals);
        })
        .catch(function (error) {
            console.error('Error al cargar el archivo JSON:', error);
        });

    $scope.start = function () {
        $('#zonatest').show();
    };

    $scope.startGame = function (level) {
        // Lógica para iniciar el juego
        $scope.gameStarted = true;
        switch (level) {
            case "facil":
                $scope.filteredAnimals = $scope.animals.filter(function (animal) {
                    return animal.tipo === "0";
                });
                break;

            case "medio":
                $scope.filteredAnimals = $scope.animals.filter(function (animal) {
                    return animal.tipo === "1";
                });
                break;

            case "dificil":
                $scope.filteredAnimals = $scope.animals.filter(function (animal) {
                    return animal.tipo === "2";
                });
                break;
        }
    };

    $scope.checkAnswer = function (event, id, selectedAnswer, correctIndex) {
        var elementoDeDatos = $scope.animals.find(function (elemento) {
            return elemento.id === id;
        });

        if (elementoDeDatos.answered == "false") {
            var correctIndex = "R" + ++correctIndex;
            var correctAnimalName = elementoDeDatos[correctIndex];

            if (selectedAnswer === correctAnimalName) {
                $scope.results[selectedAnswer] = 'Correcto';
            } else {
                $scope.results[selectedAnswer] = 'Incorrecto';
            }

            elementoDeDatos.answered = true;
            event.target.classList.add('seleccionado');

            console.log("Animal ID:", id);
            console.log("Selected Answer:", selectedAnswer);
            console.log("Correct Index:", correctIndex);
            console.log($scope.results);

            if (Object.keys($scope.results).length == $scope.filteredAnimals.length) {
                $('#zonaresultados').show();
            }

        } else {
            console.log("Este animal ya ha sido respondido.");
        }
    };

    $scope.checkResults = function () {

    }

    $scope.resetGame = function () {
        $scope.animals.forEach(function (animal) {
            animal.answered = "false";
        });
        $scope.results = {};
        $scope.gameStarted = false;
        $('.seleccionado').removeClass('seleccionado');
        $('#zonaresultados').hide();
    }
});
