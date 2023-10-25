$(document).ready(function () {
   var palabraSecreta;
   var palabraUsuario = null;
   var intentos = 0;
   var letrasAdivinadas = [];

   // Función para generar una palabra aleatoria
   function generarPalabra() {
      if (palabraUsuario != null) {
         return palabraUsuario;
      } else {
         var palabras = ["manzana", "pera", "platano", "uva", "fresa", "sandia"];
         return palabras[Math.floor(Math.random() * palabras.length)];
      }
   }

   // Función para inicializar un nuevo juego
   function iniciarNuevoJuego() {
      palabraSecreta = generarPalabra();
      letrasAdivinadas = [];
      intentos = 0;
      $("#juego").show();
      $("#veces").val(intentos);
      $("#aa").text("");
      $("#cuadros").html("");
      $("#palabraadiv").val("");
      mostrarPalabraConGuiones();
   }

   // Función para mostrar la palabra con guiones bajos para las letras no adivinadas
   function mostrarPalabraConGuiones() {
      var palabraMostrada = "";
      for (var i = 0; i < palabraSecreta.length; i++) {
         if (letrasAdivinadas.indexOf(palabraSecreta[i]) !== -1) {
            palabraMostrada += palabraSecreta[i];
         } else {
            palabraMostrada += "_ ";
         }
      }
      $("#palabraadiv").val(palabraMostrada);
   }

   // Evento para comenzar un nuevo juego
   $("#asmatu").click(function () {
      $('#hitzberria').hide();
      iniciarNuevoJuego();
   });

   $("#berria").click(function () {
      $('#juego').hide();
      $('#hitzberria').show();
   });

   $("#formuhitza").submit(function (event) {
      event.preventDefault();
      palabraUsuario = $('#idatzih').val();
      $('#idatzih').val('');
      $('#hitzberria').hide();
      iniciarNuevoJuego()
   });

   // Evento para adivinar la letra
   $("#formucomprobar").submit(function (event) {
      event.preventDefault();
      var letra = $("#letra").val().toLowerCase();

      if (letrasAdivinadas.indexOf(letra) !== -1) {
         $("#aa").text("Ya has adivinado la letra '" + letra + "'. Inténtalo de nuevo.");
      } else {
         letrasAdivinadas.push(letra);
         mostrarPalabraConGuiones();

         if (palabraSecreta.indexOf(letra) === -1) {
            intentos++;
            $("#veces").val(intentos);
         }

         if (intentos >= 5) {
            $("#aa").text("Has agotado los 5 intentos. La palabra secreta era: " + palabraSecreta);
         } else if (palabraSecreta === $("#palabraadiv").val()) {
            $("#aa").text("¡Felicidades! Has adivinado la palabra secreta: " + palabraSecreta);
            palabraUsuario = null;
         }
      }

      $("#letra").val("");
   });

});
