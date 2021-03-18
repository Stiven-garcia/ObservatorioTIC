<?php
require_once 'logica/Variable.php';

$idVariable = $_GET['idVariable'];
$variable = new Variable($idVariable);
$variable -> consultar();

?>
	<table class="table table-striped table-hover">
		<tbody>
			<tr><th width="20%">Nombre</th><td><?php echo $variable -> getNombre(); ?></td></tr>		
			<tr><th width="20%">Valor</th><td><?php echo $variable -> getValor(); ?></td></tr>
		</tbody>
	</table>

