<?php
$noticia = new Noticia();
$noticias = null;
$tipo = $_GET["tipo"];
if($tipo == 1){
    $noticias = $noticia -> consultarNoticias();
}else{
    $noticias = $noticia -> consultarEventos();
}

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
                      <span><?php echo utf8_encode("Seleccioné el tipo")?></span>
                      <span class="icon is-small">
                        <i class="fas fa-angle-down" aria-hidden="true"></i>
                      </span>
                    </button>
                  </div>
                  <div class="dropdown-menu" role="menu">
                    <div class="dropdown-content">
                      <a id="seleccionar1" href="#" class="dropdown-item">
                        Noticias
                      </a>
                      <a id="seleccionar2" href="#" class="dropdown-item">
                        Eventos
                      </a>
                    </div>
                  </div>
                </div>
                  </div>
                  <div class="column"> 
                  <a id="agregar" class="button" style="background-color:#7317DA; color:#FFFFFF"   href="<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearNoticias.php") . "&crear=true&tipo=" . $tipo  ?>" > <?php echo (($tipo == 1)? "Agregar Noticia" : "Agregar Evento" )?></a>
                  </div>
  		</div>
  </div>
</div>

<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-four-fifths">
		<div class="card" id="resultadosNoticias" >
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo (($tipo == 1)? "Noticias Creadas" : "Eventos Creados") ?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<table class="table is-striped is-hoverable">
						<thead>
							<tr>
							    <th scope="col">ID</th>
								<th scope="col">Nombre</th>
								<th scope="col"><?php echo utf8_encode("Descripción")?></th>
								<th scope="col">Fecha Apertura</th>
	     <?php if($tipo == 2){?><th scope="col">Fecha Cierre</th><?php } ?>
								<th scope="col">Servicios</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i=1;
						foreach ($noticias as $n) {
						    echo "<tr>";
						    echo "<td>" . $i . "</td>";
                            echo "<td>" . $n -> limitar_cadena($n -> getNombre(), 25). "</td>";
                            echo "<td>" . $n->limitar_cadena($n -> getDescripcion(),58) . "</td>";
                            echo "<td>" . $n -> getFechaApertura() . "</td>";
                            if($tipo == 2){  echo "<td>" . $n -> getFechaCierre() . "</td>"; }
                            echo "<td>" . "
                                   <a id='ver".$n->getId()."' class='fas fa-eye' data-toggle='tooltip' data-placement='left' title='Ver Detalles'> </a>
                                   <a class='fas fa-pencil-ruler' href='index.php?pid=" . base64_encode("presentacion/administrador/crearNoticias.php") . "&modificar=true&idNoticia=" . $n->getId() . "' data-toggle='tooltip' data-placement='left' title='Actualizar'> </a>
                                   <a id='Eliminar".$n->getId()."' href='#' class='fas fa-times' data-toggle='tooltip' data-placement='left' title='Eliminar'> </a>
                                 </td>";
                           echo "</tr>";                
                        }
                           echo "<tr><td colspan='6'>" . count($noticias) . " registros encontrados</td></tr>";
                           echo "<tr><td colspan='6'>  <a class='fas fa-plus' href='index.php?pid=" . base64_encode("presentacion/administrador/crearNoticias.php") . "&crear=true&tipo=" . $tipo . "'>Agregar ". (($tipo==1)? "Noticia":"Evento") ."</a> </td></tr>"?>
                
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
      <p class="modal-card-title has-text-white">Detalles <?php echo (($tipo == 1)? "De La Noticia" : "Del Evento") ?></p>
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
	 <?php foreach ($noticias as $n) { ?>
		$("#ver<?php echo $n -> getId(); ?>").click(function(e){
			e.preventDefault();
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/noticia/modalNoticia.php") . "&idNoticia=" . $n -> getId() . "\";\n"; ?>
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
	 <?php foreach ($noticias as $n) { ?>
		$("#Eliminar<?php echo $n -> getId(); ?>").click(function(e){
			e.preventDefault();
			var respuesta = false;
		  respuesta = confirm("Desea eliminar <?php echo ($n -> getFechaCierre() == "0000-00-00")? "la noticia":"el evento"?> ?")
			if(respuesta){
				<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/noticia/noticiaAjax.php") ."&tipo=".$tipo."&idNoticia=". $n -> getId()."\";\n"; ?>
				$("#resultadosNoticias").load(ruta);
			}
		
		});
		<?php } ?>
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#seleccionar1").click(function(){
		<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/noticia/noticiaAjax.php") ."&tipo=1\";\n";  ?>
		<?php echo "var link = \"index.php?pid=" . base64_encode("presentacion/administrador/crearNoticias.php") . "&crear=true&tipo=1\";\n";  ?>
		$('#agregar').attr('href', link);
		$('#agregar').text("Agregar Noticia");
		$("#resultadosNoticias").load(ruta);
	});
	$("#seleccionar2").click(function(){
		<?php echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/noticia/noticiaAjax.php") ."&tipo=2\";\n"; ?>
		<?php echo "var link = \"index.php?pid=" . base64_encode("presentacion/administrador/crearNoticias.php") . "&crear=true&tipo=2\";\n";  ?>
		$('#agregar').attr('href', link);
		$('#agregar').text("Agregar Evento");
		$("#resultadosNoticias").load(ruta);
	});
});
</script>