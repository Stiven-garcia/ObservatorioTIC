<?php
$variable = new Variable("","","", $_GET["idIndicador"]);
$variables = $variable -> consultarTodos();
?>
<option value="">Seleccionar</option>
				<?php 
				foreach ($variables as $v) {
                       echo "<option  value='".$v -> getId()  ."'>" . $v -> getNombre() . "</option>";
                    }
                 ?>