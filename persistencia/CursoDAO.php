<?php
class CursoDAO {
    private $id;
    private $nombre;
    private $descripcion;
    private $link;
    
    function CursoDAO($id, $nombre, $descripcion, $link){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> link = $link;
    }
    
    function consultarTodos(){
        return "select idCurso, nombre, descripcion, link
                from curso";
    }
    
    function consultar() {
        return "select idCurso, nombre, descripcion, link
                from curso
                where idCurso =" . $this -> id;
    }
    
    function registrar(){
        return "insert into curso
                (nombre, descripcion, link)
                values ('" . $this->nombre . "', '" . $this->descripcion . "', '" . $this->link . "')";
    }
    
    function actualizar(){
        return "update curso set
                nombre = '" . $this -> nombre . "',
                descripcion ='" . $this -> descripcion . "',
                link ='" . $this -> link . "'
                where idCurso =" . $this -> id;
    }
    
    function eliminar(){
        return "DELETE FROM curso
                WHERE idCurso =". $this -> id;
    }
    
    
}

?>

