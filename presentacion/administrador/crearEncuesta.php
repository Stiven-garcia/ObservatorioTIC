<?php
$rol = "";
$encuesta = null;
if(isset($_GET["crear"])){
    $rol = $_GET["idRol"]; //Crear Encuesta
    $encuesta = new Encuesta("",$rol,date('Y-m-d H:i:s'));
    $encuesta = new Encuesta($encuesta -> registrar());
    $encuesta -> consultar();
}else{
    if(isset($_GET["modificar"])){ //Modificar Categoria
        $id = $_GET["idEncuesta"];
        $encuesta = new Encuesta($id);
        $encuesta -> consultar();
    }
}

$pregunta = new Pregunta("","","", $encuesta -> getId());
$preguntas = $pregunta -> consultarTodos();
include 'presentacion/home/menu.php';
?>
<?php if($encuesta -> getActivada()==0){?>
<div class="columns is-centered " style="margin-top: 10px">
  <div class="column is-four-fifths">
 		<div class="columns">
                  <div class="column is-2 is-offset-10"> 
                  <a class="button" style="background-color:#7317DA; color:#FFFFFF"  href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearPregunta.php") . "&crear=true&idEncuesta=" . $encuesta -> getId() ?>" > <?php echo utf8_encode("Agregar Pregunta")?></a>
                  </div>
  		</div>
  </div>
</div>
<?php }?>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-four-fifths">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px ">Preguntas de la Encuesta Creada en la Fecha <?php echo $encuesta -> getfecha();?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<div id="resultadosEncuesta">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
							   <th scope="col">ID</th>
								<th scope="col">Pregunta</th>
								<th scope="col">Valor</th>
								<th scope="col">Variable</th>
								<th scope="col">Numero de Opciones</th>
								<th scope="col">Completo</th>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 1;
                foreach ($preguntas as $p) {
                    echo "<tr>";
                    echo "<td>" . $i . "</td>";
                    echo "<td>" . $p -> limitar_cadena($p -> getPregunta(),58) . "</td>";
                    echo "<td>" . $p -> getValor() . "</td>";
                    echo "<td>" . $p -> limitar_cadena($p -> getVariable(),58) . "</td>";
                    echo "<td>" . $p -> cantidadOpciones() . "</td>";
                    echo "<td> <progress class='progress' value='". ($p -> completa()*100)/$p -> getValor()  ."' max='100' data-toggle='tooltip' data-placement='left' title='". round(($p -> completa()*100)/$p -> getValor(),2) ."%'></progress></td>";
                    echo "<td>" . "<a id='ver".$p->getId()."' class='fas fa-eye' style='margin-right:2px' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>";
                    if($encuesta -> getActivada()==0){      echo "<a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearPregunta.php") . "&modificar=true&idPregunta=" . $p->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>";}
                                 echo "<a class='fas fa-tasks' style='margin-right:2px; margin-left:2px' href='index.php?pid=" . base64_encode("presentacion/administrador/consultarOpciones.php") . "&idPregunta=" . $p->getId() . "' data-toggle='tooltip' data-placement='left' title='Ver Opciones'> </a>";
                                 if($encuesta -> getActivada()==0){   echo "<a id='Eliminar".$p->getId()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>";}
                       echo "</td>";
                    echo "</tr>";
                    $i++;
                
                }
                echo "<tr><td colspan='9'>" . count($preguntas) . " registros encontrados</td></tr>";
                if($encuesta -> getActivada()==0){  echo "<tr><td colspan='7'>  <a href='index.php?pid=" . base64_encode("presentacion/administrador/crearPregunta.php") . "&crear=true&idPregunta=" . $encuesta -> getId() .  "'  class='fas fa-plus'>Agregar Pregunta</a> </td></tr>";}?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 <div class="column is-2 is-offset-10"> 
      <a class="button is-light" style="border: 1px solid"  href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/modificarEncuesta.php") . "&idRol=" . $encuesta ->  getRol() ?>" > <?php echo utf8_encode("Atras")?></a>
 </div>

<div class="modal" id="modalPregunta">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head" style="background-color:#7317DA">
      <p class="modal-card-title has-text-white">Detalles De la Pregunta</p>
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
				$("#resultadosEncuesta").load(ruta);
			}
		
		});
		<?php } ?>
});
</script>