<?php
class NoticiaDAO {
    private $id;
    private $nombre;
    private $descripcion;
    private $valor;
    private $rol;
    
    function NoticiaDAO ($id, $nombre, $descripcion, $valor, $rol){
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
    
    function eliminar(){
        return "DELETE FROM categoria
                WHERE idCategoria=". $this -> id;
    }
    
    function modificar(){
        return "UPDATE categoria
                SET nombre='". $this -> nombre . "', descripcion='". $this ->descripcion ."', valor=". $this -> valor .", rol_idRol=". $this -> rol."
                WHERE idCategoria=". $this -> id;
    }
    

}

?>