<?php
$errorCategoria = 0;
$nombre = "";
$descripcion = "";
$valor = "";
$id = "";
$rol = "";
$tipo = 0;
$categoria = null;
if(isset($_GET["crear"])){
    $rol = $_GET["idRol"]; //Crear Categoria
    $tipo = 1;
}else{
    if(isset($_GET["modificar"])){ //Modificar Categoria
        $id = $_GET["idCategoria"];
        $categoria = new Categoria($id);
        $categoria -> consultar();
        $nombre = $categoria -> getNombre();
        $descripcion = $categoria -> getDescripcion();
        $valor = $categoria -> getValor();
        $rol = $categoria -> getRol();
        $tipo = 2;
    }
}
if(isset($_POST["enviar"])){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $valor = $_POST["valor"];
    $rol = $_POST["rol"];
    if($tipo==1){
        $categoria = new Categoria("", $nombre, $descripcion, $valor, $rol);
        if(!$categoria -> existeCategoria()){
            $categoria->registrar();
            $errorCategoria =1;
        }else{
            $errorCategoria =2;
        }
    }else{
        if($tipo == 2){
            $categoria = new Categoria($id, $nombre, $descripcion, $valor, $rol);
            $categoria -> modificar();
            $errorCategoria =3;
        }
    }
    
}
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-half">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo ($tipo==1)? "Crear Categoria": "Modificar Categoria";  ?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearCategoria.php"). (($tipo==1)? "&crear=true&idRol=". $rol."" : "&modificar=true&idCategoria=". $id)?> method="post">
						<?php if($errorCategoria==1){
						    echo '<div class="notification is-success">
                              La '. utf8_encode("categoría") .' <strong>'. $categoria -> getNombre() .'</strong> ha sido agregada con '. utf8_encode("éxito") .' al 
                              modelo de <strong>'. (($categoria -> getRol() == 1)? "Profesores" : "Estudiantes" ).'</strong>
                                </div>';
						}else{ if($errorCategoria==3){
						    echo '<div class="notification is-success">
                              La '. utf8_encode("categoría") .' <strong>'. $categoria -> getNombre() .'</strong> perteneciente al 
                              modelo de <strong>'. (($categoria -> getRol() == 1)? "Profesores" : "Estudiantes" ).'</strong> ha sido modificada con '. utf8_encode("éxito") .'
                                </div>';
						}}?>
						<div class="field" id="cajaNombre">
							<label class="label">Nombre</label>
							<div class="control has-icons-right">
								<input id="nombre" name="nombre" class="input <?php if($errorCategoria==2){ echo "is-danger"; }?>" type="text" required="required" placeholder="Nombre de la categoria" value="<?php echo $nombre; ?>">
							     <span class='icon is-small is-right' id="iconoNombre"> <?php if($errorCategoria==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?> </span>
							</div>
							<div id="mensajeNombre"> <?php if($errorCategoria==2){ echo "<p class='help is-danger'>La ". utf8_encode("categoría") ." ya se encuentra en el sistema</p>"; }?></div>
						</div>

						<div class="field">
							<label class="label"><?php echo utf8_encode("Descripción")?></label>
							<div class="control has-icons-right">
							  <textarea id="descripcion" name="descripcion" class="textarea" required="required" placeholder="<?php echo utf8_encode("Descripción de la categoria")?>"><?php echo $descripcion; ?></textarea>
							    <span class='icon is-small is-right' id="iconoDescripcion"></span>
							</div>
						</div>

						<div class="field">
							<label class="label">Valor</label>
							<div class="control has-icons-left has-icons-right">
								<input id="valor" name="valor" class="input" type="number" min="0" required="required" step="any" value="<?php echo $valor; ?>" style="width:180px">
							    <span class='icon is-small is-right' id="iconoValor"></span>
							</div>
							<div id="mensajeValor"></div>
						</div>
					
					<div class="field">
						<label class="label">Modelo</label>
						<div class="control">
							<div class="select">
								<select name="rol" >
									<option value="<?php echo $rol;?>" ><?php echo ($rol==1)? "Profesores" : "Estudiantes";?></option>
								</select>
							</div>
						</div>
					</div>
					<div class="field is-grouped">
							<div class="control">
								<button  type="submit" name="enviar" class="button" style="background-color:#7317DA; color:#FFFFFF"><?php echo ($tipo == 1)? "Crear" : "Modificar"; ?></button>
							</div>
							<div class="control">
								<a class="button is-light" style="border: 1px solid"  href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarCategoria.php"). "&idRol=". $rol?>" >Atras</a>
							</div>
						</div>
						</form>
					</div>
				</div>
		</div>
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {
	<!-- Validar Nombres  -->
	$("#nombre").blur(function (){
		var letras = /^[a-zA-ZñÑ\s\W]+$/;
			if(!letras.test($("#nombre").val())){
				$("#nombre").removeClass();
				$("#nombre").addClass("input is-danger");
				$("#iconoNombre").empty();
			    $("#iconoNombre").append("<i class='fas fa-exclamation-triangle'></i>");
			    $("#mensajeNombre").empty();
			    $("#mensajeNombre").append("<p class='help is-danger'>Digite un nombre correcto</p>");
			}else{
				$("#nombre").removeClass();
                $("#nombre").addClass("input is-success");
                $("#iconoNombre").empty();
                $("#iconoNombre").append("<i class='fas fa-check'></i>");
                $("#mensajeNombre").empty();
			}
			
	  });
	<!-- Validar Nombres  -->
	$("#valor").blur(function (){
			if($("#valor").val()==0){
				$("#valor").removeClass();
				$("#valor").addClass("input is-danger");
				$("#iconoValor").empty();
			    $("#iconoValor").append("<i class='fas fa-exclamation-triangle'></i>");
			    $("#mensajeValor").empty();
			    $("#mensajeValor").append("<p class='help is-danger'>El valor no puede ser 0</p>");
			}else{
				$("#valor").removeClass();
                $("#valor").addClass("input is-success");
                $("#iconoValor").empty();
                $("#iconoValor").append("<i class='fas fa-check'></i>");
                $("#mensajeValor").empty();
			}
			
	  });
	  
});
</script>