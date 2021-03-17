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
    
    function consultar($idEncuesta){
        return "select fecha, Usuario_idUsuario, respuesta, Pregunta_idPregunta 
                from realizar, pregunta
                where realizar.Usuario_idUsuario = " . $this -> usuario . "
                and realizar.Pregunta_idPregunta = pregunta.idPregunta
                and pregunta.Encuesta = " . $idEncuesta;
    }
    
    function verificar(){
        return "Select respuesta
                FROM realizar
                WHERE Usuario_idUsuario = ". $this -> usuario . "
                and Pregunta_idPregunta = " . $this -> pregunta;
    }
}

?>