<?php
require 'persistencia/EncuestaDAO.php';
require_once 'persistencia/Conexion.php';

class Encuesta {
    private $id;
    private $rol;
    private $fecha;
    private $estado;
    private $encuestaDAO;
    private $conexion;
    
    function getId(){
        return $this->id;
    }

    function getRol(){
        return $this->rol;
    }

    function getFecha(){
        return $this->fecha;
    }

    function getEstado(){
        return $this->estado;
    }


   function setId($id){
        $this->id = $id;
    }

    function setRol($rol){
        $this->rol = $rol;
    }

   function setFecha($fecha){
        $this->fecha = $fecha;
    }

    function setEstado($estado){
      $this->estado = $estado;
    }


    function Encuesta($id="", $rol="", $fecha="", $estado=""){
        $this -> id = $id;
        $this -> rol = $rol;
        $this -> fecha = $fecha;
        $this -> estado = $estado;
        $this -> conexion = new Conexion();
        $this -> encuestaDAO = new EncuestaDAO($id, $rol, $fecha, $estado);
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> rol = $resultado[1];
        $this -> fecha = $resultado[2];
        $this -> estado = $resultado[3];
        $this -> conexion -> cerrar();
    }
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> consultarTodos());
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Encuesta($registro[0],$registro[1],$registro[2],$registro[3]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> registrar());
        $id = $this -> conexion -> ultimoId();
        $this -> conexion -> cerrar();
        return $id;
    }
    
    function eliminar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> eliminarPreguntas());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> eliminarEncuesta());
        $this -> conexion -> cerrar();
    }
    
    function modificar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> modificar());
        $this -> conexion -> cerrar();
    }
    
    function cambiarEstado(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> cambiarEstados());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> cambiarEstado());
        $this -> conexion -> cerrar();
    }
  
    
}
?>