<?php
include 'presentacion/home/menu.php';
$noticia= new Noticia();
$noticias = $noticia ->consultarTodos();
?>
<div class="columns">
  <div class="column is-half is-offset-one-quarter">
<h1 class="title" style="text-align:center; margin-top: 20px"><?php echo utf8_encode("Noticias y Eventos UDFJC")?></h1>
  <hr style="height: 3px; background-color: #7317DA; margin-left: 25%; margin-right: 25%"></hr>
</div>
</div>	
<div class="columns is-mobile is-multiline is-centered" style="margin-top: 10px">
<?php
if($noticias == null){
    echo '<p class="subtitle">Por el momento no hay noticias o eventos para mostrar</p>';
}else{
    foreach ($noticias as $n) { ?>
	    <div class="column is-narrow">
        <div class="animacion">
	    <div class="card" style="width: 400px">
	    <header class="card-header" style="background-color:#7317DA">
	    <p class="card-header-title has-text-white">
	    <?php echo $n -> getNombre()?>
	    </p>
	    </header>
	    <div class="card-content">
	    <div class="content" style="text-align: justify">
	    <?php echo $n -> getDescripcion() ?>
        <br>
        <p class="help is-success"><?php echo ($n ->getFechaCierre()=='0000-00-00')? 'Noticia':'Evento' ?></p>
	    <time datetime="2016-1-1"><?php echo (($n ->getFechaCierre()=='0000-00-00')? $n -> getFechaApertura() : '<strong>Fecha Apertura:</strong> '. $n -> getFechaApertura() .'<br><strong>Fecha Cierre:</strong> '. $n -> getFechaCierre() ) ?></time>
        </div>
	    </div>
	    </div>
        </div>
	    </div>
<?php 	    
	}
}
?>
</div>