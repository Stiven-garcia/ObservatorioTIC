<?php
require 'persistencia/IndicadorDAO.php';
require_once 'persistencia/Conexion.php';

class Indicador {
    private $idIndicador;
    private $nombre;
    private $descripcion;
    private $valor;
    private $Categoria_idCategoria;
    private $indicadorDAO;
    private $conexion;
    
    function getIdIndicador()
    {
        return $this->idIndicador;
    }


    function getNombre()
    {
        return $this->nombre;
    }


    function getDescripcion()
    {
        return $this->descripcion;
    }


    function getValor()
    {
        return $this->valor;
    }


    function getCategoria_idCategoria()
    {
        return $this->Categoria_idCategoria;
    }
    
    function setCategoria_idCategoria($Categoria_idCategoria){
        $this->Categoria_idCategoria = $Categoria_idCategoria;
    }

    function Indicador($idIndicador="", $nombre="", $descripcion="", $valor="", $categoria=""){ 
        $this -> idIndicador = $idIndicador;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> valor = $valor;
        $this -> Categoria_idCategoria = $categoria;
        $this -> conexion = new Conexion();
        $this -> indicadorDAO = new IndicadorDAO($idIndicador, $nombre, $descripcion, $valor, $categoria);        
    } 
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> consultarTodos());
        $resultados = array();
        $i=0;
        while(($registro = $this -> conexion -> extraer()) != null){
            $resultados[$i] = new Indicador($registro[0], $registro[1], $registro[2], $registro[3], $this -> Categoria_idCategoria);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> idIndicador = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> descripcion = $resultado[2];
        $this -> valor = $resultado[3];
        $this -> Categoria_idCategoria = $resultado[4];
        $this -> conexion -> cerrar();
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function actualizar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO ->actualizar());
        $this -> conexion -> cerrar();
    }
    
    function existeIndicador(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> existeIndicador());
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
        $this -> conexion -> ejecutar($this -> indicadorDAO -> eliminarOpciones());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> eliminarPreguntas());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> eliminar());
        $this -> conexion -> cerrar();
    }
    
    function verificarValor(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> verificarValor());
        $resultados = array();
        $resultado = $this -> conexion -> extraer();
        $resultados[0] = $resultado[0];
        $resultados[1] = $resultado[1];
        $this -> conexion -> cerrar();
        return $resultados;
    }
    function verificarValorM(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> verificarValorM());
        $resultados = array();
        $resultado = $this -> conexion -> extraer();
        $resultados[0] = $resultado[0];
        $resultados[1] = $resultado[1];
        $this -> conexion -> cerrar();
        return $resultados;
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
    
    function valorCategoria(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> valorCategoria());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    
    function completa() {
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> completa());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    
    function valorIndicador(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> indicadorDAO -> valorIndicador());
        $resultados = array();
        $resultado = $this -> conexion -> extraer();
        if($resultado[0]== null){
            $resultados[0] = 0;
        }else{
            $resultados[0] = $resultado[0];
        }
        if($resultado[1]== null){
            $resultados[1] = 0;
        }else{
            $resultados[1] = $resultado[1];
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
}