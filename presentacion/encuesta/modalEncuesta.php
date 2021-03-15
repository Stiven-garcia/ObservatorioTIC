<?php
require_once 'logica/Encuesta.php';

$idEncuesta = $_GET['idEncuesta'];
$encuesta = new Encuesta($idEncuesta);
$encuesta -> consultar(); 
?>
      <table class="table is-striped is-hoverable">
		<tbody>
			<tr>
                <th width="20%">Rol</th>
                <td><?php echo ($encuesta -> getRol() ==1)? "Profesores" : "Estudiantes" ?></td>
            </tr>
            <tr>
                <th width="20%"><?php echo utf8_encode("Fecha Apertura")?></th>
                <td><?php echo $encuesta -> getFecha(); ?></td>
            </tr>
		</tbody>
	</table>