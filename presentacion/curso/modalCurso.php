<?php
require_once 'logica/Curso.php';

$idCurso = $_GET['idCurso'];
$curso = new Curso($idCurso);
$curso -> consultar();

?>
	<table class="table table-striped table-hover">
		<tbody>
			<tr><th width="20%">Nombre</th><td><?php echo $curso -> getNombre(); ?></td></tr>	
			<tr><th width="20%">Descripcion</th><td><?php echo $curso -> getDescripcion(); ?></td></tr>						<tr><th width="20%">Logo</th><td><?php echo (($herramienta -> getLogo()!="")?"<img src='" . $herramienta -> getLogo() . "' height='50px'>":"")?></td></tr>
			<tr><th width="20%">Link</th><td><?php echo $curso -> getLink(); ?></td></tr>
		</tbody>
	</table>