<?php
require_once 'logica/Categoria.php';

$idCategoria = $_GET['idCategoria'];
$categoria = new Categoria($idCategoria);
$categoria -> consultar(); 
?>
      <table class="table is-striped is-hoverable">
		<tbody>
			<tr>
                <th width="20%">Nombre</th>
                <td><?php echo $categoria -> getNombre(); ?></td>
            </tr>
            <tr>
                <th width="20%"><?php echo utf8_encode("Descripción")?></th>
                <td><?php echo $categoria -> getDescripcion(); ?></td>
            </tr>
            <tr>
                <th width="20%">Valor</th>
                <td><?php echo $categoria -> getValor(); ?></td>
            </tr>
		</tbody>
	</table>