<?php
$variable = new Variable("","", $_GET["idIndicador"]);
$variables = $variable -> consultarTodos();
?>
	<label class="label">Variable</label>
	<div class="control">
		<div class="select">
			<select id="variable" name="variable" required>
				<option value="">Seleccionar</option>
				<?php 
				foreach ($variables as $v) {
                       echo "<option  value='".$v -> getId()  ."'>" . $v -> getNombre() . "</option>";
                    }
                 ?>
			</select>
		</div>
	</div>