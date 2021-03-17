<?php
include 'presentacion/home/menu.php';
$pregunta = new Pregunta("", "", "", $_GET["idEncuesta"]);
$preguntas = $pregunta ->consultarTodos();
$i=0;
$hacer = false;
if(isset($_POST["siguiente"])){
    $respuesta = $_POST["opcion"];
    $opcion = new Opcion($respuesta);
    $opcion -> consultar();
    $realizar = new Realizar(date('Y-m-d H:i:s'),$usuario -> getId(), $opcion -> getId(), $opcion -> getPregunta());
    $realizar -> registrar();
    
}
do{
    $realizar = new Realizar("",$usuario -> getId(), "", $preguntas[$i] -> getId());
    if($realizar -> verificar()){
        $i++;
        if($i == count($preguntas)){
            $usu = new Usuario($usuario -> getId(), "", "", "", "", "", "", "", 1);
            $usu -> actualizarTerminar();
        }
        $hacer = false;
    }else{
        $hacer = true;
    }
}while($realizar -> verificar() && $i != count($preguntas));
?>
<div class="columns is-centered" style="margin-top: 20px; margin-bottom: 20px">
	<div class="column is-half  is-one-third">
	<div class="box">
  <div class="media-content">
  <div class="content">
  
      
          <?php if($hacer){?>
          <form action=<?php echo "index.php?pid=" . base64_encode("presentacion/encuesta/realizarEncuesta.php"). "&idEncuesta=". $_GET["idEncuesta"]?> method="post">
          <?php $opcion = new Opcion("", "", "", $preguntas[$i] -> getId());
                $opciones = $opcion -> consultarTodos();?>
					<p style="margin-top: 20px" class="has-text-centered">
          <?php echo $preguntas[$i] -> getPregunta();?>
          <br> <br>
					</p>
					<?php foreach($opciones as $o){?>
					<div class="field">
					<div class="control">
						<label class="radio"> <input type="radio" name="opcion" value ="<?php echo $o ->getId()?>"> <?php echo $o ->getDescripcion()?></label>
					</div>
					</div>
					<?php } ?>		
			  <p><br> </p>
<nav class="level is-mobile">
<div class="level-left">
</div>
<div class="level-right">
  <p class="level-item"><button class="button" name="siguiente" type="submit" style="background-color:#7317DA; color:#FFFFFF">Siguiente</button></p>
  </div>
</nav>
</form>	
		<?php }else{ ?>
		<?php echo utf8_encode("<p style='margin-top: 30px' class='has-text-centered'>¡Usted termino con éxito la encuesta!</p>")?> 
       <p><br> </p>
       <nav class="level is-mobile">
<div class="level-left">
</div>
<div class="level-right">
  <p class="level-item"> <a class="button is-light" style="border: 1px solid" href="index.php?pid=<?php echo base64_encode("presentacion/home/inicio.php")?>"  > <?php echo utf8_encode("Atras")?></a></p>
  </div>
</nav>
       <?php } ?>
       	
 </div>
</div>
	</div>
</div>
</div>