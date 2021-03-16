<?php
$idEncuesta = $_GET["idEncuesta"];
if(isset($_GET["idPregunta"])){
    $pregunta = new Pregunta($_GET["idPregunta"]);
    $pregunta -> eliminar();
}
$encuesta = new Encuesta($idEncuesta);
$encuesta -> consultar();
$pregunta = new Pregunta("","","", $encuesta -> getId());
$preguntas = $pregunta -> consultarTodos();
?>
<table class="table table-striped table-hover">
	<thead>
		<tr>
			<th scope="col">ID</th>
			<th scope="col">Pregunta</th>
			<th scope="col">Valor</th>
			<th scope="col">Indicador</th>
			<th scope="col">Numero de Opciones</th>
			<th scope="col">Servicios</th>
		</tr>
	</thead>
	<tbody>
<?php
$i = 1;
foreach ($preguntas as $p) {
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    echo "<td>" . $p->limitar_cadena(70) . "</td>";
    echo "<td>" . $p->getValor() . "</td>";
    echo "<td>" . $p->getIndicador() . "</td>";
    echo "<td>" . $p->cantidadOpciones() . "</td>";
    echo "<td>" . "<a id='ver" . $p->getId() . "' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearPregunta.php") . "&modificar=true&idPregunta=" . $p->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a class='fas fa-tasks' href='index.php?pid=" . base64_encode("presentacion/administrador/consultarOpciones.php") . "&idPregunta=" . $p->getId() . "' data-toggle='tooltip' data-placement='left' title='Ver Opciones'> </a>
                                   <a id='Eliminar" . $p->getId() . "' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                          </td>";
    echo "</tr>";
    $i ++;
}
echo "<tr><td colspan='9'>" . count($preguntas) . " registros encontrados</td></tr>
                       <tr><td colspan='5'>  <a href='index.php?pid=" . base64_encode("presentacion/administrador/crearPregunta.php") . "&crear=true&idPregunta=" . $encuesta->getId() . "'  class='fas fa-plus'>Agregar Pregunta</a> </td></tr>"?>
						</tbody>
</table>


<!-- Control Modal -->
<script type="text/javascript"> 
$(document).ready(function(){
	 <?php foreach ($preguntas as $p) { ?>
		$("#ver<?php echo $p -> getId(); ?>").click(function(e){
			
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/pregunta/modalPregunta.php") . "&idPregunta=" . $p -> getId() . "\";\n"; ?>
			$("#modalContent").load(ruta);
			$("#modalPregunta").addClass("is-active");
			
		});
		<?php } ?>

		$(".delete").click(function(e){
			e.preventDefault();
			$("#modalPregunta").removeClass("is-active");
			
		});
		$('body').on('click', '.modal-background', function(){
			$("#modalPregunta").removeClass("is-active");
		  })
});
</script>	

<script type="text/javascript">
$(document).ready(function(){
	 <?php foreach ($preguntas as $p) { ?>
		$("#Eliminar<?php echo $p -> getId(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar esta pregunta?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/pregunta/preguntaAjax.php") ."&idEncuesta=". $encuesta -> getId()."&idPregunta=". $p -> getId()."\";\n"; ?>
				$("#resultadosPregunta").load(ruta);
			}
		
		});
		<?php } ?>
});
</script>