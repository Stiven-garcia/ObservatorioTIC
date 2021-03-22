<?php
require 'persistencia/NoticiaDAO.php';
require_once 'persistencia/Conexion.php';

class Noticia {
    private $id;
    private $nombre;
    private $descripcion;
    private $fechaApertura;
    private $fechaCierre;
    private $noticiaDAO;
    private $conexion;
    
    function getId(){
        return $this->id;
    }

    function getNombre(){
        return $this->nombre;
    }

    function getDescripcion(){
        return $this->descripcion;
    }

    function getFechaApertura(){
        return $this->fechaApertura;
    }

    function getFechaCierre(){
        return $this->fechaCierre;
    }

    function setId($id){
        $this->id = $id;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function setDescripcion($descripcion){
        $this->descripcion = $descripcion;
    }

    function setFechaApertura($fechaApertura){
        $this->fechaApertura = $fechaApertura;
    }

    function setFechaCierre($fechaCierre){
        $this->fechaCierre = $fechaCierre;
    }

    function Noticia($id="", $nombre="", $descripcion="", $fechaApertura="", $fechaCierre=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> fechaApertura = $fechaApertura;
        $this -> fechaCierre = $fechaCierre;
        $this -> conexion = new Conexion();
        $this -> noticiaDAO = new NoticiaDAO($id, $nombre, $descripcion, $fechaApertura, $fechaCierre);
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> noticiaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> descripcion = $resultado[2];
        $this -> fechaApertura = $resultado[3];
        $this -> fechaCierre = $resultado[4];
        $this -> conexion -> cerrar();
    }
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> noticiaDAO -> consultarTodos());
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Noticia($registro[0],$registro[1],$registro[2],$registro[3],$registro[4]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function consultarNoticias(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> noticiaDAO -> consultarNoticias());
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Noticia($registro[0],$registro[1],$registro[2],$registro[3],$registro[4]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function consultarEventos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> noticiaDAO -> consultarEventos());
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Noticia($registro[0],$registro[1],$registro[2],$registro[3],$registro[4]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> noticiaDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function existeNoticia(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> noticiaDAO -> existeNoticia());
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
        $this -> conexion -> ejecutar($this -> noticiaDAO -> eliminar());
        $this -> conexion -> cerrar();
    }
    
    function modificarNoticia(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> noticiaDAO -> modificarNoticia());
        $this -> conexion -> cerrar();
    }
    
    function modificarEvento(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> noticiaDAO -> modificarEvento());
        $this -> conexion -> cerrar();
    }
    
    function limitar_cadena($cadena, $limite){
        // Si la longitud es mayor que el límite...
        if(strlen($cadena) > $limite){
            // Entonces corta la cadena y ponle el sufijo
            return substr($cadena, 0, $limite) . "...";
        }
        
        // Si no, entonces devuelve la cadena normal
        return $cadena;
    }
 
}
?>