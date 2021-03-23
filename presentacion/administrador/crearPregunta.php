<?php
$errorPregunta = 0;
$pregunta = "";
$variable = "";
$valor="";
$tipo=0;
$error=0;
$encuesta= null;
if(isset($_GET["crear"])){
    $encuesta = new Encuesta($_GET["idEncuesta"]);
    $encuesta -> consultar();
    $tipo = 1;
}else{
    if(isset($_GET["modificar"])){
        $id = $_GET["idPregunta"];
        $preguntaE = new Pregunta($id);
        $preguntaE -> consultar();
        $encuesta = new Encuesta($preguntaE -> getEncuesta());
        $encuesta -> consultar();
        $tipo = 2;
        $pregunta = $preguntaE -> getPregunta();
        $variable = $preguntaE -> getVariable();
        $valor = $preguntaE -> getValor();
    }
}
$categoria = new Categoria("", "", "", "", $encuesta -> getRol());
$categorias = $categoria -> consultarTodos();
if(isset($_POST["enviar"])){
    $pregunta = $_POST["pregunta"];
    $valor = $_POST["valor"];
    if($tipo==1){
        $variable = $_POST["variable"];
        $preguntaE = new Pregunta("", $pregunta, $variable, $encuesta -> getId(), $valor);
        if(!$preguntaE -> existePregunta()){
            $resultados = $preguntaE ->verificarValor();
            $suma = $resultados[0]+$valor;
            if($suma<=$resultados[1]){
                $preguntaE -> registrar();
                $errorPregunta = 1;
            }else{
                $error = $resultados[1]-$resultados[0];
                $errorPregunta = 4 ;
            }
        }else{
            $errorPregunta = 2;
        }
    }else{
        if($tipo==2){
            $preguntaE = new Pregunta($id, $pregunta,"", "", $valor);
            $resultados = $preguntaE ->verificarValorM();
            $suma = $resultados[0]+$valor;
            if($suma<=$resultados[1]){
                $preguntaE -> modificar();
                $errorPregunta = 3;
            }else{
                $error = $resultados[1]-$resultados[0];
                $errorPregunta = 4 ;
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
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/administrador/crearPregunta.php"). (($tipo==1)? "&crear=true&idEncuesta=". $encuesta -> getId()."" : "&modificar=true&idPregunta=".$id) ?> method="post">
						<?php if($errorPregunta==1){
						    echo utf8_encode('<div class="notification is-success">
                               La pregunta ha sido creda con exito
                                </div>');
						}?>
						<?php if($errorPregunta==3){
						    echo utf8_encode('<div class="notification is-success">
                               La pregunta ha sido modificada con exito
                                </div>');
						}?>
						<?php if($errorPregunta==4){
						    echo utf8_encode('<div class="notification is-danger">
                               El valor de la pregunta no debe ser mayor a <strong>'. $error .'</strong>
                                </div>');
						}?>
						<div class="field">
							<label class="label">Pregunta</label>
							<div class="control has-icons-right">
								<textarea id="pregunta" name="pregunta" class="textarea <?php if($errorPregunta==2){ echo "is-danger"; }?>" required="required" placeholder="Ingrese la pregunta"><?php echo $pregunta; ?></textarea>
							     <span class='icon is-small is-right' id="iconoPregunta"><?php if($errorPregunta==2){ echo "<i class='fas fa-exclamation-triangle'></i>"; }?></span>
							</div>
							<div id="mensajePregunta"> <?php if($errorPregunta==2){ echo "<p class='help is-danger'>La ". utf8_encode("Pregunta") ." ya se encuentra en la encuesta</p>"; }?></div>
						</div>
						
                    <?php if($tipo ==1){?>
						<div class="field">
							<label class="label">Categoria</label>
							<div class="control">
								<div class="select">
									<select id="categoria" name="categoria" required>
										<option value="">Seleccionar</option>
									<?php foreach ($categorias as $c){
									    echo '<option value="'.$c -> getId().'" >'. $c -> getNombre().'</option>';
									}?>
								</select>
								</div>
							</div>
						</div>

						<div class="field">
							<label class="label">Indicador</label>
							<div class="control">
								<div class="select">
									<select id="indicador" name="indicador" required>
										<option value="">Seleccionar</option>
									</select>
								</div>
							</div>
						</div>
						<div class="field">
							<label class="label">Variable</label>
							<div class="control">
								<div class="select">
									<select id="variable" name="variable" required>
										<option value="">Seleccionar</option>
			                        </select>
								</div>
							</div>
						</div>
						<?php }?>
					
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
								<a class="button is-light" href="index.php?pid=<?php echo base64_encode("presentacion/administrador/crearEncuesta.php"). "&modificar=true&idEncuesta=".$encuesta -> getId()?>" >Cancelar</a>
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
	$("#categoria").change(function (){
			var id= $("#categoria").val(); 
			if(id!=""){
				var ruta = "indexAjax.php?pid=<?php echo base64_encode("presentacion/indicador/seleccionIndicadorAjax.php") ?>&idCategoria="+id;
				$("#indicador").load(ruta);
			} else{
				$("#indicador").empty();
			}
	});
	$("#indicador").change(function (){
		var id= $("#indicador").val(); 
		if(id!=""){
			
			var ruta = "indexAjax.php?pid=<?php echo base64_encode("presentacion/variable/seleccionVariableAjax.php") ?>&idIndicador="+id;
			$("#variable").load(ruta);
		} else{
			$("#variable").empty();
		}
    });
	
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
