<?php
$categoria = new Categoria("", "", "", "", 1);
$categorias = $categoria -> consultarTodos();
include 'presentacion/home/menu.php';
?>
<div class="columns">
  <div class="column is-half is-offset-one-quarter">
  <h1 class="title" style="text-align:center; margin-top: 20px"><?php echo utf8_encode("Modelo De Medici�n De Uso De TIC En Profesores")?></h1>
  <hr style="height: 3px; background-color: #7317DA; margin-left: 25%; margin-right: 25%"></hr>
  </div>
</div>
  <div class="column" style="margin-top:-25px ;margin-left: 2.5%; margin-right: 2.5%; line-height: 200%; text-align: justify">
   
      <p class="subtitle"><?php echo utf8_encode("El modelo de medici�n de este observatorio eval�a un conjunto de categor�as, donde cada uno de ellas observa elementos fundamentales, tales como: cognitivos y constructivos, es decir, 
las capacidades que poseen los usuarios de las tecnolog�as para adaptarse a ellas e ir evolucionando de manera simult�nea con el apoyo de estas herramientas, 
la infraestructura de la organizaci�n, la cual busca analizar el uso desde la perspectiva tangible ofrecidas por los establecimientos en los que se planea ejercer
el proceso educativo, entre otras; para que de tal manera se pueda lograr la comprensi�n de los aspectos que demuestran el comportamiento del uso de las TIC
en una organizaci�n. <br /> <br /> Las <strong>categor�as</strong> del modelo de evaluaci�n de profesores son las siguientes:
")?></p>
  </div>
<div class="columns is-mobile is-multiline is-centered" style="margin-top: 10px">

<?php
	foreach ($categorias as $c) {
	    echo '<div class="column is-narrow">
        <div class="animacion">
	    <div class="card" style="width: 400px">
	    <header class="card-header" style="background-color:#7317DA">
	    <p class="card-header-title has-text-white">
	    '. $c -> getNombre() .'
	    </p>
	    </header>
	    <div class="card-content">
	    <div class="content" style="text-align: justify">
	   '. $c ->limitar_cadena(300) .'
	    </div>
	    <div class="buttons is-right">
	    <a class="button has-text-white" style="background-color:#7317DA" href="index.php?pid='. base64_encode("presentacion/categoria/verCategoria.php").'&nos=true&idCategoria='. $c ->getId() .'" >Ver</a>
	    </div>
	    </div>
	    </div>
        </div>
	    </div>';
	    
	}
?>
 
</div>
