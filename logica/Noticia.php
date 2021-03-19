<?php
require 'persistencia/NoticiaDAO.php.php';
require_once 'persistencia/Conexion.php';

class Categoria {
    private $id;
    private $nombre;
    private $descripcion;
    private $valor;
    private $rol;
    private $categoriaDAO;
    private $conexion;
    
    function getRol(){
        return $this-> rol;
    }
    
    function setRol($rol){
        $this-> rol = $rol;
    }
    
    function getId(){
        return $this-> id;
    }
    
    function setId($id){
        $this-> id = $id;
    }
    
    function getNombre(){
        return $this-> nombre;
    }
    
    function setNombre($nombre){
        $this-> nombre = $nombre;
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
    function Categoria($id="", $nombre="", $descripcion="", $valor="", $rol=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> valor = $valor;
        $this -> rol = $rol;
        $this -> conexion = new Conexion();
        $this -> categoriaDAO = new CategoriaDAO($id, $nombre, $descripcion, $valor, $rol);
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> descripcion = $resultado[2];
        $this -> valor = $resultado[3];
        $this -> rol = $resultado[4];
        $this -> conexion -> cerrar();
    }
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> consultarTodos());
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Categoria($registro[0],$registro[1],$registro[2],$registro[3]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function existeCategoria(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> existeCategoria());
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
        $this -> conexion -> ejecutar($this -> categoriaDAO -> eliminarOpciones());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> eliminarPreguntas());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> eliminarVariables());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> eliminarIndicadores());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> eliminarCategoria());
        $this -> conexion -> cerrar();
    }
    
    function cantidadIndicadores(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> cantidadIndicadores());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    
    function modificar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> modificar());
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
    
    function completa() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> completa());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    
    function valorCategoria(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> categoriaDAO -> valorCategoria());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
}
?>