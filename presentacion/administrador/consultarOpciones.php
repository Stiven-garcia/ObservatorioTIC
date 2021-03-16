<?php
$pregunta= new Pregunta($_GET["idPregunta"]);
$pregunta -> consultar();
$opcion = new Opcion("","","", $pregunta ->getId());
$opciones = $opcion -> consultarTodos();
include 'presentacion/home/menu.php';
?>

<div class="columns is-centered " style="margin-top: 10px">
  <div class="column is-four-fifths">
 		<div class="columns">
                  <div class="column is-2 is-offset-10"> 
                  <a class="button" style="background-color:#7317DA; color:#FFFFFF"  href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearOpciones.php") . "&crear=true&idPregunta=" . $pregunta -> getId() ?>" > <?php echo utf8_encode("Agregar Opción")?></a>
                  </div>
  		</div>
  </div>
</div>

<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-four-fifths">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px ">Opciones De Pregunta</p>
			</header>
				<div class="card-content">
					<div class="content">
					<div class="field">
							<label class="label">Pregunta</label>
							<div class="control">
								<textarea id="pregunta" name="pregunta" class="textarea" required="required" placeholder="Ingrese la pregunta" disabled rows="2"><?php echo $pregunta ->getPregunta() ?></textarea>
							</div>
						</div>
					<div id="resultadosOpciones">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
							   <th scope="col">ID</th>
								<th scope="col"><?php echo utf8_encode("Descripción")?></th>
								<th scope="col">Valor</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 1;
                foreach ($opciones as $o) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $o -> limitar_cadena(70) . "</td>";
                    echo "<td>" . $o -> getValor() . "</td>";
                    echo "<td>" . "<a id='ver".$o->getId()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearOpciones.php") . "&modificar=true&idOpcion=" . $o->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a id='Eliminar".$o->getId()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                          </td>";
                    echo "</tr>";
                    $i++;
                
                }
                echo "<tr><td colspan='9'>" . count($opciones) . " registros encontrados</td></tr>
                       <tr><td colspan='5'>  <a href='index.php?pid=" . base64_encode("presentacion/administrador/crearOpciones.php") . "&crear=true&idPregunta=" . $pregunta -> getId() .  "'  class='fas fa-plus'>Agregar Opcion</a> </td></tr>"?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <div class="column is-2 is-offset-10"> 
      <a class="button is-light" style="border: 1px solid"  href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearEncuesta.php") . "&modificar=true&idEncuesta=" . $pregunta -> getEncuesta() ?>" > <?php echo utf8_encode("Atras")?></a>
 </div>

<div class="modal" id="modalOpcion">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head" style="background-color:#7317DA">
      <p class="modal-card-title has-text-white">Detalles De la <?php echo utf8_encode("Opción")?></p>
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
	 <?php foreach ($opciones as $o) { ?>
		$("#ver<?php echo $o -> getId(); ?>").click(function(e){
			
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/opcion/modalOpcion.php") . "&idOpcion=" . $o -> getId() . "\";\n"; ?>
			$("#modalContent").load(ruta);
			$("#modalOpcion").addClass("is-active");
			
		});
		<?php } ?>

		$(".delete").click(function(e){
			e.preventDefault();
			$("#modalOpcion").removeClass("is-active");
			
		});
		$('body').on('click', '.modal-background', function(){
			$("#modalOpcion").removeClass("is-active");
		  })
});
</script>	

<script type="text/javascript">
$(document).ready(function(){
	 <?php foreach ($opciones as $o) { ?>
		$("#Eliminar<?php echo $o -> getId(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar esta opción?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/opcion/opcionAjax.php") ."&idPregunta=". $pregunta -> getId()."&idOpcion=". $o -> getId()."\";\n"; ?>
				$("#resultadosOpciones").load(ruta);
			}
		
		});
		<?php } ?>
});
</script>