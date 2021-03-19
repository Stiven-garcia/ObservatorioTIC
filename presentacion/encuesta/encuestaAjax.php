<?php
$rol = $_GET["idRol"];
if(isset($_GET["eliminar"])){
    $encuesta = new Encuesta($_GET["idEncuesta"]);
    $encuesta -> eliminar();
}else{
    if(isset($_GET["cambiarEstado"])){
        $encuesta = new Encuesta($_GET["idEncuesta"],$rol, "",$_GET["estado"] );
        $encuesta -> cambiarEstado();
        $encuesta -> cambiarActivada();
        if($_GET["estado"]==1){
            $encuesta -> activarUsuarios();
        }
        
    }
}
$encuesta = new Encuesta("", $rol);
$encuestas = $encuesta -> consultarTodos();
?>
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
								<th scope="col">Cantidad de Preguntas</th>
								<th scope="col">Completo</th>
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
                            echo "<td>" . $e -> cantidadPreguntas() . "</td>";
                            echo "<td> <progress class='progress' value='". ($e -> completa()*100)/$e ->valorCategorias()  ."' max='100' data-toggle='tooltip' data-placement='left' title='". round (($e -> completa()*100)/$e ->valorCategorias(),2) ."%'></progress></td>";
                            echo "<td> <i id='estado" . $e->getId() . "' class='fas ".(($e->getEstado()==0)? "fa-times-circle":"fa-check-circle")."' href='#' data-toggle='tooltip' data-placement='left' title='" . ($e->getEstado()==0?"Inhabilitado":"Habilitado") . "'> </i></td>";
                            echo "<td>" . "
                                   <a id='ver".$e->getId()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' style='margin-right:2px' href='index.php?pid=" . base64_encode("presentacion/administrador/crearEncuesta.php") . "&modificar=true&idEncuesta=" . $e->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>";
                                   if( $e->getActivada()==1 && $e->getEstado()==0){}else{ echo "<a style='margin-right:2px; margin-left:2px' id='cambiarEstado".$e->getId()."' href='#' class='fas fa-power-off' data-toggle='tooltip' data-placement='left' title='" . ($e->getEstado()==0?"Habilitar":"Inhabilitar") . "'> </a>";}
                                  echo "<a id='Eliminar".$e->getId()."'style='margin-left:2px' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                                 </td>";
                           echo "</tr>";     
                           $i++;
                        }
                           echo "<tr><td colspan='6'>" . count($encuestas) . " registros encontrados</td></tr>";
                           echo "<tr><td colspan='6'>  <a class='fas fa-plus' href='index.php?pid=" . base64_encode("presentacion/administrador/crearEncuesta.php") . "&crear=true&idRol=" . $encuesta -> getRol() . "'>Agregar Encuesta</a> </td></tr>"?>
                
						</tbody>
					</table>
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
			<?php if(($e -> completa()*100)/$e ->valorCategorias()!=100){ ?>
			<?php if($e -> getEstado()==1){ ?>
			<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/encuesta/encuestaAjax.php") ."&idRol=".$encuesta -> getRol()."&cambiarEstado=true&idEncuesta=". $e -> getId()."&estado=". (($e -> getEstado()==0)? "1":"0")."\";\n"; ?>
			$("#resultadosEncuesta").load(ruta);
			<?php }else{?>
			alert("Complete la encuesta para poderla activar");
			<?php } ?>
				<?php }else{?>
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/encuesta/encuestaAjax.php") ."&idRol=".$encuesta -> getRol()."&cambiarEstado=true&idEncuesta=". $e -> getId()."&estado=". (($e -> getEstado()==0)? "1":"0")."\";\n"; ?>
				$("#resultadosEncuesta").load(ruta);
				
		   <?php } ?>
		
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