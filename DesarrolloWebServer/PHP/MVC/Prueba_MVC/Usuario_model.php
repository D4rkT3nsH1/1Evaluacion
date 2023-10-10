<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of funciones
 *
 * @author Imanol
 */
class Usuario_model {

    private $mysqli;

    public function conectar() {
        try {

            $this->mysqli = new mysqli('localhost', 'root', '', 'reto2_prueba');
            if ($this->mysqli->connect_errno) {
                throw new Exception('Error al conectar: ' . $this->mysqli->connect_error);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function alta($user, $pass) {
        try {
            $sql = "SELECT User FROM usuario WHERE User = '" . $user . "';";
            $res = $this->mysqli->query($sql);
            if (!empty($res->num_rows)) {
                throw new Exception("Username NO valido para dar de ALTA. Ya existente en la BD");
            } else {
                $sql = "INSERT INTO usuario(User,Password) VALUES('" . $user . "','" . $pass . "');";
                $res = $this->mysqli->query($sql);
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function baja($user, $pass) {
        try {
            $fila = $this->conectarUsuario($user, $pass);
            $sql = "DELETE FROM usuario WHERE ID = " . $fila->ID . ";";
            $this->mysqli->query($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function modificarPassword($user, $pass) {
        try {
            $sql = "SELECT ID FROM usuario WHERE User = '" . $user . "';";
            $res = $this->mysqli->query($sql);
            $fila = $res->fetch_object();
            $sql = "UPDATE usuario SET Password = '" . $pass . "' WHERE ID = " . $fila->ID . ";";
            $this->mysqli->query($sql);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function conectarUsuario($user, $pass) {
        try {
            $sql = "SELECT * FROM usuario WHERE User = '" . $user . "';";
            $res = $this->mysqli->query($sql);
            $fila = $res->fetch_object();
            if (empty($res->num_rows)) {
                throw new Exception("Username NO valido.NO existe en la BD");
            } elseif ($fila->Password !== $pass) {
                throw new Exception("Contraseña erronea");
            }
            return $fila;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function validado($user, $pass) {
        $sql = "SELECT * FROM usuario WHERE User = '" . $user . "' and Password = '" . $pass . "'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function existe($user) {
        $sql = "SELECT * FROM usuario WHERE User = '" . $user . "'";
        $this->mysqli->query($sql);
        if ($this->mysqli->affected_rows == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function consulta() {
        try {
            //  $this->conectarUsuario($user, $pass);
            $sql = "SELECT User, Password FROM usuario;";
            $res = $this->mysqli->query($sql);
            $filas = array();
            for ($i = 0; $i < $res->num_rows; $i++) {
                $fila = $res->fetch_object();
                $filas[] = $fila;
            }
            return $filas;
        } catch (Exception $ex) {
            throw $ex;
        }
    }



        /* public function consulta($user, $pass) {
          try {
          $this->conectarUsuario($user, $pass);
          $sql = "SELECT User FROM usuario;";
          $res = $this->mysqli->query($sql);
          $filas = array();
          for ($i = 0; $i < $res->num_rows; $i++) {
          $fila = $res->fetch_object();
          $filas[] = $fila;
          }
          return $filas;
          } catch (Exception $ex) {
          throw $ex;
          }
          } */
    }
    