<?php
require 'persistencia/UsuarioDAO.php';
require_once 'persistencia/Conexion.php';

class Usuario extends Persona {
    private $usuarioDAO;
    private $conexion;
    private $rol;
    private $hash;
    private $estado;
    
    function getEstado(){
        return $this->estado;
    }

    function setEstado($estado){
        $this->estado = $estado;
    }

    function getHash(){
        return $this->hash;
    }

    function setHash($hash){
        $this->hash = $hash;
    }

    function getRol(){
        return $this->rol;
    }
    
    function setRol($rol){
        $this->rol = $rol;
    }

    function Usuario($id="", $nombre="", $apellido="", $correo="", $clave="",$rol="", $hash="", $estado=""){
        $this -> Persona($id, $nombre, $apellido, $correo, $clave);
        $this -> rol = $rol;
        $this -> hash = $hash;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> usuarioDAO = new UsuarioDAO($id, $nombre, $apellido, $correo, $clave, $rol, $hash, $estado);
    }
    
    function existeCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> existeCorreo());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;
        }
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function autenticar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> autenticar());
        if($this -> conexion -> numFilas() == 1){
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];
            $this -> estado = $resultado[1];
            $this -> conexion -> cerrar();
            return true;
        } else {
            $this -> conexion -> cerrar();
            return false;
        }
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> apellido = $resultado[2];
        $this -> correo = $resultado[3];
        $this -> rol = $resultado[4];
        $this -> estado = $resultado[5];
        $this -> conexion -> cerrar();
    }
    
    function verificarCorreo(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> verificarCorreo());
        $resultado = $this -> conexion -> extraer();
        $this -> hash = $resultado[0];
        $this -> conexion -> cerrar();
    }
    
    function actualizarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> actualizarEstado());
        $this -> conexion -> cerrar();
    }
    
    function realizar($encuesta){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> realizar($encuesta));
        $pRealiadas = $this -> conexion -> numFilas();
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> usuarioDAO -> cantidadPreguntas($encuesta));
        $cantPreguntas = $this -> conexion -> numFilas();
        $this -> conexion -> cerrar();
        if($pRealiadas == $cantPreguntas){
            return true;
        } else {
            return false;
        }
    }
}