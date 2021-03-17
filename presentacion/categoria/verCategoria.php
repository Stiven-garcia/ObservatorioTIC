<?php
$categoria = new Categoria($_GET["idCategoria"]);
$categoria -> consultar();
$indicador = new Indicador("","","","", $categoria -> getId());
$indicadores = $indicador -> consultarTodos();
include 'presentacion/home/menu.php';
?>
<div class="columns">
  <div class="column is-half is-offset-one-quarter">
  <h1 class="title" style="text-align:center; margin-top: 20px"><?php echo $categoria ->getNombre()?></h1>
  <hr style="height: 3px; background-color: #7317DA; margin-left: 25%; margin-right: 25%"></hr>
  </div>
</div>
  <div class="column" style="margin-top:-25px ;margin-left: 2.5%; margin-right: 2.5%; line-height: 200%; text-align: justify">
   
      <p class="subtitle"><?php echo $categoria -> getDescripcion() . utf8_encode(" <br /> <br /> Los <strong>indicadores</strong> de esta categoría son las siguientes:") ?></p>
  </div>
<div class="columns is-mobile is-multiline is-centered" style="margin-top: 10px">

<?php
	foreach ($indicadores as $i) {
	    echo '<div class="column is-narrow">
        <div class="animacion">
	    <div class="card" style="width: 400px">
	    <header class="card-header" style="background-color:#7317DA">
	    <p class="card-header-title has-text-white">
	    '. $i -> getNombre() .'
	    </p>
	    </header>
	    <div class="card-content">
	    <div class="content" style="text-align: justify">
	   '. $i ->limitar_cadena(300) .'
	    </div>
	    <div class="buttons is-right">
	    <a class="button has-text-white" style="background-color:#7317DA" href="index.php?pid='. base64_encode("presentacion/indicador/verIndicador.php").'&idIndicador='. $i -> getIdIndicador() .'" >Ver</a>
	    </div>
	    </div>
	    </div>
        </div>
	    </div>';
	    
	}
?>
 
</div>
<div class="columns is-mobile">
  <div class="column is-2 is-offset-10"> 
    <div class="control">
		<a class="button is-light" style="border: 1px solid"  href="index.php?pid=<?php echo ($categoria -> getRol() == 1)? base64_encode("presentacion/categoria/profesoresCategoria.php") : base64_encode("presentacion/categoria/estudiantesCategoria.php")?>" >Atras</a>
	</div>
  </div>
</div>