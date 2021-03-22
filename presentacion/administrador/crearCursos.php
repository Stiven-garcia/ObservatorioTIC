<?php
$errorCurso = 0;
$nombre = "";
$descripcion="";
$link="";
$fechaApertura = "";
$fechaCierre = "";
if(isset($_GET["crear"])){
    $tipo = 1;
}else{
    if(isset($_GET["modificar"])){
        $id = $_GET["idHerramienta"];
        $curso = new Curso($id);
        $curso -> consultar();
        $nombre = $curso -> getNombre();
        $descripcion = $curso -> getDescripcion();
        $link = $curso -> getLink();
        $fechaApertura = $curso -> getFechaApertura();
        $fechaCierre = $curso -> getFechaCierre();
        $tipo = 2;
    }
}

if(isset($_POST["enviar"])){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $fechaApertura = $_POST["fechaApertura"];
    $fechaCierre = $_POST["fechaCierre"];
    $link  = $_POST["link"];
    if($tipo==1){
        $curso = new Curso("", $nombre, $descripcion, $link, $fechaApertura, $fechaCierre );
        if(!$curso -> existeCurso()){
            $curso -> registrar();
            $errorCurso = 1;
        }else{
            $errorCurso = 2;
        }
    }else{
        if($tipo==2){
            $curso = new Curso($id, $nombre, $descripcion, $link, $fechaApertura, $fechaCierre);
            $curso -> actualizar();
            $errorCurso = 3;
        }
    }
}
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-half">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo (($tipo==1)? "Crear":"Modificar")?> Curso</p>
			</header>
				<div class="card-content">
					<div class="content">
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearHerramientas.php"). (($tipo==1)? "&crear=true" : "&modificar=true&idHerramienta=".$id) ?> method="post">
						<?php if($errorCurso==1){
						    echo utf8_encode('<div class="notification is-success">
                               El curso ha sido credo con exito
                                </div>');
						}?>
						<?php if($errorCurso==3){
						    echo utf8_encode('<div class="notification is-success">
                               El curso ha sido modificado con exito
                                </div>');
						}?>
						<?php if($errorCurso==2){
						    echo utf8_encode('<div class="notification is-danger">
                               El curso ya se encuentra en el sistema
                                </div>');
						}?>
						<div class="field">
							<label class="label">Nombre</label>
							<div class="control has-icons-right">
								<textarea id="nombre" name="nombre" class="textarea" required="required" placeholder="Ingrese el nombre del curso"><?php echo $nombre; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"></span>
							</div>
						</div>
						
						<div class="field">
							<label class="label"><?php echo utf8_encode("Descripción")?></label>
							<div class="control has-icons-right">
								<textarea id="descripcion" name="descripcion" class="textarea" required="required" placeholder="Ingrese la <?php echo utf8_encode("descripción")?> del curso"><?php echo $descripcion; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"></span>
							</div>
						</div>
						
						<div class="field">
							<label class="label">Link del curso</label>
							<div class="control has-icons-right">
								<textarea id="link" name="link" class="textarea" required="required" placeholder="Ingrese el link del curso"><?php echo $link; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"></span>
							</div>
						</div>
						
						<div class="field">
							<label class="label">Fecha Apertura <small style="color:#716E70">(opcional)</small></label>
							<div class="control has-icons-left has-icons-right">
								<input id="fechaApertura" name="fechaApertura" class="input" type="date" value="<?php echo $fechaApertura; ?>" style="width:250px">
							    <span class='icon is-small is-right' id="iconoFechaApertura"></span>
							</div>
							<div id="mensajeFechaApertura"></div>
						</div>
						
					<div class="field">
							<label class="label">Fecha Cierre <small style="color:#716E70">(opcional)</small></label>
							<div class="control has-icons-left has-icons-right">
								<input id="fechaCierre" name="fechaCierre" class="input" type="date" value="<?php echo $fechaCierre; ?>" style="width:250px">
							    <span class='icon is-small is-right' id="iconoFechaCierre"></span>
							</div>
							<div id="mensajeFechaCierre"></div>
						</div>
					
					<div class="field is-grouped">
							<div class="control">
								<button  type="submit" name="enviar" class="button" style="background-color:#7317DA; color:#FFFFFF"><?php echo (($tipo==1)? "Crear":"Modificar")?></button>
							</div>
							<div class="control">
								<a class="button is-light" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarCursos.php")?>" >Cancelar</a>
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
