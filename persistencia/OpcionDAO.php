<?php
class OpcionDAO {
    private $id;
    private $descripcion;
    private $valor;
    private $pregunta;
    
    function OpcionDAO ($id, $descripcion, $valor, $pregunta){
        $this -> id = $id;
        $this -> descripcion = $descripcion;
        $this -> valor = $valor;
        $this -> pregunta = $pregunta;
    }
    
    
    function consultar(){
        return "select idOpcion, descripcion, valor, Pregunta_idPregunta from opcion
                where idOpcion = '" . $this -> id . "'";
    }
    
    function consultarTodos(){
        return "select idOpcion, descripcion, valor, Pregunta_idPregunta 
                from opcion
                where Pregunta_idPregunta = ". $this -> pregunta;
    }
    
    function registrar(){
        return "INSERT INTO opcion (descripcion, valor, Pregunta_idPregunta)
                VALUES ('" . $this -> descripcion . "', '" . $this -> valor . "', " . $this -> pregunta . ")";
    }
    
    function existeOpcion(){
        return "select idOpcion
                from opcion
                where descripcion = '". $this -> descripcion ."'";
    }
    
    function eliminar(){
        return "DELETE FROM opcion
                WHERE idOpcion=". $this -> id;
    }
    
    function modificar(){
        return "UPDATE opcion
                SET descripcion='". $this ->descripcion ."', valor=". $this -> valor ."
                WHERE idOpcion=". $this -> id;
    }
    
    function verificarValor(){
        return "SELECT SUM(opcion.valor), pregunta.valor
                 FROM opcion, pregunta
                 WHERE pregunta.idPregunta= ". $this -> pregunta."
                 AND opcion.Pregunta_idPregunta = ". $this ->pregunta;
    }
    function verificarValorM(){
        return "SELECT SUM(indicador.valor), categoria.valor
                 FROM categoria,indicador
                 WHERE pregunta.idPregunta= ". $this -> pregunta."
                 AND opcion.Pregunta_idPregunta = ". $this ->pregunta ."
                 AND idOpcion!=". $this -> id;
    }
}

?>