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
    function eliminarVariables(){
        return "DELETE variable.* FROM variable
                INNER JOIN indicador
                ON variable.indicador = indicador.idIndicador
                WHERE indicador.Categoria_idCategoria =". $this -> id;
    }
    function eliminarPreguntas(){
        return "DELETE pregunta.* FROM pregunta
                INNER JOIN variable
                ON pregunta.variable = variable.idVariable
                INNER JOIN indicador
                ON variable.indicador = indicador.idIndicador
                WHERE indicador.Categoria_idCategoria =". $this -> id;
    }
    
    function eliminarOpciones(){
        return "DELETE opcion.* FROM opcion
                INNER JOIN pregunta
                ON opcion.Pregunta_idPregunta = pregunta.idPregunta
                INNER JOIN variable
                ON pregunta.variable = variable.idVariable
                INNER JOIN indicador
                ON variable.indicador = indicador.idIndicador
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
    
    function completa() {
        return "SELECT SUM(variable.valor)
                 FROM  variable, indicador
                 WHERE Categoria_idCategoria= ". $this -> id . " and idIndicador = indicador";
    }
    
    function valorCategoria(){
        return "SELECT SUM(opcion.valor)
                 FROM indicador, pregunta, opcion, realizar, encuesta, variable, categoria
                 WHERE respuesta = idOpcion and
                 opcion.Pregunta_idPregunta= pregunta.idPregunta
                 and pregunta.variable = idVariable
                 and variable.indicador = idIndicador
                and Encuesta = idEncuesta and encuesta.estado=1
                and categoria.idCategoria = indicador.Categoria_idCategoria
                and idCategoria = ". $this -> id;
    }
    
}

?>