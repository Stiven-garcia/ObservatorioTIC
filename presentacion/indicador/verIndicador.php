<?php
$indicador = new Indicador($_GET["idIndicador"]);
$indicador -> consultar();
$variable = new Variable("","", "",$indicador -> getIdIndicador());
$variables = $variable -> consultarTodos();
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
  <div class="column">
   <div id="indicador">
  
 <?php  echo "<script>";
 $json="[";
  $json .= "[\"Valor Esperado Indicador\",".$indicador -> getValor() * $indicador ->valorIndicador()[1]."],";	   
  $json .= "[\"Valor Actual Indicador\",".$indicador ->valorIndicador()[0]."],";	
 $json .= "]";
                    	
                    	echo "new Chartkick.ColumnChart(\"indicador\", " . $json . ")";
                        echo "</script>";
                    ?>		
  </div>
 </div> 
 <div class="column">
   <div id="indicador2">
  
 <?php  echo "<script>";
 $json="[";
 foreach ($variables as $v){
     $json .= "[\"". $v -> getNombre() ."\",". ($v -> valorVariable()*100)/ $v ->getValor()."],";	   
 }
  
 $json .= "]";
                    	
                    	echo "new Chartkick.ColumnChart(\"indicador2\", " . $json . ")";
                        echo "</script>";
                    ?>		
  </div>
 </div> 
</div>
<div class="columns is-mobile">
  <div class="column is-2 is-offset-10"> 
    <div class="control">
		<a class="button is-light" style="border: 1px solid"  href="index.php?pid=<?php echo base64_encode("presentacion/categoria/verCategoria.php") . "&nos=true&idCategoria=". $indicador -> getCategoria_idCategoria()?>" >Atras</a>
	</div>
  </div>
</div>