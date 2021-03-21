<?php
require_once 'logica/Noticia.php';

$id = $_GET['idNoticia'];
$noticia = new Noticia($id);
$noticia -> consultar();
?>
      <table class="table is-striped is-hoverable">
		<tbody>
			<tr>
                <th width="20%">Nombre</th>
                <td><?php echo $noticia -> getNombre(); ?></td>
            </tr>
            <tr>
                <th width="20%"><?php echo utf8_encode("Descripción")?></th>
                <td><?php echo $noticia -> getDescripcion(); ?></td>
            </tr>
            <tr>
                <th width="20%">Fecha de Apertura</th>
                <td><?php echo $noticia -> getFechaApertura(); ?></td>
            </tr>
            <?php if($noticia -> getFechaCierre()!=null){?>
            <tr>
                <th width="20%"> Fecha de Cierre</th>
                <td><?php echo $noticia -> getFechaCierre(); ?></td>
            </tr>
            <?php } ?>
		</tbody>
	</table>