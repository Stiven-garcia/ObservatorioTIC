<?php
if(isset($_GET["idVariable"])){
    $variable = new Variable($_GET["idVariable"]);
    $variable -> eliminar();
}
$indicador = new Indicador($_GET["idIndicador"]);
$indicador -> consultar();
$variable = new Variable("","","", $indicador ->getIdIndicador());
$variables = $variable -> consultarTodos();
?>
<table class="table table-striped table-hover">
<thead>
<tr>
<th scope="col">ID</th>
<th scope="col"><?php echo utf8_encode("Nombre")?></th>
<th scope="col">Valor</th>
<th scope="col">Servicios</th>
</tr>
</thead>
<tbody>
						<?php
						$i = 1;
                foreach ($variables as $va) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $va -> limitar_cadena(70) . "</td>";
                    echo "<td>" . $va -> getValor() . "</td>";
                    echo "<td>" . "<a id='ver".$va->getId()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearVariables.php") . "&modificar=true&idVariable=" . $va->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a id='Eliminar".$va->getId()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                          </td>";
                    echo "</tr>";
                    $i++;
                
                }
                echo "<tr><td colspan='9'>" . count($variables) . " registros encontrados</td></tr>
                       <tr><td colspan='5'>  <a href='index.php?pid=" . base64_encode("presentacion/administrador/crearVariable.php") . "&crear=true&idIndicador=" . $indicador -> getIdIndicador() .  "'  class='fas fa-plus'>Agregar Variable</a> </td></tr>"?>
						</tbody>
</table>
<div class="modal" id="modalVariable">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head" style="background-color:#7317DA">
      <p class="modal-card-title has-text-white">Detalles De la <?php echo utf8_encode("Variable")?></p>
      <button class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body" >
    <div id="modalContent">
    
    </div>

    </section>
  </div>
</div>

<!-- Control Modal -->
<script type="text/javascript"> 
$(document).ready(function(){
	 <?php foreach ($variables as $va) { ?>
		$("#ver<?php echo $va -> getId(); ?>").click(function(e){
			
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/variable/modalVariable.php") . "&idVariable=" . $va -> getId() . "\";\n"; ?>
			$("#modalContent").load(ruta);
			$("#modalVariable").addClass("is-active");
			
		});
		<?php } ?>

		$(".delete").click(function(e){
			e.preventDefault();
			$("#modalVariable").removeClass("is-active");
			
		});
		$('body').on('click', '.modal-background', function(){
			$("#modalVariable").removeClass("is-active");
		  })
});
</script>	

<script type="text/javascript">
$(document).ready(function(){
	 <?php foreach ($variables as $va) { ?>
		$("#Eliminar<?php echo $va -> getId(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar esta opcion?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/variable/variableAjax.php") ."&idVariable=". $va -> getId()."\";\n"; ?>
				$("#resultadosVariables").load(ruta);
			}
		
		});
		<?php } ?>
});
</script>
