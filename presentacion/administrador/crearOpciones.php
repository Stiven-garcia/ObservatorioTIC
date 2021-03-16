<?php
$errorOpcion = 0;
$descripcion = "";
$valor="";
$tipo=0;
$error=0;
$pregunta= null;
if(isset($_GET["crear"])){
    $pregunta = new Pregunta($_GET["idPregunta"]);
    $pregunta -> consultar();
    $tipo = 1;
}else{
    if(isset($_GET["modificar"])){
        $id = $_GET["idOpcion"];
        $opcion = new Opcion($id);
        $opcion -> consultar();
        $pregunta = new Pregunta($opcion -> getPregunta());
        $pregunta -> consultar();
        $tipo = 2;
        $descripcion = $opcion -> getDescripcion();
        $valor = $opcion -> getValor();
    }
}

if(isset($_POST["enviar"])){
    $descripcion = $_POST["descripcion"];
    $valor = $_POST["valor"];
    if($tipo==1){
        $opcion = new Opcion("", $descripcion, $valor, $pregunta -> getId());
        if(!$opcion -> existeOpcion()){
            $resultados = $opcion ->verificarValor();
            $suma = $resultados[0]+$valor;
            if($suma<=$resultados[1]){
                $opcion -> registrar();
                $errorOpcion = 1;
            }else{
                $error = $resultados[1]-$resultados[0];
                $errorOpcion = 4 ;
            }
        }else{
            $errorOpcion = 2;
        }
    }else{
        if($tipo==2){
            $opcion = new Opcion($id, $descripcion, $valor);
            $resultados = $opcion ->verificarValorM();
            $suma = $resultados[0]+$valor;
            if($suma<=$resultados[1]){
                $opcion -> modificar();
                $errorOpcion = 3;
            }else{
                $error = $resultados[1]-$resultados[0];
                $errorOpcion = 4 ;
            }
        }
    }
    
}
include 'presentacion/home/menu.php';
?>
<div class="columns is-mobile is-centered" style="margin-top: 10px">
  <div class="column is-half">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo (($tipo==1)? "Crear":"Modificar")?> <?php echo utf8_encode("opción")?></p>
			</header>
				<div class="card-content">
					<div class="content">
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearOpciones.php"). (($tipo==1)? "&crear=true&idPregunta=". $pregunta -> getId()."" : "&modificar=true&idOpcion=".$id) ?> method="post">
						<?php if($errorOpcion==1){
						    echo utf8_encode('<div class="notification is-success">
                               La opcion ha sido creda con exito
                                </div>');
						}?>
						<?php if($errorOpcion==3){
						    echo utf8_encode('<div class="notification is-success">
                               La opcion ha sido modificada con exito
                                </div>');
						}?>
						<?php if($errorOpcion==4){
						    echo utf8_encode('<div class="notification is-danger">
                               El valor de la opcion no debe ser mayor a <strong>'. $error .'</strong>
                                </div>');
						}?>
						<div class="field">
							<label class="label"><?php echo utf8_encode("Descripción")?></label>
							<div class="control has-icons-right">
								<textarea id="descripcion" name="descripcion" class="textarea <?php if($errorOpcion==2){ echo "is-danger"; }?>" required="required" placeholder="Ingrese la <?php echo utf8_encode("opción")?>"><?php echo $descripcion; ?></textarea>
							     <span class='icon is-small is-right' id="iconoDescripcion"><?php if($errorOpcion==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?></span>
							</div>
							<div id="mensajeDescripcion"> <?php if($errorOpcion==2){ echo "<p class='help is-danger'>La ". utf8_encode("Opción") ." ya se encuentra en el sistema</p>"; }?></div>
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
								<button  type="submit" name="enviar" class="button" style="background-color:#7317DA; color:#FFFFFF"><?php echo (($tipo==1)? "Crear":"Modificar")?></button>
							</div>
							<div class="control">
								<a class="button is-light" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarOpciones.php"). "&idPregunta=".$pregunta -> getId()?>" >Cancelar</a>
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
