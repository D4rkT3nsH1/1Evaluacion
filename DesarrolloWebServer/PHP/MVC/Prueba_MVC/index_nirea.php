<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PruebaReto2Proba</title>
        <link rel="stylesheet" media="all" type="text/css" href="estilo.css" />
    </head>
    <body>
        <?php
        include_once 'Usuario_model.php';
        include_once 'Usuario_vista.php';

        $usuario_vista = new Usuario_vista();
        $usuario_vista->cargarFormulario();
        ?>

        <!--info eta gainerakoak-->
        <?php
        //print_r($_POST);
        if (isset($_POST['boton']) && !empty($_POST['opcion'])) {//si viene de un submity con opcion rellena
            //swicth principal con diferentes operaciones
            switch ($_POST['opcion']) {
                case "Select":
                    if (!empty($_POST['user']) && !empty($_POST['pass'])) {//validacion de campos rellenos
                        $usuario = new Usuario_model();
                        $usuario->conectar();
                        if ($usuario->validado($_POST['user'], $_POST['pass'])) {
                            //usuario existe en sistema, mostrar usuaios
                            $usuario_vista->verUsuarios($usuario->consulta());
                        } else {//usuario y pass no existen en sistema
                            $usuario_vista->mensajeError('Usuario o contraseña mal');
                        }
                    } else {//campos no rellenos
                        $usuario_vista->mensajeError('Falta usuario o password');
                    }
                    break;
                case "Insert":
                    if ((!empty($_POST['user']) && !empty($_POST['pass']) && !empty($_POST['pass2']))) {//validacion de campos rellenos
                        if ($_POST['pass'] == $_POST['pass2']) {//pass1 y 2 iguales
                            $usuario = new Usuario_model();
                            $usuario->conectar();

                            if (!$usuario->existe($_POST['user'])) {
                                //el usuario no existe, insertar
                                $usuario->alta($_POST['user'], $_POST['pass']);
                                $usuario_vista->mensajeOk('Usuario ' . $_POST['user'] . ' registrado');
                            } else {
                                //el suario existe, no hacer nada
                                $usuario_vista->mensajeError('No se puede insertar, el usuario existe');
                            }
                        } else {
                            $usuario_vista->mensajeError('Los passwords no son iguales');
                        }
                    } else {
                        //algun campo vacio
                        $usuario_vista->mensajeError('Falta usuario, password1 o password2');
                    }

                    break;
                case "Update":
                    if (!empty($_POST['user']) && !empty($_POST['pass'])) {//validacion de campos rellenos
                        $usuario = new Usuario_model();
                        $usuario->conectar();
                        if ($usuario->validado($_POST['user'], $_POST['pass'])) {//usuario existe en sistema
                            $usuario_vista->formModificador($_POST['user'], $_POST['pass']);
                            //echo('bien existe');
                        } else {//usuario y pass no existen en sistema
                            $usuario_vista->mensajeError('Usuario o contraseña mal');
                        }
                    } else {//campos no rellenos
                        $usuario_vista->mensajeError('Falta usuario o password');
                    }

                    break;
                case "Delete":
                    if (!empty($_POST['user']) && !empty($_POST['pass'])) {//validacion de campos rellenos
                        $usuario = new Usuario_model();
                        $usuario->conectar();
                        if ($usuario->validado($_POST['user'], $_POST['pass'])) {//usuario existe en sistema
                            $usuario->baja($_POST['user'], $_POST['pass']);
                            $usuario_vista->mensajeOk('Usuario eliminado');
                        } else {//usuario y pass no existen en sistema
                            $usuario_vista->mensajeError('Usuario o contraseña mal');
                        }
                    } else {//campos no rellenos
                        $usuario_vista->mensajeError('Falta usuario o password');
                    }

                    break;

                default:
                    break;
            }
            //FIN swicth principal con diferentes operaciones
        } elseif (isset($_POST['btnModificar'])) {//Hay que modificar el password
            $usuario = new Usuario_model();
            $usuario->conectar();
            if (!empty($_POST['nuevo_pass'])) {//contrasena rellena
                $usuario->modificarPassword($_POST['user'], $_POST['nuevo_pass']);
                $usuario_vista->mensajeOk('Contrasena cambiada');
            } else {
                //contrasena vacia
                $usuario_vista->formModificador($_POST['user'], $_POST['password']);
                $usuario_vista->mensajeError("Contrasena vacia");
            }
        }
        ?>

    </body>
</html>
