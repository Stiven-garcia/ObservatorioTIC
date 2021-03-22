<?php 
$administrador = null;
$usuario =null;
if($_SESSION['id'] != ""){
    if($_SESSION['tipo'] ==1){
        $administrador = new Administrador($_SESSION['id']);
        $administrador -> consultar();
    }else{
        $usuario = new Usuario($_SESSION['id']);
        $usuario -> consultar();
    }
}

?>
<nav class="navbar is-black" role="navigation" aria-label="main navigation" style="height:16%">
  <div class="navbar-brand" style="font-size:25px; text-align:center">
     <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/home/inicio.php")?>&nos=true" style="margin-left:30px; width:250px; color:#7317DA" >
      Observatorio TIC UDFJCT
    </a>
    <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false">
  <span aria-hidden="true"></span>
  <span aria-hidden="true"></span>
  <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/home/inicio.php")?>&nos=true">
        Inicio
      </a>
      
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          El Observatorio
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/categoria/estudiantesCategoria.php")?>&nos=true">
            Estudiantes
          </a>
          <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/categoria/profesoresCategoria.php")?>&nos=true">
            Profesores
          </a>
          <?php if($administrador!= null){?>
           <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarCategoria.php")?>&idRol=1">
          <?php echo utf8_encode("Modificar Modelos");?>
          </a>
           <?php } ?>
        </div>
      </div>
      
      <?php if($administrador!= null){?>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Encuestas
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/modificarEncuesta.php")?>&idRol=1" >
            Modificar Encuesta
          </a>
        </div>
      </div>
       <?php }else{ ?>
      <a class="navbar-item" href="index.php?pid=<?php echo (($usuario != "")? base64_encode("presentacion/encuesta/verEncuesta.php") : base64_encode("presentacion/home/iniciarSesion.php"). "&nos=true&error=3") ?>">
        Encuesta
      </a>
      <?php } ?>
        
      <?php if($administrador!= null){?>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Noticias y Eventos
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarNoticias.php")?>&tipo=1">
           Consultar Noticias y Eventos
          </a>
        </div>
      </div>
       <?php }else{ ?>
       <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Noticias y Eventos
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/noticia/verNoticia.php")?>&nos=true">
        Noticias Relevantes
          </a>
          <a class="navbar-item" href="index.php?pid=<?php echo base64_encode("presentacion/noticia/verNoticiaUDFJ.php")?>&nos=true">
        Noticias y Eventos UDFJC
          </a>
        </div>
      </div>
	  
      <?php } ?>
      
     
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          Recursos
        </a>
        <div class="navbar-dropdown">
        <?php if($administrador!= null){?>
        <div class="navbar-item">
          <ul class="menu-list">
          <li>
          <a style="background-color:#7317DA; color:#FFFFFF">Herramientas</a>
          <ul>
        <li><a href="index.php?pid=<?php echo base64_encode("presentacion/administrador/crearHerramientas.php")."&crear=true"?>">Agregar Herramientas</a></li>
        <li><a href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarHerramientas.php")?>">Consultar Herrramientas</a></li>
         </ul>
        </li>
          </ul>
          </div>
          <div class="navbar-item">
          <ul class="menu-list">
          <li>
          <a style="background-color:#7317DA; color:#FFFFFF">Cursos</a>
          <ul>
        <li><a>Agregar Cursos</a></li>
        <li><a>Consultar Cursos</a></li>
         </ul>
        </li>
          </ul>       
          </div>
     <?php }else{ ?> 
          <a class="navbar-item">
            Herramientas
          </a>
          <a class="navbar-item">
            Cursos
          </a>
       
       <?php } ?>  
        </div>
      </div>
  
    </div>

    <div class="navbar-end">
      <div class="navbar-item">
      <?php if($_SESSION['id'] != ""){ ?>
       <?php echo ($administrador!=null)? $administrador -> getNombre() ." ". $administrador -> getApellido() :  $usuario -> getNombre() ." ". $usuario -> getApellido(); ?>
          <div class="navbar-item has-dropdown is-hoverable has-text-centered" style="margin-right:10px">
          
        <a class="navbar-link" style="height:50px; width:50px; margin-left:3px">
          
        </a>

        <div class="navbar-dropdown" >
          <a class="navbar-item" href="index.php">
            Salir
          </a>
        </div>
      </div>
      <?php }else{?>
        <div class="buttons">
          <a class="button" href="index.php?pid=<?php echo base64_encode("presentacion/home/registro.php")?>&nos=true" style="background-color:#7317DA; color:#FFFFFF; border: 2px solid ">
            <strong>Registrarse</strong>
          </a>
          <a class="button is-light" href="index.php?pid=<?php echo base64_encode("presentacion/home/iniciarSesion.php")?>&nos=true" >
            <?php echo utf8_encode("Iniciar Sesión"); ?>
          </a>
        </div>
         <?php }?>
      </div>
    </div>
  </div>
</nav>
<script type="text/javascript">
$(document).ready(function() {

	  // Check for click events on the navbar burger icon
	  $(".navbar-burger").click(function() {

	      // Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
	      $(".navbar-burger").toggleClass("is-active");
	      $(".navbar-menu").toggleClass("is-active");

	  });
	});
  </script>
