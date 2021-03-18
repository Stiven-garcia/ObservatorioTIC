<?php
class VariableDAO {
    private $id;
    private $nombre;
    private $valor;
    private $indicador;
    
    function VariableDAO($id, $nombre, $valor, $indicador){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> valor = $valor;
        $this -> indicador = $indicador;
    }
    
    function consultarTodos(){
        return "select idVariable, nombre, valor
                from variable
                where indicador= " . $this -> indicador;
    }
    
    function consultar() {
        return "select idVariable, nombre,  valor, indicador
                from variable
                where idVariable =" . $this -> id;
    }
    
    function registrar(){
        return "insert into variable
                (nombre, valor, indicador)
                values ('" . $this->nombre . "', " . $this->valor . ", " . $this->indicador. ")";
    }
    
    function actualizar(){
        return "update variable set
                nombre = '" . $this -> nombre . "',
                valor ='" . $this -> valor . "'
                where idVariable=" . $this -> id;
    }
    
    function existeVariable(){
        return "select idVariable
                from variable
                where nombre = '". $this -> nombre ."'";
    }
    
    function eliminar(){
        return "DELETE FROM variable
                WHERE idVariable =". $this -> id;
    }
    
    function eliminarPreguntas(){
        return "DELETE pregunta.* FROM pregunta
                WHERE pregunta.variable =". $this -> id;
    }
    
    function eliminarOpciones(){
        return "DELETE opcion.* FROM opcion
                INNER JOIN pregunta
                ON opcion.Pregunta_idPregunta = pregunta.idPregunta
                WHERE pregunta.variable =". $this -> id;
    }
    function verificarValor(){
        return "SELECT SUM(variable.valor), indicador.valor
                 FROM indicador, variable
                 WHERE variable.indicador = ". $this ->indicador."
                 AND indicador.idIndicador = ". $this ->indicador;
    }
    
    function verificarIndicador(){
        return "SELECT indicador.valor
                 FROM indicador, variable
                 WHERE variable.indicador = ". $this ->indicador."
                 AND indicador.idIndicador = ". $this ->indicador;
    }
    
    function verificarValorM(){
        return "SELECT SUM(variable.valor), indicador.valor
                 FROM indicador, variable
                 WHERE variable.indicador = ". $this ->indicador."
                 AND indicador.idIndicador = ". $this ->indicador ."
                 AND variable.idVariable !=". $this -> id;
    }
    
}


?>