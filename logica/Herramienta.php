<?php
require 'persistencia/HerramientaDAO.php';
require_once 'persistencia/Conexion.php';

class Herramienta {
    private $id;
    private $nombre;
    private $descripcion;
    private $logo;
    private $link;
    private $HerramientaDAO;
    private $conexion;
    
   
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

    function getLogo()
    {
        return $this->logo;
    }

    function getLink()
    {
        return $this->link;
    }

    function Herramienta($id="", $nombre="", $descripcion="", $logo="", $link=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> logo = $logo;
        $this -> link = $link;
        $this -> conexion = new Conexion();
        $this -> HerramientaDAO = new HerramientaDAO($id, $nombre, $descripcion, $logo, $link);
    }
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> HerramientaDAO -> consultarTodos());
        $resultados = array();
        $i=0;
        while(($registro = $this -> conexion -> extraer()) != null){
            $resultados[$i] = new Herramienta($registro[0], $registro[1], $registro[2], $registro[3], $registro[4]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> HerramientaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> descripcion = $resultado[2];
        $this -> logo = $resultado[3];
        $this -> link = $resultado[4];
        $this -> conexion -> cerrar();
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> HerramientaDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function actualizar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> HerramientaDAO ->actualizar());
        $this -> conexion -> cerrar();
    }
    
    function existeHerramienta(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> HerramientaDAO -> existeHerramienta());
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
        $this -> conexion -> ejecutar($this -> HerramientaDAO -> eliminar());
        $this -> conexion -> cerrar();
    }
        
    function limitar_cadena($cadena, $limite){
        // Si la longitud es mayor que el l?mite...
        if(strlen($cadena) > $limite){
            // Entonces corta la cadena y ponle el sufijo
            return substr($cadena, 0, $limite) . "...";
        }
        
        // Si no, entonces devuelve la cadena normal
        return $cadena;
    }  
  
    
}
