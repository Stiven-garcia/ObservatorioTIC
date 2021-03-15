<?php 

?><div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-four-fifths">
		<div class="card" id="resultadosCategoria" >
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo utf8_encode("Opciones")?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<table class="table is-striped is-hoverable">
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
						foreach ($categorias as $c) {
						    echo "<tr>";
                            echo "<td>" . $c->getNombre() . "</td>";
                            echo "<td>" . $c->limitar_cadena(70) . "</td>";
                            echo "<td>" . $c->getValor() . "</td>";
                            echo "<td>" . $c->cantidadIndicadores() . "</td>";
                            echo "<td>" . "
                                   <a id='ver".$c->getId()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearCategoria.php") . "&modificar=true&idCategoria=" . $c->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a class='fas fa-tasks' href='index.php?pid=".base64_encode("presentacion/administrador/consultarIndicador.php") ."&idCategoria=".$c->getId()."' data-toggle='tooltip' data-placement='left' title='Indicadores'> </a>
                                   <a id='Eliminar".$c->getId()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                                 </td>";
                           echo "</tr>";                
                        }
                           echo "<tr><td colspan='5'>" . count($categorias) . " registros encontrados</td></tr>";
                           echo "<tr><td colspan='5'>  <a class='fas fa-plus' href='index.php?pid=" . base64_encode("presentacion/administrador/crearCategoria.php") . "&crear=true&idRol=" . $categoria -> getRol() . "'>Agregar Categoria</a> </td></tr>"?>
                
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
      <p class="modal-card-title has-text-white">Detalles De La Categoria</p>
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
	 <?php foreach ($categorias as $c) { ?>
		$("#ver<?php echo $c -> getId(); ?>").click(function(e){
			e.preventDefault();
			
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/categoria/modalCategoria.php") . "&idCategoria=" . $c -> getId() . "\";\n"; ?>
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
	 <?php foreach ($categorias as $c) { ?>
		$("#Eliminar<?php echo $c -> getId(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar la categoria con todos sus indicadores?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/categoria/categoriaAjax.php") ."&idRol=".$categoria -> getRol()."&idCategoria=". $c -> getId()."\";\n"; ?>
				$("#resultadosCategoria").load(ruta);
			}
		
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
		<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/categoria/categoriaAjax.php") ."&idRol=1\";\n";  ?>
		<?php echo "var link = \"index.php?pid=" . base64_encode("presentacion/administrador/crearCategoria.php") . "&crear=true&idRol=1\";\n";  ?>
		$('#agregar').attr('href', link);
		$("#resultadosCategoria").load(ruta);
	});
	$("#seleccionar2").click(function(){
		<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/categoria/categoriaAjax.php") ."&idRol=2\";\n"; ?>
		<?php echo "var link = \"index.php?pid=" . base64_encode("presentacion/administrador/crearCategoria.php") . "&crear=true&idRol=2\";\n";  ?>
		$('#agregar').attr('href', link);
		$("#resultadosCategoria").load(ruta);
	});
});
</script>