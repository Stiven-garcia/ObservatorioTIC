<?php
$errorIndicador = 0;
$error = 0;
$nombre = "";
$descripcion = "";
$valor = "";
$id = "";
$idCategoria = "";
$tipo = 0;
$indicador = null;
if(isset($_GET["crear"])){
    $idCategoria = $_GET["idCategoria"]; //Crear Categoria
    $tipo = 1;
}else{
    if(isset($_GET["modificar"])){ //Modificar Categoria
        $id = $_GET["idIndicador"];
        $indicador = new Indicador($id);
        $indicador -> consultar();
        $nombre =  $indicador -> getNombre();
        $descripcion =  $indicador -> getDescripcion();
        $valor =  $indicador -> getValor();
        $idCategoria =  $indicador -> getCategoria_idCategoria();
        $tipo = 2;
    }
}
if(isset($_POST["enviar"])){
    $nombre = $_POST["nombre"];
    $descripcion = $_POST["descripcion"];
    $valor = $_POST["valor"];
    if($tipo==1){
        $indicador = new Indicador("", $nombre, $descripcion, $valor, $idCategoria);
        if(!$indicador -> existeIndicador()){
            $resultados = $indicador ->verificarValor();
            $suma = $resultados[0]+$valor;
            if($suma<=$resultados[1]){
                $indicador -> registrar();
                $errorIndicador = 1;
            }else{
                $error = $resultados[1]-$resultados[0];
                $errorIndicador = 4 ;
            }
        }else{
            $errorIndicador =2;
        }
    }else{
        if($tipo == 2){
            $indicador = new Indicador($id, $nombre, $descripcion, $valor, $idCategoria);
            $resultados = $indicador ->verificarValorM();
            $suma = $resultados[0]+$valor;
            if($suma<=$resultados[1]){
                $indicador -> actualizar();
                $errorIndicador = 3;
            }else{
                $error = $resultados[1]-$resultados[0];
                $errorIndicador = 4 ;
            }
            
        }
    }
    
}
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-half">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo ($tipo==1)? "Crear Indicador": "Modificar Indicador";  ?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearIndicador.php"). (($tipo==1)? "&crear=true&idCategoria=". $idCategoria."" : "&modificar=true&idIndicador=". $id)?> method="post">
						<?php if($errorIndicador==1){
						    echo '<div class="notification is-success">
                              El indicador <strong>'. $indicador -> getNombre() .'</strong> ha sido agregado con'. utf8_encode("Èxito") .'
                                </div>';
						}else{ if($errorIndicador==3){
						    echo '<div class="notification is-success">
                              El indicador <strong>'. $indicador -> getNombre() .'</strong> ha sido modificado con '. utf8_encode("Èxito") .'
                                </div>';
						}else{
						    if($errorIndicador==4){
						        echo '<div class="notification is-danger">
                              El valor del indicador <strong>'. $indicador -> getNombre() .'</strong> no debe ser mayor a '. $error.'
                                </div>';
						    }
						}
						}?>
						<div class="field" id="cajaNombre">
							<label class="label">Nombre</label>
							<div class="control has-icons-right">
								<input id="nombre" name="nombre" class="input <?php if($errorIndicador==2){ echo "is-danger"; }?>" type="text" required="required" placeholder="Nombre de la categoria" value="<?php echo $nombre; ?>">
							     <span class='icon is-small is-right' id="iconoNombre"> <?php if($errorIndicador==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?> </span>
							</div>
							<div id="mensajeNombre"> <?php if($errorIndicador==2){ echo "<p class='help is-danger'>La categoria ya se encuentra en el sistema</p>"; }?></div>
						</div>

						<div class="field">
							<label class="label"><?php echo utf8_encode("DescripciÛn")?></label>
							<div class="control has-icons-right">
							  <textarea id="descripcion" name="descripcion" class="textarea" required="required" placeholder="<?php echo utf8_encode("DescripciÛn de la categoria")?>"><?php echo $descripcion; ?></textarea>
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
					<div class="field is-grouped">
							<div class="control">
								<button  type="submit" name="enviar" class="button" style="background-color:#7317DA; color:#FFFFFF"><?php echo ($tipo == 1)? "Crear" : "Modificar"; ?></button>
							</div>
							<div class="control">
								<a class="button is-light" style="border: 1px solid"  href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarIndicador.php"). "&idCategoria=". $idCategoria?>" >Atras</a>
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
		 var letras = /^[a-zA-ZÒ—\s\W]+$/;
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