<?php
require_once 'logica/Herramienta.php';

$idHerramienta = $_GET['idHerramienta'];
$herramienta = new Herramienta($idHerramienta);
$herramienta -> consultar();

?>
	<table class="table table-striped table-hover">
		<tbody>
			<tr><th width="20%">Nombre</th><td><?php echo $herramienta -> getNombre(); ?></td></tr>	
			<tr><th width="20%">Descripcion</th><td><?php echo $herramienta -> getDescripcion(); ?></td></tr>			
			<tr><th width="20%">Logo</th><td><?php echo (($herramienta -> getLogo()!="")?"<img src='" . $herramienta -> getLogo() . "' height='50px'>":"")?></td></tr>
			<tr><th width="20%">Link</th><td><a href="<?php echo $herramienta -> getLink(); ?>"><?php echo $herramienta -> getLink(); ?></a></td></tr>
		</tbody>
	</table>