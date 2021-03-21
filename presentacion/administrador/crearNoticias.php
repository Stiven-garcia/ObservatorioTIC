<?php
$errorNoticia = 0;
$nombre = "";
$descripcion = "";
$fechaApertura = "";
$fechaCierre = "";
$id = "";
$tipo1 = 0;
$tipo = 0;
$noticia = null;
if(isset($_GET["crear"])){
    $tipo1 = $_GET["tipo"]; //Crear Noticia
    $tipo = 1;
}else{
    if(isset($_GET["modificar"])){ //Modificar Noticia
        $id = $_GET["idNoticia"];
        $noticia = new Noticia($id);
        $noticia -> consultar();
        $nombre = $noticia -> getNombre();
        $descripcion = $noticia -> getDescripcion();
        if($noticia -> getFechaCierre()=="0000-00-00"){
            $tipo1=1;
        }else{
            $fechaCierre = $noticia -> getFechaCierre();
            $tipo1=2;
        }
       
        $tipo = 2;
    }
}
if(isset($_POST["enviar"])){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    if($tipo1==2){
        $fecha = new DateTime($_POST["fechaCierre"]);
        $fechaCierre = $fecha->format('Y-m-d');
    }
    if($tipo==1){
        $fecha = new DateTime($_POST["fechaApertura"]);
        $fechaApertura =$fecha->format('Y-m-d');
        if($tipo1==2){
            $noticia = new Noticia("", $nombre, $descripcion, $fechaApertura, $fechaCierre);
        }else{
            $noticia = new Noticia("", $nombre, $descripcion, $fechaApertura);
        }
        if(!$noticia -> existeNoticia()){
            $noticia->registrar();
            $errorNoticia =1;
        }else{
            $errorNoticia =2;
        }
    }else{
        if($tipo == 2){
            if($tipo1==2){
                $noticia = new Noticia($id, $nombre, $descripcion, "", $fechaCierre);
                $noticia -> modificarEvento();
            }else{
                $noticia = new Noticia($id, $nombre, $descripcion);
                $noticia -> modificarNoticia();
            }
            
            $errorNoticia =3;
        }
    }
    
}
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-half">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo ($tipo==0)? "Crear Noticia y Evento" : ((($tipo==1)? "Crear ": "Modificar ") . (($tipo1==1)? "Noticia": "Evento"));  ?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearNoticias.php"). (($tipo==1)? "&crear=true&tipo=". $tipo1."" : "&modificar=true&idNoticia=". $id)?> method="post">
						<?php if($errorNoticia==1){
						    echo '<div class="notification is-success">
                              '. (($tipo1==1)? 'La noticia': 'El Evento') .' <strong>'. $noticia -> getNombre() .'</strong> ha sido '. (($tipo1==1)? 'agregada': 'agregado') .' con '. utf8_encode("éxito") .' al 
                              sistema
                                </div>';
						}else{ if($errorNoticia==3){
						    echo '<div class="notification is-success">
                              '. (($tipo1==1)? 'La noticia': 'El Evento') .' <strong>'. $noticia -> getNombre() .'</strong> ha sido '. (($tipo1==1)? 'modificada': 'modificado') .' con '. utf8_encode("éxito") .'
                                </div>';
						}}?>
						<div class="field" id="cajaNombre">
							<label class="label">Nombre</label>
							<div class="control has-icons-right">
								<input id="nombre" name="nombre" class="input <?php if($errorNoticia==2){ echo "is-danger"; }?>" type="text" required="required" placeholder="Nombre del evento o la noticia" value="<?php echo $nombre; ?>">
							     <span class='icon is-small is-right' id="iconoNombre"> <?php if($errorNoticia==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?> </span>
							</div>
							<div id="mensajeNombre"> <?php if($errorNoticia==2){ echo "<p class='help is-danger'> ". (($tipo1==1)? "La noticia": "El Evento")  ." ya se encuentra en el sistema</p>"; }?></div>
						</div>

						<div class="field">
							<label class="label"><?php echo utf8_encode("Descripción")?></label>
							<div class="control has-icons-right">
							  <textarea id="descripcion" name="descripcion" class="textarea" required="required" placeholder="<?php echo utf8_encode("Descripción del evento o la noticia")?>"><?php echo $descripcion; ?></textarea>
							    <span class='icon is-small is-right' id="iconoDescripcion"></span>
							</div>
						</div>
                       <?php if($tipo==1){ ?>
						<div class="field">
							<label class="label">Fecha Apertura</label>
							<div class="control has-icons-left has-icons-right">
								<input id="fechaApertura" name="fechaApertura" class="input" type="date" required="required" value="<?php echo $fechaApertura; ?>" style="width:250px">
							    <span class='icon is-small is-right' id="iconoFechaApertura"></span>
							</div>
							<div id="mensajeFechaApertura"></div>
						</div>
					<?php } ?>
					<?php if($tipo1==2){?>
					<div class="field">
							<label class="label">Fecha Cierre</label>
							<div class="control has-icons-left has-icons-right">
								<input id="fechaCierre" name="fechaCierre" class="input" type="date" required="required" value="<?php echo $fechaCierre; ?>" style="width:250px">
							    <span class='icon is-small is-right' id="iconoFechaCierre"></span>
							</div>
							<div id="mensajeFechaCierre"></div>
						</div>
					<?php } ?>
					<div class="field is-grouped">
							<div class="control">
								<button  type="submit" name="enviar" class="button" style="background-color:#7317DA; color:#FFFFFF"><?php echo ($tipo == 1)? "Crear" : "Modificar"; ?></button>
							</div>
							<div class="control">
								<a class="button is-light" style="border: 1px solid"  href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarNoticias.php"). "&tipo=". $tipo1?>" >Atras</a>
							</div>
						</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$("#fechaApertura").change(function(){
		$('#fechaCierre').attr('min', $("#fechaApertura").val());
	});
});
</script>
