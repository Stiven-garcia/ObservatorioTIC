<?php
require_once 'logica/Curso.php';

$idCurso = $_GET['idCurso'];
$curso = new Curso($idCurso);
$curso -> consultar();

?>
	<table class="table table-striped table-hover">
		<tbody>
			<tr><th width="20%">Nombre</th><td><?php echo $curso -> getNombre(); ?></td></tr>	
			<tr><th width="20%">Descripcion</th><td><?php echo $curso -> getDescripcion(); ?></td></tr>
			<tr><th width="20%">Autor</th><td><a><?php echo $curso -> getAutor(); ?></a></td></tr>
			<tr><th width="20%">Link</th><td><a><?php echo $curso -> getLink(); ?></a></td></tr>
		<?php if($curso -> getFechaApertura() !="0000-00-00"){ ?>	<tr><th width="20%">Fecha Apertura</th><td><?php echo $curso -> getFechaApertura(); ?></td></tr><?php } ?>
		<?php if($curso -> getFechaCierre() !="0000-00-00"){ ?>	<tr><th width="20%">Fecha Cierre</th><td><?php echo $curso -> getFechaCierre(); ?></td></tr><?php } ?>
		</tbody>
	</table>