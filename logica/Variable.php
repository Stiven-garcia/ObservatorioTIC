<?php
require 'persistencia/VariableDAO.php';
require_once 'persistencia/Conexion.php';

class Variable{
    private $id;
    private $nombre;
    private $valor;
    private $indicador;
    private $variableDAO;
    private $conexion;
    
    function getId()
    {
        return $this->id;
    }

    function getNombre()
    {
        return $this->nombre;
    }

    function getValor()
    {
        return $this->valor;
    }

    function getIndicador()
    {
        return $this->indicador;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    function setValor($valor)
    {
        $this->valor = $valor;
    }

    function setIndicador($indicador)
    {
        $this->indicador = $indicador;
    }

    function Variable($id="", $nombre="", $valor="", $indicador=""){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> valor = $valor;
        $this -> indicador = $indicador;
        $this -> conexion = new Conexion();
        $this -> variableDAO = new VariableDAO($id, $nombre, $valor, $indicador);
    }
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> consultarTodos());
        $resultados = array();
        $i=0;
        while(($registro = $this -> conexion -> extraer()) != null){
            $resultados[$i] = new Variable($registro[0], $registro[1], $registro[2], $this -> indicador);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> nombre = $resultado[1];
        $this -> valor = $resultado[2];
        $this -> indicador = $resultado[3];
        $this -> conexion -> cerrar();
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function actualizar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO ->actualizar());
        $this -> conexion -> cerrar();
    }
    
    function existeVariable(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> existeVariable());
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
        $this -> conexion -> ejecutar($this -> variableDAO -> eliminarOpciones());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> eliminarPreguntas());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> eliminar());
        $this -> conexion -> cerrar();
    }
    
    function verificarValor(){
        $this -> conexion -> abrir();
        echo 
        $this -> conexion -> ejecutar($this -> variableDAO -> verificarValor());
        $resultados = array();
        $resultado = $this -> conexion -> extraer();
        if($resultado != null){
            $resultados[0] = $resultado[0];
            $resultados[1] = $resultado[1];
            $this -> conexion -> cerrar();
        }else{
            $resultados[0] = 0;
            $resultados[1] = $this -> verificarValorIndicador();
        }
        return $resultados;
    }
    
    function verificarValorIndicador(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> verificarValor());
        $resultados = array();
        $resultado = $this -> conexion -> extraer();
        $resultados[0] = $resultado[0];
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function verificarValorM(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> verificarValorM());
        $resultados = array();
        $resultado = $this -> conexion -> extraer();
        if($resultado == null){
            $resultados[0] = $resultado[0];
            $resultados[1] = $resultado[1];
            $this -> conexion -> cerrar();
        }else{
            $resultados[0] = 0;
            $resultados[1] = $this -> verificarValorIndicador();
        }
        return $resultados;
    }
    
    function limitar_cadena($limite){
        // Si la longitud es mayor que el límite...
        if(strlen($this -> nombre) > $limite){
            // Entonces corta la cadena y ponle el sufijo
            return substr($this -> nombre, 0, $limite) . "...";
        }
        
        // Si no, entonces devuelve la cadena normal
        return $this -> nombre;
    }
    
    function valorVariable(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> variableDAO -> valorVariable());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    
}