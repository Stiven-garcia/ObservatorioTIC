<?php
class NoticiaDAO {
    private $id;
    private $nombre;
    private $descripcion;
    private $valor;
    private $rol;
    
    function NoticiaDAO ($id, $nombre, $descripcion, $fechaApertura, $fechaCierre){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> fechaApertura = $fechaApertura;
        $this -> fechaCierre = $fechaCierre;
    }
    
    
    function consultar(){
        return "select idNoticiasyEventos, nombre, descripcion, fechaApertura, fechaCierre
                from noticiasyeventos
                where idNoticiasyEventos = '" . $this -> id . "'";
    }
    function consultarTodos(){
        return "select idNoticiasyEventos, nombre, descripcion, fechaApertura, fechaCierre
                from noticiasyeventos
                ORDER BY fechaApertura DESC";
    }
    
    function consultarNoticias(){
        return "select idNoticiasyEventos, nombre, descripcion, fechaApertura, fechaCierre
                from noticiasyeventos
                where fechaCierre = 0000-00-00
                ORDER BY fechaApertura DESC";
    }
    function consultarEventos(){
        return "select idNoticiasyEventos, nombre, descripcion, fechaApertura, fechaCierre
                from noticiasyeventos
                where fechaCierre != 0000-00-00
                ORDER BY fechaApertura DESC";
    }
    
    function registrar(){
        return "INSERT INTO noticiasyeventos (nombre, descripcion, fechaApertura, fechaCierre)
                VALUES ('" . $this -> nombre . "', '" . $this -> descripcion . "', '" . $this -> fechaApertura . "', '" . $this -> fechaCierre . "')";
    }
    
    function existeNoticia(){
        return "select idNoticiasyEventos
                from noticiasyeventos
                where nombre = '". $this -> nombre ."' and fechaApertura=".$this -> fechaApertura;
    }
    
    function eliminar(){
        return "DELETE FROM noticiasyeventos
                WHERE idNoticiasyEventos=". $this -> id;
    }
    
    function modificarNoticia(){
        return "UPDATE noticiasyeventos
                SET nombre='". $this -> nombre . "', descripcion='". $this ->descripcion ."'  
                WHERE idNoticiasyEventos=". $this -> id;
    }
    function modificarEvento(){
        return "UPDATE noticiasyeventos
                SET nombre='". $this -> nombre . "', descripcion='". $this ->descripcion ."', fechaCierre='". $this -> fechaCierre ."'
                WHERE idNoticiasyEventos=". $this -> id;
    }
    

}

?>