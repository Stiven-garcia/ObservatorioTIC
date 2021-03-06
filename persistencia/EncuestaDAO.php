<?php

 class EncuestaDAO {
    private $id;
    private $rol;
    private $fecha;
    private $estado;
    private $activada;
    
    function EncuestaDAO ($id, $rol, $fecha,$estado, $activada){
        $this -> id = $id;
        $this -> rol = $rol;
        $this -> fecha = $fecha;
        $this -> estado = $estado;
        $this -> activada = $activada;
    }
    
    function consultar(){
        return "select idEncuesta, Rol_idRol, fechaApertura, estado, activada from encuesta
                where idEncuesta = '" . $this -> id . "'";
    }
    
    function consultarTodos(){
        return "select idEncuesta, Rol_idRol, fechaApertura, estado, activada
                from encuesta
                where Rol_idRol = ". $this -> rol ." ORDER BY fechaApertura DESC";
    }
    
    function registrar(){
        return "INSERT INTO encuesta (Rol_idRol, fechaApertura)
                VALUES (" . $this -> rol . ", '" . $this -> fecha . "')";
    }
    
    function eliminarEncuesta(){
        return "DELETE FROM encuesta
                WHERE idEncuesta=". $this -> id;
    }
    
    function eliminarPreguntas(){
        return "DELETE FROM pregunta
                WHERE Encuesta=". $this -> id;
    }
    
    function eliminarOpciones(){
        return "DELETE opcion.* FROM opcion
                INNER JOIN pregunta
                ON opcion.Pregunta_idPregunta = pregunta.idPregunta
                WHERE pregunta.Encuesta=". $this -> id;
    }
   
    
    /*function cantidadIndicadores(){
        return "select count(idIndicador)
                from indicador
                where Categoria_idCategoria=". $this -> id;
    }
    */
    function modificar(){
        return "UPDATE encuesta
                SET fechaApertura='". $this -> fecha . "
                WHERE idEncuesta=". $this -> id;
    }
    
    function cambiarEstado(){
        return "UPDATE encuesta
                SET estado=". $this -> estado . "
                WHERE idEncuesta=". $this -> id;
    }
    
    function cambiarActivada(){
        return "UPDATE encuesta
                SET activada=1
                WHERE idEncuesta=". $this -> id;
    }
    
    function cambiarEstados(){
        return "UPDATE encuesta
                SET estado=0
                WHERE idEncuesta!=". $this -> id ." and Rol_idRol=".$this -> rol;
    }
    function activarUsuarios(){
        return "UPDATE usuario
                SET terminar=1
                WHERE Rol_idRol=".$this -> rol;
    }
    
    function cantidadPreguntas() {
        return "select count(idPregunta)
                from pregunta
                where Encuesta=". $this -> id;
    }
    
    function completa() {
        return "SELECT SUM(opcion.valor)
                 FROM  pregunta, opcion
                 WHERE Encuesta= ". $this -> id . " and idPregunta = Pregunta_idPregunta";
    }
    function valorCategorias() {
        return "SELECT SUM(categoria.valor)
                 FROM  categoria
                 WHERE rol_idRol=". $this -> rol ;
    }
    
    function verificarEncuesta(){
        return "select idEncuesta
                from encuesta
                where Rol_idRol=". $this -> rol . " and estado=1";
    }
}

?>