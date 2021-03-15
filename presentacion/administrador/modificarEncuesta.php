<?php
$rol = $_GET["idRol"];
$encuesta = new Encuesta("", $rol);
$encuestas = $encuesta -> consultarTodos();
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered " style="margin-top: 10px">
  <div class="column is-four-fifths">
 		<div class="columns">
 				 <div class="column is-1"> </div>
                  <div class="column is-two-thirds"> 
                  <div class="dropdown is-hoverable">
                  <div class="dropdown-trigger">
                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu3">
                      <span><?php echo utf8_encode("Seleccioné el tipo de modelo")?></span>
                      <span class="icon is-small">
                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                      </span>
                    </button>
                  </div>
                  <div class="dropdown-menu" role="menu">
                    <div class="dropdown-content">
                      <a id="seleccionar1" href="#" class="dropdown-item">
                        Profesores
                      </a>
                      <a id="seleccionar2" href="#" class="dropdown-item">
                        Estudiantes
                      </a>
                    </div>
                  </div>
                </div>
                  </div>
                  <div class="column"> 
                  <a id="agregar" class="button" style="background-color:#7317DA; color:#FFFFFF"   href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearEncuesta.php") . "&crear=true&idRol=" . $encuesta -> getRol()  ?>" > <?php echo utf8_encode("Agregar Encuesta")?></a>
                  </div>
  		</div>
  </div>
</div>

<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-four-fifths">
		<div class="card" id="resultadosEncuesta" >
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo utf8_encode("Encuestas")?> <?php echo ($encuesta -> getRol() == 1)? "Profesores" : "Estudiantes" ?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<table class="table is-striped is-hoverable">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col"><?php echo utf8_encode("Fecha De Creación")?></th>
								<th scope="col">Estado</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						foreach ($encuestas as $e) {
						    echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $e -> getFecha() . "</td>";
                            echo "<td> <a id='Estado" . $e->getId() . "' class='fas ".(($e->getEstado()==0)? "fa-times-circle":"fa-check-circle")."' href='#' data-toggle='tooltip' data-placement='left' title='" . ($e->getEstado()==0?"Inhabilitado":"Habilitado") . "'> </a></td>";
                            echo "<td>" . "
                                   <a id='ver".$e->getId()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearEncuesta.php") . "&modificar=true&idEncuesta=" . $e->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a id='cambiarEstado".$e->getId()."' href='#' class='fas fa-power-off' data-toggle='tooltip' data-placement='left' title='" . ($e->getEstado()==0?"Habilitar":"Inhabilitar") . "'> </a>
                                   <a id='Eliminar".$e->getId()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                                 </td>";
                           echo "</tr>";      
                           $i++;
                        }
                           echo "<tr><td colspan='5'>" . count($encuestas) . " registros encontrados</td></tr>";
                           echo "<tr><td colspan='5'>  <a class='fas fa-plus' href='index.php?pid=" . base64_encode("presentacion/administrador/crearEncuesta.php") . "&crear=true&idRol=" . $encuesta -> getRol() . "'>Agregar Encuesta</a> </td></tr>"?>
                
						</tbody>
					</table>
					</div>
				</div>
		</div>
	</div>	
</div>
					
<div class="modal" id="myModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head" style="background-color:#7317DA">
      <p class="modal-card-title has-text-white">Detalles De La Encuesta</p>
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
	 <?php foreach ($encuestas as $e) { ?>
		$("#ver<?php echo $e -> getId(); ?>").click(function(e){
			e.preventDefault();
			
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/encuesta/modalEncuesta.php") . "&idEncuesta=" . $e -> getId() . "\";\n"; ?>
			$("#modalContent").load(ruta);
			$("#myModal").addClass("is-active");
			
		});
		<?php } ?>

		$(".delete").click(function(e){
			e.preventDefault();
			$("#myModal").removeClass("is-active");
			
		});
		$('body').on('click', '.modal-background', function(){
			$("#myModal").removeClass("is-active");
		  })
});
</script>		

<script type="text/javascript">
$(document).ready(function(){
	 <?php foreach ($encuestas as $e) { ?>
		$("#Eliminar<?php echo $e -> getId(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar la Encuesta con todas sus preguntas?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/encuesta/encuestaAjax.php") ."&idRol=".$encuesta -> getRol()."&eliminar=true&idEncuesta=". $e -> getId()."\";\n"; ?>
				$("#resultadosEncuesta").load(ruta);
			}
		
		});
		// Cambiar estado
		$("#cambiarEstado<?php echo $e -> getId(); ?>").click(function(e){
			e.preventDefault();
		   <?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/encuesta/encuestaAjax.php") ."&idRol=".$encuesta -> getRol()."&cambiarEstado=true&idEncuesta=". $e -> getId()."&estado=". (($e -> getEstado()==0)? "1":"0")."\";\n"; ?>
			$("#resultadosEncuesta").load(ruta);
		
		});
		<?php } ?>
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#filtrar").keyup(function(){
	var filtroDato=$("#filtrar").val();
		<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/cliente/buscarClienteAjax.php") ."&filtro=\"+filtroDato;\n"; ?>
		$("#resultadosClientes").load(ruta);
	});
	
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#seleccionar1").click(function(){
		<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/encuesta/encuestaAjax.php") ."&idRol=1\";\n";  ?>
		<?php echo "var link = \"index.php?pid=" . base64_encode("presentacion/administrador/crearEncuesta.php") . "&crear=true&idRol=1\";\n";  ?>
		$('#agregar').attr('href', link);
		$("#resultadosEncuesta").load(ruta);
	});
	$("#seleccionar2").click(function(){
		<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/encuesta/encuestaAjax.php") ."&idRol=2\";\n"; ?>
		<?php echo "var link = \"index.php?pid=" . base64_encode("presentacion/administrador/crearEncuesta.php") . "&crear=true&idRol=2\";\n";  ?>
		$('#agregar').attr('href', link);
		$("#resultadosEncuesta").load(ruta);
	});
});
</script>