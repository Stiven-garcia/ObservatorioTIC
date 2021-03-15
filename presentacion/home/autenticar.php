<?php
$correo = $_POST["correo"];
$clave = $_POST["clave"];

$usuario = new Usuario("", "", "", $correo, $clave, "","","");
$administrador = new Administrador("", "", "", $correo, $clave);
if ($administrador -> autenticar()) {
    $_SESSION['id'] = $administrador -> getId();
    $_SESSION['tipo'] = 1;
    header("Location: index.php?pid=" . base64_encode("presentacion/home/inicio.php"));
}else{
    if($usuario -> autenticar()){
        $_SESSION['id'] = $usuario -> getId();
        $_SESSION['tipo'] = 2;
        header("Location: index.php?pid=" . base64_encode("presentacion/home/inicio.php"));
    } else{
        header("Location: index.php?pid=" . base64_encode("presentacion/home/iniciarSesion.php") . "&error=2 &nos=true");
          }
}
?>