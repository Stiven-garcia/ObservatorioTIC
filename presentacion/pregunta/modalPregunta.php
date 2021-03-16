<?php
require_once 'logica/Pregunta.php';
$pregunta = new Pregunta($_GET["idPregunta"]);
$pregunta -> consultar();

?>
	<table class="table table-striped table-hover">
		<tbody>
			<tr><th width="20%">Pregunta</th><td><?php echo $pregunta -> getPregunta(); ?></td></tr>		
			<tr><th width="20%">Indicador</th><td><?php echo $pregunta -> getIndicador(); ?></td></tr>
			<tr><th width="20%">Valor de la pregunta</th><td><?php echo $pregunta -> getValor(); ?></td></tr>
		</tbody>
	</table>
