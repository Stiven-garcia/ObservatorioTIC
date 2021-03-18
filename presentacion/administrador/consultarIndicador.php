<?php
$categoria = new Categoria($_GET["idCategoria"]);
$categoria -> consultar();
$indicador = new Indicador("","","","", $categoria -> getId());
$indicadores = $indicador -> consultarTodos();
include 'presentacion/home/menu.php';
?>

<div class="columns is-centered " style="margin-top: 10px">
  <div class="column is-four-fifths">
 		<div class="columns">
                  <div class="column is-2 is-offset-10"> 
                  <a class="button" style="background-color:#7317DA; color:#FFFFFF"  href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearIndicador.php") . "&crear=true&idCategoria=" . $categoria -> getId() ?>" > <?php echo utf8_encode("Agregar Indicador")?></a>
                  </div>
  		</div>
  </div>
</div>

<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-four-fifths">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px ">Indicadores de Categoria "<?php echo $categoria -> getNombre();?>"</p>
			</header>
				<div class="card-content">
					<div class="content">
					<div id="resultadosIndicador">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col">Descripcion</th>
								<th scope="col">Valor</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
                foreach ($indicadores as $in) {
                    echo "<tr>";
                    echo "<td>" . $in -> getNombre() . "</td>";
                    echo "<td>" . $in -> limitar_cadena(70) . "</td>";
                    echo "<td>" . $in -> getValor() . "</td>";
                    echo "<td>" . "<a id='ver".$in->getIdIndicador()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearIndicador.php") . "&modificar=true&idIndicador=" . $in -> getIdIndicador() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a class='fas fa-tasks' href='index.php?pid=" . base64_encode("presentacion/administrador/consultarVariables.php") . "&idIndicador=" . $in->getIdIndicador() . "' data-toggle='tooltip' data-placement='left' title='Ver Variables'> </a>
                                   <a id='Eliminar".$in->getIdIndicador()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                          </td>";
                    echo "</tr>";
                
                }
                echo "<tr><td colspan='9'>" . count($indicadores) . " registros encontrados</td></tr>
                       <tr><td colspan='5'>  <a href='index.php?pid=" . base64_encode("presentacion/administrador/crearIndicador.php") . "&crear=true&idCategoria=" . $categoria -> getId() .  "'  class='fas fa-plus'>Agregar Indicador</a> </td></tr>"?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <div class="column is-2 is-offset-10"> 
      <a class="button is-light" style="border: 1px solid"  href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/consultarCategoria.php") . "&idRol=" . $categoria ->  getRol() ?>" > <?php echo utf8_encode("Atras")?></a>
 </div>

<div class="modal" id="modalIndicador">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head" style="background-color:#7317DA">
      <p class="modal-card-title has-text-white">Detalles Del Indicador</p>
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
	 <?php foreach ($indicadores as $in) { ?>
		$("#ver<?php echo $in -> getIdIndicador(); ?>").click(function(e){
			
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/indicador/modalIndicador.php") . "&idIndicador=" . $in -> getIdIndicador() . "\";\n"; ?>
			$("#modalContent").load(ruta);
			$("#modalIndicador").addClass("is-active");
			
		});
		<?php } ?>

		$(".delete").click(function(e){
			e.preventDefault();
			$("#modalIndicador").removeClass("is-active");
			
		});
		$('body').on('click', '.modal-background', function(){
			$("#modalIndicador").removeClass("is-active");
		  })
});
</script>	

<script type="text/javascript">
$(document).ready(function(){
	 <?php foreach ($indicadores as $in) { ?>
		$("#Eliminar<?php echo $in -> getIdIndicador(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar este indicador?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/indicador/indicadorAjax.php") ."&idCategoria=".$categoria -> getId()."&idIndicador=". $in -> getIdIndicador()."\";\n"; ?>
				$("#resultadosIndicador").load(ruta);
			}
		
		});
		<?php } ?>
});
</script>
