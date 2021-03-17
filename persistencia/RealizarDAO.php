<?php

class RealizarDAO {
    private $fecha;
    private $usuario;
    private $respuesta;
    private $pregunta;
    
    function RealizarDAO ($fecha, $usuario, $respuesta, $pregunta){
        $this -> fecha = $fecha;
        $this -> usuario = $usuario;
        $this -> respuesta = $respuesta;
        $this -> pregunta = $pregunta;
    }
    
    function consultar(){
        return "select fecha, Usuario_idUsuario, respuesta, Pregunta_idPregunta 
                from realizar
                where Usuario_idUsuario = " . $this -> usuario . "
                and Pregunta_idPregunta = " . $this -> pregunta;
    }
    
    function consultarTodos($idEncuesta){
        return "select fecha, Usuario_idUsuario, respuesta, Pregunta_idPregunta 
                from realizar, pregunta
                where pregunta.idPregunta =  realizar.Pregunta_idPregunta 
                and pregunta.Encuesta =". $idEncuesta;
    }
    
   
}

?>