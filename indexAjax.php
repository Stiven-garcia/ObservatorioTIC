
<?php
require 'logica/Persona.php';
require 'logica/Usuario.php';
require 'logica/Administrador.php';
require 'logica/Categoria.php';
require 'logica/Indicador.php';
require 'logica/Encuesta.php';
require 'logica/Pregunta.php';
require 'logica/Opcion.php';
require 'logica/Realizar.php';
require 'logica/Variable.php';
require 'logica/Noticia.php';
$pid = base64_decode($_GET["pid"]);
include $pid;
?>