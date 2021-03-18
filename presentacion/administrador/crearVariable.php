<?php
$errorVariable = 0;
$nombre = "";
$valor="";
$tipo=0;
$error=0;
$indicador= null;
if(isset($_GET["crear"])){
    $indicador = new Indicador($_GET["idIndicador"]);
    $indicador -> consultar();
    $tipo = 1;
}else{
    if(isset($_GET["modificar"])){
        $id = $_GET["idVariable"];
        $variableE = new Variable($id);
        $variableE -> consultar();
        $indicador = new Indicador($variableE -> getIndicador());
        $indicador -> consultar();
        $tipo = 2;
        $nombre = $variableE -> getNombre();
        $valor = $variableE -> getValor();
    }
}
if(isset($_POST["enviar"])){
    $nombre = $_POST["nombre"];
    $valor = $_POST["valor"];
    if($tipo==1){
        $variableE = new Variable("", $nombre, $valor,  $indicador -> getIdIndicador() );
        if(!$variableE -> existeVariable()){
            $resultados = $variableE ->verificarValor();
            $suma = $resultados[0]+$valor;
            if($suma<=$resultados[1]){
                $variableE -> registrar();
                $errorVariable = 1;
            }else{
                $error = $resultados[1]-$resultados[0];
                $errorVariable = 4 ;
            }
        }else{
            $errorVariable = 2;
        }
    }else{
        if($tipo==2){
            $variableE = new Variable($id, $nombre,"", $valor);
            $resultados = $variableE ->verificarValorM();
            $suma = $resultados[0]+$valor;
            if($suma<=$resultados[1]){
                $variableE -> actualizar();
                $errorVariable = 3;
            }else{
                $error = $resultados[1]-$resultados[0];
                $errorVariable = 4 ;
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
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo (($tipo==1)? "Crear":"Modificar")?> Pregunta</p>
			</header>
				<div class="card-content">
					<div class="content">
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearVariable.php"). (($tipo==1)? "&crear=true&idIndicador=". $indicador -> getIdIndicador()."" : "&modificar=true&idVariable=".$id) ?> method="post">
						<?php if($errorVariable==1){
						    echo utf8_encode('<div class="notification is-success">
                               La variable ha sido creda con exito
                                </div>');
						}?>
						<?php if($errorVariable==3){
						    echo utf8_encode('<div class="notification is-success">
                               La variable ha sido modificada con exito
                                </div>');
						}?>
						<?php if($errorVariable==4){
						    echo utf8_encode('<div class="notification is-danger">
                               El valor de la variable no debe ser mayor a <strong>'. $error .'</strong>
                                </div>');
						}?>
						<div class="field">
							<label class="label">Variable</label>
							<div class="control has-icons-right">
								<textarea id="nombre" name="nombre" class="textarea <?php if($errorVariable==2){ echo "is-danger"; }?>" required="required" placeholder="Ingrese la variable"><?php echo $nombre; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"><?php if($errorVariable==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?></span>
							</div>
							<div id="mensajePregunta"> <?php if($errorVariable==2){ echo "<p class='help is-danger'>La ". utf8_encode("Pregunta") ." ya se encuentra en el sistema</p>"; }?></div>
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
								<a class="button is-light" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/consultarVariables.php"). "&idIndicador=".$indicador -> getIdIndicador()?>" >Cancelar</a>
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

