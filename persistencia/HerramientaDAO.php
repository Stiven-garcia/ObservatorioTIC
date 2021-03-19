<?php
class HerramientaDAO {
    private $id;
    private $nombre;
    private $descripcion;
    private $logo;
    private $link;
    
    function HerramientaDAO($id, $nombre, $descripcion, $logo, $link){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> descripcion = $descripcion;
        $this -> logo = $logo;
        $this -> link = $link;
    }
    
    function consultarTodos(){
        return "select idHerramienta, nombre, descripcion, logo, link
                from herramienta";
    }
    
    function consultar() {
        return "select idHerramienta, nombre, descripcion, logo, link
                from herramienta
                where idHerramienta =" . $this -> id;
    }
    
    function registrar(){
        return "insert into herramienta
                (nombre, descripcion, logo, link)
                values ('" . $this->nombre . "', '" . $this->descripcion . "', '" . $this->logo . "', '" . $this->link . "')";
    }
    
    function actualizar(){
        return "update herramienta set
                nombre = '" . $this -> nombre . "',
                descripcion ='" . $this -> descripcion . "',
                logo ='" . $this -> logo . "',
                link ='" . $this -> link . "'
                where idHerramienta =" . $this -> id;
    }
    
    function eliminar(){
        return "DELETE FROM herramienta
                WHERE idHerramienta =". $this -> id;
    }
    
    function existeHerramienta(){
        return "select idHerramienta
                from herramienta
                where nombre = '". $this -> nombre;
    }
    
}




?>
