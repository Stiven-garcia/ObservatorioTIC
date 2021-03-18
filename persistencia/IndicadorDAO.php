<?php
class IndicadorDAO {
    private $idIndicador;
    private $nombre;
    private $descripcion;
    private $valor;
    private $Categoria_idCategoria;
    
    function IndicadorDAO($idIndicador, $nombre, $descripcion, $valor, $categoria){
        $this -> idIndicador = $idIndicador;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> valor = $valor;
        $this -> Categoria_idCategoria = $categoria;
    }
    
    function consultarTodos(){
        return "select idIndicador, nombre, descripcion, valor
                from indicador
                where Categoria_idCategoria = " . $this -> Categoria_idCategoria;
    }
    
    function consultar() {
        return "select idIndicador, nombre, descripcion, valor, Categoria_idCategoria
                from indicador
                where idIndicador =" . $this -> idIndicador;
    }
    
    function registrar(){
        return "insert into indicador
                (nombre, descripcion, valor,  Categoria_idCategoria)
                values ('" . $this->nombre . "', '" . $this->descripcion . "', " . $this->valor . ", " . $this->Categoria_idCategoria . ")";
    }
    
    function actualizar(){
        return "update indicador set
                nombre = '" . $this -> nombre . "',
                descripcion ='" . $this -> descripcion . "',
                valor ='" . $this -> valor . "'
                where idIndicador=" . $this -> idIndicador;
    }
    
    function existeIndicador(){
        return "select idIndicador
                from indicador
                where nombre = '". $this -> nombre ."'";
    }
    
    function eliminar(){
        return "DELETE FROM indicador
                WHERE idIndicador=". $this -> idIndicador;
    }
    
    function eliminarPreguntas(){
        return "DELETE pregunta.* FROM pregunta
                WHERE pregunta.Indicador_idIndicador =". $this -> id;
    }
    
    function eliminarOpciones(){
        return "DELETE opcion.* FROM opcion
                INNER JOIN pregunta
                ON opcion.Pregunta_idPregunta = pregunta.idPregunta
                WHERE pregunta.Indicador_idIndicador =". $this -> id;
    }
    function verificarValor(){
        return "SELECT SUM(indicador.valor), categoria.valor
                 FROM categoria,indicador 
                 WHERE indicador.Categoria_idCategoria = ". $this ->Categoria_idCategoria."
                 AND categoria.idCategoria = ". $this ->Categoria_idCategoria;
    }
    function verificarValorM(){
        return "SELECT SUM(indicador.valor), categoria.valor
                 FROM categoria,indicador
                 WHERE indicador.Categoria_idCategoria = ". $this ->Categoria_idCategoria."
                 AND categoria.idCategoria = ". $this ->Categoria_idCategoria ."
                 AND idIndicador!=". $this -> idIndicador;
    }
    
    function valorCategoria(){
        return "SELECT SUM(opcion.valor)
                 FROM indicador, pregunta, opcion, realizar, encuesta
                 WHERE respuesta = idOpcion and opcion.Pregunta_idPregunta= pregunta.idPregunta and Indicador_idIndicador = idIndicador and Encuesta = idEncuesta and encuesta.estado=1 and idIndicador = ". $this -> idIndicador;
    }
    
}


?>