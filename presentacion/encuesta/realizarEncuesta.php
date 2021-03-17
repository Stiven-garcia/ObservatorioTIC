<?php
include 'presentacion/home/menu.php';
$pregunta = new Pregunta("", "", "", $_GET["idEncuesta"]);
$preguntas = $pregunta ->consultarTodos();
$i=0;
$hacer = false;
?>
<div class="columns is-centered" style="margin-top: 20px; margin-bottom: 20px">
	<div class="column is-half  is-one-third">
	<div class="box">
  <div class="media-content">
      <div class="content">
          <?php do{
              $realizar = new Realizar("",$usuario -> getId(), "", $preguntas[$i]);
              if($realizar -> verificar()){
                  $i++;
                  if($preguntas[$i]==null){
                      //hizo todas
                  }
                  $hacer = false;
              }else{
                  $hacer = true;
              }
          }while($realizar -> verificar() && $preguntas[$i]!=null);?>
          <?php if($hacer){?>
          <?php $opcion = new Opcion("", "", "", $preguntas[$i] -> getId());
                $opciones = $opcion -> consultarTodos();?>
					<p style="margin-top: 20px" class="has-text-centered">
          <?php echo $preguntas[$i] -> getPregunta();?>
          <br> <br>
					</p>
					<div class="field">
					<div class="control">
					<?php foreach($opciones as $o){?>
						<label class="radio"> <input type="radio" name="opcion"> <?php echo $o ->getDescripcion()?></label>
					</div>
					</div>
					<?php } ?>
		<?php } ?>
         <p>
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