<?php
include 'presentacion/home/menu.php';
$pregunta = new Pregunta("", "", "", $_GET["idEncuesta"]);
$pregunta ->consultarTodos();
?>
<div class="columns is-centered" style="margin-top: 20px; margin-bottom: 20px">
	<div class="column is-half  is-one-third">
	<div class="box">
  <div class="media-content">
      <div class="content">
        <p  style="margin-top: 20px" class="has-text-centered">
          Encuesta mamalona
          <br>
          <br>
          <?php echo utf8_encode("¿")?>Desea iniciar con la encuesta de <strong> <?php echo ($usuario -> getRol()==1)?  "Profesores" : "Estudiantes";?> </strong> ?
       <br>
       <br>
        </p>
      </div>
<nav class="level is-mobile">
  <a class="button" style="background-color:#7317DA; color:#FFFFFF">Realizar</a>
  <a class="button is-light" style="border: 1px solid" href="index.php?pid=<?php echo base64_encode("presentacion/home/inicio.php")?>&nos=true"  > <?php echo utf8_encode("Cancelar")?></a>
</nav>
</div>
	</div>
</div>
</div>