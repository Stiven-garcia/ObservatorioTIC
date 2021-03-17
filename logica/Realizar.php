<?php
require 'persistencia/RealizarDAO.php';
require_once 'persistencia/Conexion.php';

class Realizar {
    private $fecha;
    private $usuario;
    private $respuesta;
    private $pregunta;
    private $realizarDAO;
    private $conexion;
    

    function getFecha()
    {
        return $this->fecha;
    }

    function getUsuario()
    {
        return $this->usuario;
    }

    function getRespuesta()
    {
        return $this->respuesta;
    }

    function getPregunta()
    {
        return $this->pregunta;
    }

    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    function setUsuario($usuario)
    {
        $this->usuario = $usuario;
    }

    function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;
    }

    function setPregunta($pregunta)
    {
        $this->pregunta = $pregunta;
    }

    function Realizar($fecha="", $usuario="", $respuesta="", $pregunta=""){
        $this -> fecha = $fecha;
        $this -> usuario = $usuario;
        $this -> respuesta = $respuesta;
        $this -> pregunta = $pregunta;
        $this -> conexion = new Conexion();
        $this -> realizarDAO = new RealizarDAO($fecha, $usuario, $respuesta, $pregunta);
    }
    
    function consultar($idEncuesta){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> realizarDAO -> consultar($idEncuesta));
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Encuesta($registro[0],$registro[1],$registro[2],$registro[3]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function verificar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> realizarDAO -> verificar());
        if($this -> conexion -> numFilas() == 1){
            $this -> conexion -> cerrar();
            return true;
        } else {
            $this -> conexion -> cerrar();
            return false;
        }
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> realizarDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
}
?>
