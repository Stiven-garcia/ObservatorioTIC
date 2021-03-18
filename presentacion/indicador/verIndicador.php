<?php
$indicador = new Indicador($_GET["idIndicador"]);
$indicador -> consultar();
$pregunta = new Pregunta("","",$indicador -> getIdIndicador());
$preguntas = $pregunta -> consultarTodos();
include 'presentacion/home/menu.php';
?>
<div class="columns is-mobile">
  <div class="column is-half is-offset-one-quarter">
  <h1 class="title" style="text-align:center; margin-top: 20px"><?php echo $indicador ->getNombre()?></h1>
  <hr style="height: 3px; background-color: #7317DA; margin-left: 25%; margin-right: 25%"></hr>
  </div>
</div>
  <div class="column" style="margin-top:-25px ;margin-left: 2.5%; margin-right: 2.5%; line-height: 200%; text-align: justify">
   
      <p class="subtitle"><?php echo $indicador -> getDescripcion() . utf8_encode(" <br /> <br /> La <strong>grafica</strong> de este indicador se puede apreciar a continación:") ?></p>
  
  
  </div>
<div class="columns is-mobile is-multiline is-centered" style="margin-top: 10px">
   <div id="indicador">
  
 <?php  echo "<script>";
 $json="[";
 foreach($preguntas as $p){
     $json .= "[\"".$p ->getNombre()."\",".$p -> valorCategoria()."],";	   
 }
 $json .= "]";
                    	
                    	echo "new Chartkick.ColumnChart(\"indicador\", " . $json . ")";
                        echo "</script>";
                    ?>		
  </div>
</div>
<div class="columns is-mobile">
  <div class="column is-2 is-offset-10"> 
    <div class="control">
		<a class="button is-light" style="border: 1px solid"  href="index.php?pid=<?php echo base64_encode("presentacion/categoria/verCategoria.php") . "&nos=true&idCategoria=". $indicador -> getCategoria_idCategoria()?>" >Atras</a>
	</div>
  </div>
</div>