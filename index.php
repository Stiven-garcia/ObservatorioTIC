<?php 
session_start();
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
require 'logica/Herramienta.php';
require 'logica/Curso.php';
?>

<html lang="es" style="height: 100%;">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-carousel@4.0.3/dist/css/bulma-carousel.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
     <script defer src="https://cdn.jsdelivr.net/npm/bulma-carousel@4.0.4/dist/js/bulma-carousel.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/chartkick/2.3.0/chartkick.min.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bulma-carousel@4.0.3/dist/js/bulma-carousel.min.js"></script>
<script type="text/javascript">
        $(function () {
        	  $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bulma-carousel@4.0.3/dist/js/bulma-carousel.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Observatorio TIC UDFJCT</title>
 <style type="text/css" media="all">
    .animacion:hover {
    transform : translateY(-15px);
    box-shadow: 0 12px 16px rgba(0,0,0, 0.2)
    }
    * {
  margin: 0;
}
   .slider-navigation-next{
   border: 1px solid
   }
   .slider-navigation-previous{
   border: 1px solid
   }
    </style>
   


</head>

<body style="height: 100%;">
  <div style="min-height: calc(100% - 5rem);" >
  <?php
    if (isset($_GET["pid"])) {
        $pid = base64_decode($_GET["pid"]);
        if (isset($_GET["nos"]) || (!isset($_GET["nos"]) && $_SESSION['id'] != "")) {
            include $pid;
        } else {
            header("Location: index.php");
        }
    } else {
        $_SESSION['id'] = "";
        $_SESSION['tipo'] = "";
        include 'presentacion/home/inicio.php';
    }
    ?>
  </div>
    <footer class="footer"  style="background-color:#0A0A0A; width: 100%; height:5rem;  bottom: 0; margin-top:30px">
  <div class="content has-text-centered has-text-white" style="margin-top:-15px">
    <p>
     Diego Fernando Machado Barrera | 
     <a href="mailto:dfmachadob@correo.udistrital.edu.co?Subject=Contacto%20observatorio%20TIC">dfmachadob@correo.udistrital.edu.co</a>
    </p>
    <p>
     Stiven Alexander Imbacuan Garcia | 
     <a href="mailto:saimbacuang@correo.udistrital.edu.co?Subject=Contacto%20observatorio%20TIC">saimbacuang@correo.udistrital.edu.co</a>
    
    </p>
   <p> <?php echo utf8_encode("Copyright ? Todos los derechos reservados")?></p>
  </div>
</footer>
</body>

</html>