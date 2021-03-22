<?php
$herramienta = new Herramienta();
$herramientas = $herramienta -> consultarTodos();
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered " style="margin-top: 10px">
  <div class="column is-four-fifths">
 		<div class="columns">
                  <div class="column is-2 is-offset-10"> 
                  <a class="button" style="background-color:#7317DA; color:#FFFFFF"  href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearHerramientas.php")."&crear=true"?>" > <?php echo utf8_encode("Agregar Herramienta")?></a>
                  </div>
  		</div>
  </div>
</div>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-four-fifths">
		<div class="card" id="resultadosHerramienta" >
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo utf8_encode("Herramientas")?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<table class="table is-striped is-hoverable">
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col"><?php echo utf8_encode("Descripción")?></th>
								<th scope="col">logo</th>
								<th scope="col">link</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($herramientas as $h) {
						    echo "<tr>";
                            echo "<td>" . $h -> getNombre() . "</td>";
                            echo "<td>" . $h -> limitar_cadena( $h->getDescripcion(), 100) . "</td>";
                            echo "<td>" . (($h -> getLogo()!="")?"<img src='" . $h -> getLogo() . "'  height='60px' width='150px'>":"") . "</td>";
                            echo "<td>" . "<a href='". $h->getLink()."'>". (($h -> getLink()!="")?"'" . $h -> limitar_cadena( $h->getLink(), 80) . "'":"") ."</a></td>";
                            echo "<td>" . "
                                   <a id='ver".$h -> getId()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearHerramientas.php") . "&modificar=true&idHerramienta=" . $h -> getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a id='Eliminar".$h -> getId()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                                 </td>";
                           echo "</tr>";                
                        }
                           echo "<tr><td colspan='5'>" . count($herramientas) . " registros encontrados</td></tr>
                           <tr><td colspan='5'>  <a href='index.php?pid=" . base64_encode("presentacion/administrador/crearHerramientas.php")."&crear=true'  class='fas fa-plus'>Agregar Herramienta</a> </td></tr>"?>
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
      <p class="modal-card-title has-text-white">Detalles De La Herramienta</p>
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
	 <?php foreach ($herramientas as $h) { ?>
		$("#ver<?php echo $h -> getId(); ?>").click(function(e){
			e.preventDefault();
			
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/herramienta/modalHerramienta.php") . "&idHerramienta=" . $h -> getId() . "\";\n"; ?>
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
	 <?php foreach ($herramientas as $h) { ?>
		$("#Eliminar<?php echo $h -> getId(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar esta herramienta?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/herramienta/herramientaAjax.php") ."&idHerramienta=". $h -> getId() ."\";\n"; ?>
				$("#resultadosHerramienta").load(ruta);
			}
		
		});
		<?php } ?>
});
</script>