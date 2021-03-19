<?php
$errorHerramienta = 0;
$nombre = "";
$descripcion="";
$logo = "";
$link="";
$error=0;
$indicador= null;
if(isset($_GET["crear"])){
    $tipo = 1;
}else{
    if(isset($_GET["modificar"])){
        $id = $_GET["idHerramienta"];
        $herramientaE = new Herramienta($id);
        $herramientaE -> consultar();
        $nombre = $herramientaE -> getNombre();
        $descripcion = $herramientaE -> getDescripcion();
        $logo = $herramientaE -> getLogo();
        $link = $herramientaE -> getLink();
        $tipo = 2;
    }
}

if(isset($_POST["enviar"])){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $logo  = $_POST["logo"];
    $link  = $_POST["link"];
    if($tipo==1){
        $herramientaE = new Herramienta("", $nombre, $descripcion,  $logo, $link );
        if(!$herramientaE -> existeHerramienta()){
            $herramientaE -> registrar();
            $errorHerramienta = 1;   
        }else{
            $errorHerramienta = 2;
        }
    }else{
        if($tipo==2){
            $herramientaE = new Herramienta($id, $nombre, $descripcion, $logo, $link);
             $herramientaE -> actualizar();
             $errorHerramienta = 3;
        }
    }
}
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-half">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo (($tipo==1)? "Crear":"Modificar")?> Herramienta</p>
			</header>
				<div class="card-content">
					<div class="content">
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearHerramientas.php"). (($tipo==1)? "&crear=true" : "&modificar=true&idHerramienta=".$id) ?> method="post">
						<?php if($errorHerramienta==1){
						    echo utf8_encode('<div class="notification is-success">
                               La herramienta ha sido creda con exito
                                </div>');
						}?>
						<?php if($errorHerramienta==3){
						    echo utf8_encode('<div class="notification is-success">
                               La herramienta ha sido modificada con exito
                                </div>');
						}?>
						<div class="field">
							<label class="label">Nombre Herramienta</label>
							<div class="control has-icons-right">
								<textarea id="nombre" name="nombre" class="textarea <?php if($errorHerramienta==2){ echo "is-danger"; }?>" required="required" placeholder="Ingrese la herramienta"><?php echo $nombre; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"><?php if($errorHerramienta==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?></span>
							</div>
							<div id="mensajePregunta"> <?php if($errorHerramienta==2){ echo "<p class='help is-danger'>La ". utf8_encode("herramienta") ." ya se encuentra en el sistema</p>"; }?></div>
						</div>
						
						<div class="field">
							<label class="label"><?php echo utf8_encode("Descripción")?></label>
							<div class="control has-icons-right">
								<textarea id="descripcion" name="descripcion" class="textarea <?php if($errorHerramienta==2){ echo "is-danger"; }?>" required="required" placeholder="Ingrese la <?php echo utf8_encode("sescripción")?>< de la herramienta"><?php echo $descripcion; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"><?php if($errorHerramienta==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?></span>
							</div>
							<div id="mensajePregunta"> <?php if($errorHerramienta==2){ echo "<p class='help is-danger'>La ". utf8_encode("herramienta") ." ya se encuentra en el sistema</p>"; }?></div>
						</div>
						
						<div class="field">
							<label class="label">Enlace del logo</label>
							<div class="control has-icons-right">
								<textarea id="logo" name="logo" class="textarea <?php if($errorHerramienta==2){ echo "is-danger"; }?>" required="required" placeholder="Ingrese el enlace del logo de la herramienta"><?php echo $logo; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"><?php if($errorHerramienta==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?></span>
							</div>
							<div id="mensajePregunta"> <?php if($errorHerramienta==2){ echo "<p class='help is-danger'>La ". utf8_encode("herramienta") ." ya se encuentra en el sistema</p>"; }?></div>
						</div>
						
						<div class="field">
							<label class="label">Link de la herramienta</label>
							<div class="control has-icons-right">
								<textarea id="link" name="link" class="textarea <?php if($errorHerramienta==2){ echo "is-danger"; }?>" required="required" placeholder="Ingrese el link de la herramienta"><?php echo $link; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"><?php if($errorHerramienta==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?></span>
							</div>
							<div id="mensajePregunta"> <?php if($errorHerramienta==2){ echo "<p class='help is-danger'>La ". utf8_encode("herramienta") ." ya se encuentra en el sistema</p>"; }?></div>
						</div>
						
					
					<div class="field is-grouped">
							<div class="control">
								<button  type="submit" name="enviar" class="button" style="background-color:#7317DA; color:#FFFFFF"><?php echo (($tipo==1)? "Crear":"Modificar")?></button>
							</div>
							<div class="control">
								<a class="button is-light" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarVariables.php"). "&idIndicador=".$indicador -> getIdIndicador()?>" >Cancelar</a>
							</div>
						</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>



