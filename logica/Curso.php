<?php
require 'persistencia/CursoDAO.php';
require_once 'persistencia/Conexion.php';

class Curso {
    private $id;
    private $nombre;
    private $descripcion;
    private $link;
    private $fechaApertura;
    private $fechaCierre;
    private $autor;
    private $CursoDAO;
    private $conexion;
    
    function getAutor(){
        return $this->autor;
    }
    
    function getFechaApertura(){
        return $this->fechaApertura;
    }

    function getFechaCierre(){
        return $this->fechaCierre;
    }

    function getId()
    {
        return $this->id;
    }
    
    function getNombre()
    {
        return $this->nombre;
    }
    
    function getDescripcion()
    {
        return $this->descripcion;
    }
    
    
    function getLink()
    {
        return $this->link;
    }
    
    function Curso($id="", $nombre="", $descripcion="", $link="", $fechaApertura="", $fechaCierre="", $autor=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> link = $link;
        $this -> fechaApertura = $fechaApertura;
        $this -> fechaCierre = $fechaCierre;
        $this -> autor = $autor;
        $this -> conexion = new Conexion();
        $this -> CursoDAO = new CursoDAO($id, $nombre, $descripcion, $link,  $fechaApertura, $fechaCierre, $autor);
    }
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> CursoDAO -> consultarTodos());
        $resultados = array();
        $i=0;
        while(($registro = $this -> conexion -> extraer()) != null){
            $resultados[$i] = new Curso($registro[0], $registro[1], $registro[2], $registro[3], $registro[5], $registro[5], $registro[6]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function existeCurso(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> CursoDAO -> existeCurso());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;
        }
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> CursoDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> descripcion = $resultado[2];
        $this -> link = $resultado[3];
        $this -> fechaApertura = $resultado[4];
        $this -> fechaCierre = $resultado[5];
        $this -> autor = $resultado[6];
        $this -> conexion -> cerrar();
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> CursoDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function actualizar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> CursoDAO ->actualizar());
        $this -> conexion -> cerrar();
    }
    
    function eliminar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> CursoDAO -> eliminar());
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
