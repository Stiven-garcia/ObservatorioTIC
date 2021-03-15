<?php
class UsuarioDAO {
    private $id;
    private $nombre;
    private $apellido;
    private $correo;
    private $clave;
    private $rol;
    private $hash;
    private $estado;
    
    function UsuarioDAO($id, $nombre, $apellido, $correo, $clave, $rol, $hash, $estado){
        $this -> id = $id;
        $this -> nombre = $nombre;
        $this -> apellido = $apellido;
        $this -> correo = $correo;
        $this -> clave = $clave;
        $this -> rol = $rol;
        $this -> hash = $hash;
        $this -> estado = $estado;
    }
    
    function autenticar(){
        return "SELECT idUsuario 
                FROM usuario
                WHERE correo = '" . $this -> correo . "' and clave = md5('" . $this -> clave . "')";
    }
    
    function consultar(){
        return "select idUsuario, nombre, apellido, correo, Rol, estado
                from usuario, rol
                where idUsuario = '" . $this -> id . "' and Rol_idRol='".$this -> rol ."'";
    }
    
    function existeCorreo(){
        return "SELECT idUsuario
                FROM usuario
                WHERE correo = '" . $this -> correo . "'";
    }
    
    function registrar(){
       return "INSERT INTO usuario (nombre, apellido, correo, clave, Rol_idRol, hash)
                VALUES ('" . $this -> nombre . "', '" . $this -> apellido . "', '" . $this -> correo . "', md5('" . $this -> clave . "'), " . $this -> rol . ", '". $this -> hash ."')";
    }  
    
    function verificarCorreo(){
        return "SELECT hash
                FROM usuario
                WHERE  correo = '" . $this -> correo . "'";
    }
    
    function actualizarEstado(){
        return "UPDATE usuario
                SET estado=1
                WHERE  correo = '" . $this -> correo . "'";
    }
}
?>