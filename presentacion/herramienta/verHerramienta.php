<?php
include 'presentacion/home/menu.php';
$herramienta = new Herramienta();
$herramientas = $herramienta ->consultarTodos();
?>
<div class="columns">
  <div class="column is-half is-offset-one-quarter">
<h1 class="title" style="text-align:center; margin-top: 20px"><?php echo utf8_encode("Herramientas TIC")?></h1>
  <hr style="height: 3px; background-color: #7317DA; margin-left: 25%; margin-right: 25%"></hr>
</div>
</div>	
<div class="columns is-mobile is-multiline is-centered" style="margin-top: 10px">
<?php
if($herramientas == null){
    echo '<p class="subtitle">Por el momento no hay herramientas para mostrar</p>';
}else{
    foreach ($herramientas as $h) { ?>
	    <div class="column  is-narrow">
	    <div class="animacion"><div class="card" style="width: 380px">
	    <a href="<?php echo $h -> getLink()?>" style="color:hsl(0, 0%, 21%)">
	    <div class="card-image">
	    <figure class="image is-16by9">
	    <img src="<?php echo $h -> getLogo()?>" alt="Placeholder image"></figure></div>
	    <div class="card-content">
	    <div class="media">
	    <div class="media-content">
	    <p class="title is-4"><?php echo $h -> getNombre()?></p></div></div>
	    <div class="content"><?php echo $h -> getDescripcion()?><br>
	   </div></div></a></div></div></div>
<?php 	    
	}
}
?>
</div>