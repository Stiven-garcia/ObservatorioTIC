<?php
$curso = new Curso();
$cursos = $curso -> consultarTodos();
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered " style="margin-top: 10px">
  <div class="column is-four-fifths">
 		<div class="columns">
                  <div class="column is-2 is-offset-10"> 
                  <a class="button" style="background-color:#7317DA; color:#FFFFFF"  href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearCursos.php")."&crear=true"?>" > <?php echo utf8_encode("Agregar Curso")?></a>
                  </div>
  		</div>
  </div>
</div>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-four-fifths">
		<div class="card" id="resultadosCurso" >
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo utf8_encode("Cursos")?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<table class="table is-striped is-hoverable">
						<thead>
							<tr>
								<th scope="col">Nombre</th>
								<th scope="col"><?php echo utf8_encode("Descripción")?></th>
								<th scope="col">link</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
						foreach ($cursos as $c) {
						    echo "<tr>";
						    echo "<td>" . $c -> getNombre() . "</td>";
						    echo "<td>" . $c -> limitar_cadena( $c->getDescripcion(), 100) . "</td>";
						    echo "<td>" . "<a href='". $c->getLink()."'>". (($c -> getLink()!="")?"'" . $c -> limitar_cadena( $c->getLink(), 80) . "'":"") ."</a></td>";
                            echo "<td>" . "
                                   <a id='ver".$c -> getId()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearCursos.php") . "&modificar=true&idCurso=" . $c -> getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a id='Eliminar".$c -> getId()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                                 </td>";
                           echo "</tr>";                
                        }
                           echo "<tr><td colspan='5'>" . count($cursos) . " registros encontrados</td></tr>
                           <tr><td colspan='5'>  <a href='index.php?pid=" . base64_encode("presentacion/administrador/crearCursos.php")."&crear=true'  class='fas fa-plus'>Agregar Curso</a> </td></tr>"?>
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
      <p class="modal-card-title has-text-white">Detalles Del Curso</p>
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
	 <?php foreach ($cursos as $c) { ?>
		$("#ver<?php echo $c -> getId(); ?>").click(function(e){
			e.preventDefault();
			
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/curso/modalCurso.php") . "&idCurso=" . $c -> getId() . "\";\n"; ?>
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
	 <?php foreach ($cursos as $c) { ?>
		$("#Eliminar<?php echo $c -> getId(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar este curso?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/curso/cursoAjax.php") ."&idCurso=". $c -> getId() ."\";\n"; ?>
				$("#resultadosCurso").load(ruta);
			}
		
		});
		<?php } ?>
});
</script>
