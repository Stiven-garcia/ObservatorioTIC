<?php
require 'persistencia/EncuestaDAO.php';
require_once 'persistencia/Conexion.php';

class Encuesta {
    private $id;
    private $rol;
    private $fecha;
    private $estado;
    private $activada;
    private $encuestaDAO;
    private $conexion;
    
    function getActivada(){
        return $this-> activada;
    }
    
    function setActivada($activada){
        $this->activada = $activada;
    }
    
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


    function Encuesta($id="", $rol="", $fecha="", $estado="", $activada=""){
        $this -> id = $id;
        $this -> rol = $rol;
        $this -> fecha = $fecha;
        $this -> estado = $estado;
        $this -> activada = $activada;
        $this -> conexion = new Conexion();
        $this -> encuestaDAO = new EncuestaDAO($id, $rol, $fecha, $estado, $activada);
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> rol = $resultado[1];
        $this -> fecha = $resultado[2];
        $this -> estado = $resultado[3];
        $this -> activada = $resultado[4];
        $this -> conexion -> cerrar();
    }
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> consultarTodos());
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Encuesta($registro[0],$registro[1],$registro[2],$registro[3], $registro[4]);
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
        $this -> conexion -> ejecutar($this -> encuestaDAO -> eliminarOpciones());
        $this -> conexion -> cerrar();
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
    
    function cambiarActivada(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> cambiarActivada());
        $this -> conexion -> cerrar();
    }
    
    function activarUsuarios(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> activarUsuarios());
        $this -> conexion -> cerrar();
    }
    
    function cantidadPreguntas(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> cantidadPreguntas());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    
    function completa() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> completa());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    function valorCategorias() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> valorCategorias());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    
    function verificarEncuesta(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> encuestaDAO -> verificarEncuesta());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $resultado = $this -> conexion -> extraer();
            $this -> id = $resultado[0];
            $this -> conexion -> cerrar();
            return true;
        }
    }
}
?>