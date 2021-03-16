<?php

 class EncuestaDAO {
    private $id;
    private $rol;
    private $fecha;
    private $estado;
    
    function EncuestaDAO ($id, $rol, $fecha, $estado){
        $this -> id = $id;
        $this -> rol = $rol;
        $this -> fecha = $fecha;
        $this -> estado = $estado;
    }
    
    function setId(){
        
    }
    
    function consultar(){
        return "select idEncuesta, Rol_idRol, fechaApertura, estado from encuesta
                where idEncuesta = '" . $this -> id . "'";
    }
    
    function consultarTodos(){
        return "select idEncuesta, Rol_idRol, fechaApertura, estado
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
                WHERE  WHERE pregunta.Encuesta= =". $this -> id;
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
    
    function cambiarEstados(){
        return "UPDATE encuesta
                SET estado=0
                WHERE idEncuesta!=". $this -> id ." and Rol_idRol=".$this -> rol;
    }
}

?>