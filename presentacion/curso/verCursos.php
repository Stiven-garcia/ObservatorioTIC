<?php
include 'presentacion/home/menu.php';
$curso = new Curso();
$cursos = $curso ->consultarTodos();
?>
<div class="columns">
  <div class="column is-half is-offset-one-quarter">
<h1 class="title" style="text-align:center; margin-top: 20px"><?php echo utf8_encode("Cursos TIC")?></h1>
  <hr style="height: 3px; background-color: #7317DA; margin-left: 25%; margin-right: 25%"></hr>
</div>
</div>	
<div class="columns is-mobile is-multiline is-centered" style="margin-top: 10px">
<?php
if($cursos == null){
    echo '<p class="subtitle">Por el momento no hay cursos para mostrar</p>';
}else{
    foreach ($cursos as $c) { ?>
	    <div class="column  is-narrow">
	    <div class="animacion"><div class="card" style="width: 500px">
	    <a href="<?php echo $c -> getLink()?>" style="color:hsl(0, 0%, 21%)">
	    <div class="card-content">
	    <div class="media">
	    <div class="media-content">
	    <p class="title is-4"><?php echo $c -> getNombre()?></p></div></div>
	    <div class="content"><?php echo $c -> getDescripcion()?><br><br>
	    <strong>Autor: </strong><?php echo $c ->getAutor()?>
	   <?php if($c -> getFechaApertura() !="0000-00-00"){ ?><br><time datetime="2016-1-1"><strong>Fecha de Inicio: </strong><?php $c -> getFechaApertura(); ?></time>	<?php } ?>
		<?php if($c -> getFechaCierre() !="0000-00-00"){ ?><br><time datetime="2016-1-1"><strong>Fecha de Cierre: </strong><?php $c -> getFechaCierre(); ?></time> <?php } ?>
	    
	   </div></div></a></div></div></div>
<?php 	    
	}
}
?>
</div>