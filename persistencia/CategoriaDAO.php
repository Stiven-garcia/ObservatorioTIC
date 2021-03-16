<?php
class CategoriaDAO {
    private $id;
    private $nombre;
    private $descripcion;
    private $valor;
    private $rol;
    
    function CategoriaDAO ($id, $nombre, $descripcion, $valor, $rol){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> valor = $valor;
        $this -> rol = $rol;
    }
    
    
    function consultar(){
        return "select idCategoria, nombre, descripcion, valor, rol_idRol from categoria
                where idCategoria = '" . $this -> id . "'";
    }
    
    function consultarTodos(){
        return "select idCategoria, nombre, descripcion, valor
                from categoria
                where rol_idRol = ". $this -> rol ." ORDER BY nombre ASC";
    }
    
    function registrar(){
        return "INSERT INTO categoria (nombre, descripcion, valor, rol_idRol)
                VALUES ('" . $this -> nombre . "', '" . $this -> descripcion . "', '" . $this -> valor . "', " . $this -> rol . ")";
    }
    
    function existeCategoria(){
        return "select idCategoria
                from categoria
                where nombre = '". $this -> nombre ."' and rol_idRol=".$this -> rol;
    }
    
    function eliminarCategoria(){
        return "DELETE FROM categoria 
                WHERE idCategoria=". $this -> id;
    }
    
    function eliminarIndicadores(){
        return "DELETE FROM indicador
                WHERE Categoria_idCategoria=". $this -> id;
    }
    
    function eliminarPreguntas(){
        return "DELETE pregunta.* FROM pregunta
                INNER JOIN indicador
                ON pregunta.Indicador_idIndicador = indicador.idIndicador
                WHERE indicador.Categoria_idCategoria =". $this -> id;
    }
    
    function eliminarOpciones(){
        return "DELETE opcion.* FROM opcion
                INNER JOIN pregunta
                ON opcion.Pregunta_idPregunta = pregunta.idPregunta
                INNER JOIN indicador
                ON pregunta.Indicador_idIndicador = indicador.idIndicador
                WHERE indicador.Categoria_idCategoria =". $this -> id;
    }
    
    function cantidadIndicadores(){
        return "select count(idIndicador)
                from indicador
                where Categoria_idCategoria=". $this -> id;
    }
    
    function modificar(){
        return "UPDATE categoria
                SET nombre='". $this -> nombre . "', descripcion='". $this ->descripcion ."', valor=". $this -> valor .", rol_idRol=". $this -> rol."
                WHERE idCategoria=". $this -> id;
    }
    
}

?>