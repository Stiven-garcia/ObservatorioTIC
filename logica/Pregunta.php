<?php
require 'persistencia/PreguntaDAO.php';
require_once 'persistencia/Conexion.php';

class Pregunta {
    private $id;
    private $pregunta;
    private $indicador;
    private $encuesta;
    private $valor;
    private $preguntaDAO;
    private $conexion;
    
    function getValor(){
        return $this->valor;
    }

    function setValor($valor){
        $this->valor = $valor;
    }

    function getId(){
        return $this -> id;
    }
    
    function getPregunta(){
        return $this -> pregunta;
    }
    
    function getIndicador(){
        return $this -> indicador;
    }
    
    function getEncuesta(){
        return $this -> encuesta;
    }
    
    
    function Pregunta($id="", $pregunta="", $indicador="", $encuesta="", $valor=""){
        $this -> id = $id;
        $this -> pregunta = $pregunta;
        $this -> indicador = $indicador;
        $this -> encuesta = $encuesta;
        $this -> valor = $valor;
        $this -> conexion = new Conexion();
        $this -> preguntaDAO = new PreguntaDAO($id, $pregunta, $indicador, $encuesta, $valor);
    }
    
    function consultar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> consultar());
        $resultado = $this -> conexion -> extraer();
        $this -> id = $resultado[0];
        $this -> pregunta = $resultado[1];
        $this -> indicador = $resultado[2];
        $this -> encuesta = $resultado[3];
        $this -> valor = $resultado[4];
        $this -> conexion -> cerrar();
    }
    
    function consultarTodos(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> consultarTodos());
        $resultados = array();
        $i = 0;
        while (($registro = $this -> conexion -> extraer()) != null) {
            $resultados[$i] = new Pregunta($registro[0],$registro[1],$registro[2],$registro[3],$registro[4]);
            $i++;
        }
        $this -> conexion -> cerrar();
        return $resultados;
    }
    
    function registrar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> registrar());
        $this -> conexion -> cerrar();
    }
    
    function eliminar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> eliminarOpciones());
        $this -> conexion -> cerrar();
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> eliminar());
        $this -> conexion -> cerrar();
    }
    
    function modificar(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> modificar());
        $this -> conexion -> cerrar();
    }
    
    function limitar_cadena($limite){
        // Si la longitud es mayor que el límite...
        if(strlen($this -> pregunta) > $limite){
            // Entonces corta la cadena y ponle el sufijo
            return substr($this -> pregunta, 0, $limite) . "...";
        }
        
        // Si no, entonces devuelve la cadena normal
        return $this -> pregunta;
    }
    
    function existePregunta(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> existePregunta());
        if($this -> conexion -> numFilas() == 0){
            $this -> conexion -> cerrar();
            return false;
        } else {
            $this -> conexion -> cerrar();
            return true;
        }
    }
    
    function cantidadOpciones(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> cantidadOpciones());
        $resultado = $this -> conexion -> extraer();
        $this -> conexion -> cerrar();
        return $resultado[0];
    }
    
    function verificarValor(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> verificarValor());
        $resultados = array();
        $resultado = $this -> conexion -> extraer();
        $resultados[0] = $resultado[0];
        $resultados[1] = $resultado[1];
        $this -> conexion -> cerrar();
        return $resultados;
    }
    function verificarValorM(){
        $this -> conexion -> abrir();
        $this -> conexion -> ejecutar($this -> preguntaDAO -> verificarValorM());
        $resultados = array();
        $resultado = $this -> conexion -> extraer();
        $resultados[0] = $resultado[0];
        $resultados[1] = $resultado[1];
        $this -> conexion -> cerrar();
        return $resultados;
    }
}
?>