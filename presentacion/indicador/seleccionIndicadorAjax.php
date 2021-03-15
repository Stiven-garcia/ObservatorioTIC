<?php
$indicador = new Indicador("","","","", $_GET["idCategoria"]);
$indicadores = $indicador -> consultarTodos();
?>
	<label class="label">Indicador</label>
	<div class="control">
		<div class="select">
			<select id="indicador" name="indicador" required>
				<option value="">Seleccionar</option>
				<?php 
				     foreach ($indicadores as $i) {
                       echo "<option  value='".$i ->getIdIndicador() ."'>" . $i->getNombre() . "</option>";
                    }
                 ?>
			</select>
		</div>
	</div>