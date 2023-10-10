<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario_vista
 *
 * @author irakaslea
 */
class Usuario_vista
{

    //put your code here
    public function cargarFormulario($nombre = NULL, $pass1 = NULL, $pass2 = NULL)
    {
        ?>
        <form method="POST" action="">
            <div class="container">
                <div style="display:block">
                    <label><b>Username</b></label>
                    <input type="text" placeholder="Enter Username" name="user" />
                </div>

                <div style="display:block">
                    <label><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="pass" />
                </div>

                <div style="display:block">
                    <label><b>Repite Password</b></label>
                    <input type="password" placeholder="Enter Password2" name="pass2" />
                </div>
                <input type="radio" value="Select" name="opcion" />Select
                <input type="radio" value="Insert" name="opcion" />Insert
                <input type="radio" value="Update" name="opcion" />Update
                <input type="radio" value="Delete" name="opcion" />Delete
                <br>
                <input type="submit" value="Ejecutar" name="boton" />
            </div>
        </form>
        <?php
    }

    public function formModificador($user, $password)
    {
        ?>
        <form method="POST">
            <div class="container">
                <div style="display:block">
                    <input type="hidden" name="user" value="<?php echo $user; ?>">
                    <input type="hidden" name="password" value="<?php echo $password; ?>">
                    <label><b>Nuevo password</b></label>
                    <input type="text" placeholder="Nuevo password" name="nuevo_pass" />
                </div>
                <input type="submit" name="btnModificar" value="Modificar">
        </form>
        </div>
        <?php
    }

    public function verUsuarios($usuarios)
    {
        ?>
        <table border="1">
            <tr>
                <th>Usuario</th>
                <th>Password</th>
            </tr>
            <?php
            foreach ($usuarios as $usuario) {
                ?>
                <tr>
                    <td>
                        <?php echo ($usuario->User); ?>
                    </td>
                    <td>
                        <?php echo ($usuario->Password); ?>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
        <?php
    }

    public function mensajeError($mensaje)
    {
        ?>
        <div style="color:red">
            <?php echo $mensaje; ?>
        </div>
        <?php
    }

    public function mensajeOk($mensaje)
    {
        ?>
        <div style="color:green">
            <?php echo $mensaje; ?>
        </div>
        <?php
    }

}

//fin clase
