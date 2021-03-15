<?php
require 'persistencia/OpcionDAO.php';
require_once 'persistencia/Conexion.php';

class Opcion {
    private $id;
    private $descripcion;
    private $valor;
    private $pregunta;
    private $opcionDAO;
    private $conexion;
    
    function getPregunta(){
        return $this-> pregunta;
    }
    
    function setPregunta($pregunta){
        $this-> pregunta = $pregunta;
    }
    
    function getId(){
        return $this-> id;
    }
    
    function setId($id){
        $this-> id = $id;
    }
    
    function getDescripcion(){
        return $this-> descripcion;
    }
    
    function setDescripcion($descripcion){
        $this-> descripcion = $descripcion;
    }
    
    function getValor(){
        return $this-> valor;
    }
    
    function setValor($valor){
        $this-> valor = $valor;
    }
    function Opcion($id="", $descripcion="", $valor="", $pregunta=""){
        $this -> id = $id;
        $this -> descripcion = $descripcion;
        $this -> valor = $valor;
        $this -> pregunta = $pregunta;
        $this -> conexion = new Conexion();
        $this -> opcionDAO = new OpcionDAO($id, $descripcion, $valor, $pregunta);
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> opcionDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> descripcion = $resultado[1];
        $this -> valor = $resultado[2];
        $this -> pregunta = $resultado[3];
        $this -> conexion -> cerrar();
    }
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> opcionDAO -> consultarTodos());
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Opcion($registro[0],$registro[1],$registro[2],$registro[3]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> opcionDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function existeOpcion(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> opcionDAO -> existeOpcion());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;
        }
    }
    
    function eliminar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> opcionDAO -> eliminar());
        $this -> conexion -> cerrar();
    }
    
    function modificar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> opcionDAO -> modificar());
        $this -> conexion -> cerrar();
    }
    
    function limitar_cadena($limite){
        // Si la longitud es mayor que el límite...
        if(strlen($this -> descripcion) > $limite){
            // Entonces corta la cadena y ponle el sufijo
            return substr($this -> descripcion, 0, $limite) . "...";
        }
        
        // Si no, entonces devuelve la cadena normal
        return $this -> descripcion;
    }
    
}
?>