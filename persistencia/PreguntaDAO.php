<?php

class PreguntaDAO {
    private $id;
    private $pregunta;
    private $indicador;
    private $encuesta;
    
    function PreguntaDAO ($id, $pregunta, $indicador, $encuesta){
        $this -> id = $id;
        $this -> pregunta = $pregunta;
        $this -> indicador = $indicador;
        $this -> encuesta = $encuesta;
    }
    
    
    function consultar(){
        return "select idPregunta, pregunta, Indicador_idIndicador, Encuesta from pregunta
                where idPregunta = '" . $this -> id . "'";
    }
    
    function consultarTodos(){
        return "select idPregunta, pregunta, indicador.nombre, Encuesta
                from pregunta, indicador
                where Encuesta = ". $this -> encuesta ." and idIndicador=Indicador_idIndicador ORDER BY idPregunta ASC";
    }
    
    function registrar(){
        return "INSERT INTO pregunta (pregunta, Indicador_idIndicador, Encuesta)
                VALUES ('" . $this -> pregunta . "'," . $this -> indicador . ",".$this -> encuesta.")";
    }
    /*
     function eliminarCategoria(){
     return "DELETE FROM categoria
     WHERE idCategoria=". $this -> id;
     }
     
     function eliminarIndicadores(){
     return "DELETE FROM indicador
     WHERE Categoria_idCategoria=". $this -> id;
     }
     
     function cantidadIndicadores(){
     return "select count(idIndicador)
     from indicador
     where Categoria_idCategoria=". $this -> id;
     }
     */
    function modificar(){
        return "UPDATE pregunta
                SET pregunta='". $this -> pregunta . "' 
                WHERE idPregunta=". $this -> id;
    }
    
    function existePregunta(){
        return "select idPregunta
                from pregunta, 
                where pregunta = ". $this -> pregunta;
    }
    
    function cantidadOpciones() {
        return "select count(idOpcion)
                from opcion
                where Pregunta_idPregunta=". $this -> id;
    }
}

?>