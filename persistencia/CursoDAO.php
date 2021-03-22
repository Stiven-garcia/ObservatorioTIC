<?php
class CursoDAO {
    private $id;
    private $nombre;
    private $descripcion;
    private $link;
    private $fechaApertura;
    private $fechaCierre;
    private $autor;
    
    function CursoDAO($id, $nombre, $descripcion, $link, $fechaApertura, $fechaCierre, $autor){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> link = $link;
        $this -> fechaApertura = $fechaApertura;
        $this -> fechaCierre = $fechaCierre;
        $this -> autor = $autor;
    }
    
    function consultarTodos(){
        return "select idCurso, nombre, descripcion, link, fechaApertura, fechaCierre, autor
                from curso";
    }
    
    function consultar() {
        return "select idCurso, nombre, descripcion, link, fechaApertura, fechaCierre, autor
                from curso
                where idCurso =" . $this -> id;
    }
    
    function registrar(){
        return "insert into curso
                (nombre, descripcion, link, fechaApertura, fechaCierre, autor)
                values ('" . $this->nombre . "', '" . $this->descripcion . "', '" . $this->link . "', '" . $this->fechaApertura . "', '" . $this->fechaCierre . "', '" . $this->autor . "')";
    }
    
    function actualizar(){
        return "update curso set
                nombre = '" . $this -> nombre . "',
                descripcion ='" . $this -> descripcion . "',
                link ='" . $this -> link . "'
                fechaApertura = '" . $this->fechaApertura . "'
                fechaCierre = '" . $this->fechaCierre . "'
                autor = '" . $this->autor . "'
                where idCurso =" . $this -> id;
    }
    
    function eliminar(){
        return "DELETE FROM curso
                WHERE idCurso =". $this -> id;
    }
    function existeCurso(){
        return "select idCurso
                from curso
                where link = '". $this -> link;
    }
    
    
}

?>

