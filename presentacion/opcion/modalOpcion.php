<?php
require_once 'logica/Opcion.php';
$opcion = new Opcion($_GET["idOpcion"]);
$opcion -> consultar();

?>
	<table class="table table-striped table-hover">
		<tbody>
			<tr><th width="20%">Descripcion</th><td><?php echo $opcion -> getDescripcion(); ?></td></tr>
			<tr><th width="20%">Valor</th><td><?php echo $opcion -> getValor(); ?></td></tr>
		</tbody>
	</table>
