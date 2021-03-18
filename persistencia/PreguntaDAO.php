<?php

class PreguntaDAO {
    private $id;
    private $pregunta;
    private $indicador;
    private $encuesta;
    private $valor;
    
    function PreguntaDAO ($id, $pregunta, $indicador, $encuesta, $valor){
        $this -> id = $id;
        $this -> pregunta = $pregunta;
        $this -> indicador = $indicador;
        $this -> encuesta = $encuesta;
        $this -> valor = $valor;
    }
    
    
    function consultar(){
        return "select idPregunta, pregunta, variable, Encuesta, valor
                from pregunta
                where idPregunta = '" . $this -> id . "'";
    }
    
    function consultarTodos(){
        return "select idPregunta, pregunta, variable.nombre, Encuesta, pregunta.valor
                from pregunta, variable
                where Encuesta = ". $this -> encuesta ." and idVariable = variable ORDER BY idPregunta ASC";
    }
    
    function registrar(){
        return "INSERT INTO pregunta (pregunta, Indicador_idIndicador, Encuesta, valor)
                VALUES ('" . $this -> pregunta . "'," . $this -> indicador . ",".$this -> encuesta.",". $this -> valor.")";
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
                SET pregunta='". $this -> pregunta . "' valor=". $this -> valor." 
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
    
    function verificarValor(){
        return "SELECT SUM(pregunta.valor), indicador.valor
                 FROM indicador, pregunta
                 WHERE pregunta.Indicador_idIndicador= ". $this -> indicador."
                 AND indicador.idIndicador = ". $this ->indicador;
    }
    function verificarValorM(){
        return "SELECT SUM(indicador.valor), categoria.valor
                 FROM categoria,indicador
                  WHERE pregunta.Indicador_idIndicador= ". $this -> indicador."
                 AND indicador.idIndicador = ". $this ->indicador ."
                 AND idPregunta!=". $this -> id;
    }
    
    function eliminar(){
        return "DELETE FROM pregunta
                WHERE idPregunta=". $this -> id;
    }
    
    function eliminarOpciones(){
        return "DELETE opcion.* FROM opcion
                WHERE opcion.Pregunta_idPregunta =". $this -> id;
    }
    
    function completa() {
        return "SELECT SUM(opcion.valor)
                 FROM  opcion
                 WHERE Pregunta_idPregunta = ". $this -> id;
    }
    
}

?>