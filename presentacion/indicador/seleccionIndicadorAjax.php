<?php
$indicador = new Indicador("","","","", $_GET["idCategoria"]);
$indicadores = $indicador -> consultarTodos();
?>
<option value="">Seleccionar</option>
				<?php 
				     foreach ($indicadores as $i) {
                       echo "<option  value='".$i ->getIdIndicador() ."'>" . $i->getNombre() . "</option>";
                    }
                 ?>