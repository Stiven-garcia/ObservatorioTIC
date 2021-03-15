<?php
require_once 'logica/Indicador.php';

$idIndicador = $_GET['idIndicador'];
$indicador = new Indicador($idIndicador);
$indicador -> consultar();

?>
	<table class="table table-striped table-hover">
		<tbody>
			<tr><th width="20%">Nombre</th><td><?php echo $indicador -> getNombre(); ?></td></tr>		
			<tr><th width="20%">Descripcion</th><td><?php echo $indicador -> getDescripcion(); ?></td></tr>
			<tr><th width="20%">Valor</th><td><?php echo $indicador -> getValor(); ?></td></tr>
		</tbody>
	</table>
