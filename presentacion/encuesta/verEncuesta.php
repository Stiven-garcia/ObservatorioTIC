<?php
include 'presentacion/home/menu.php';
$encuesta = new Encuesta("", $usuario -> getRol());

?>
<div class="columns is-centered" style="margin-top: 20px; margin-bottom: 20px">
	<div class="column is-half  is-one-third">
	<div class="box">
  <div class="media-content">
      <div class="content">
        <p  style="margin-top: 20px" class="has-text-centered">
          Bienvenido <strong><?php echo $usuario -> getNombre(). " ". $usuario -> getApellido();?></strong>
          <br>
          <br>
          <?php if($encuesta -> verificarEncuesta()){?>
          <?php if(!$usuario -> realizar($encuesta -> getId())){?>
          <?php echo utf8_encode("¿")?>Desea iniciar con la encuesta de <strong> <?php echo ($usuario -> getRol()==1)?  "Profesores" : "Estudiantes";?> </strong> ?
          <?php }else{?>
           Usted ya <?php echo utf8_encode("realizó")?> esta encuesta 
           <?php } ?>
          <?php }else{?>
          Por el momento no se encuetra habilitada una escuesta de <strong> <?php echo ($usuario -> getRol()==1)?  "Profesores" : "Estudiantes";?> </strong> 
          <?php } ?>
       <br>
       <br>
        </p>
      </div>
<nav class="level is-mobile">
   <?php if($encuesta -> verificarEncuesta()){?>
   <?php if(!$usuario -> realizar($encuesta -> getId())){?>
  <a class="button" style="background-color:#7317DA; color:#FFFFFF" href="index.php?pid=<?php echo base64_encode("presentacion/encuesta/realizarEncuesta.php")."&idEncuesta=".$encuesta -> getId()?>">Realizar</a>
  <?php } ?>
  <?php } ?>
  <a class="button is-light" style="border: 1px solid" href="index.php?pid=<?php echo base64_encode("presentacion/home/inicio.php")?>"  > <?php echo utf8_encode("Cancelar")?></a>
</nav>
</div>
	</div>
</div>
</div>