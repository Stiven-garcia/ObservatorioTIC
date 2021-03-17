<?php
$errorCorreo = 0;
$nombre = "";
$apellido = "";
$correo = "";
$clave = "";
$rol = "";

if(isset($_POST["registrar"])){
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $clave = $_POST["clave"];
    $rol = $_POST["rol"];
    $hash = md5( rand(0,1000) ); 
    $usuario = new Usuario("", $nombre, $apellido, $correo, $clave, $rol, $hash);
    if(!$usuario -> existeCorreo()){
        $usuario->registrar();
        // ------------CORREO A ENVIAR---------------------------------
        $to = $correo; // Send email to our user
        $subject = 'Observatorio TIC UDFJCT | Verificación'; // Give the email a subject
        $message = '
            
Gracias por registrarte!
Su cuenta ha sido creada, puede iniciar sesión con las siguientes credenciales después de
haber activado su cuenta presionando la URL a continuación.
            
Haga clic en este enlace para activar su cuenta:
http://observatoriotic.grupometis.org/index.php?pid=' . base64_encode("presentacion/home/iniciarSesion.php") . '&nos=true&correo=' . $correo . '&hash=' . $hash;

        $headers = 'From: observatoriotic.grupometis.org' . "\r\n"; // Set from headers
        mail($to, $subject, $message, $headers);
        $errorCorreo = 1;
 //--------------------------------------------------------------
    }else{
        $errorCorreo = 2;
    }
}
include 'presentacion/home/menu.php';
?>
<div class="columns is-centered" style="margin-top: 10px">
  <div class="column is-half">
		<div class="card">
			<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px ">Registro</p>
			</header>
				<div class="card-content">
					<div class="content">
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/home/registro.php")."&nos=true" ?> method="post">
						<?php if($errorCorreo==1){
						    echo utf8_encode('<div class="notification is-success">
                               Su cuenta se ha creado, <br /> verifíquela haciendo clic en el enlace de activación que se ha enviado a su correo electrónico.
                                </div>');
						}?>
						<div class="field" id="cajaNombre">
							<label class="label">Nombres</label>
							<div class="control has-icons-right">
								<input id="nombre" name="nombre" class="input" type="text" required="required" placeholder="Ingrese su nombre" value="<?php echo $nombre; ?>">
							     <span class='icon is-small is-right' id="iconoNombre"></span>
							</div>
							<div id="mensajeNombre"></div>
						</div>

						<div class="field">
							<label class="label">Apellidos</label>
							<div class="control has-icons-right">
								<input id="apellido" name="apellido" class="input" type="text" required="required" placeholder="Ingrese su Apellido" value="<?php echo $apellido; ?>"> 
							    <span class='icon is-small is-right' id="iconoApellido"></span>
							</div>
							<div id="mensajeApellido"></div>
						</div>

						<div class="field">
							<label class="label">Correo Institucional</label>
							<div class="control has-icons-left has-icons-right">
								<input id="correo" name="correo" class="input <?php if($errorCorreo==2){ echo "is-danger";}?>" type="email" required="required" placeholder="ejemplo@correo.udistrital.edu.co" value="<?php echo $correo; ?>">
								 <span class="icon is-small is-left"> <i class="fas fa-envelope"></i></span> 
								  <span class='icon is-small is-right' id="iconoCorreo"></span>
							</div>
							<div id="mensajeCorreo">
							<?php if($errorCorreo==2){ 
							    echo "<p class='help is-danger'>Este Correo Ya Existe</p>"; 
							}?>
							</div>
						</div>
					<div class="field">
						<label class="label"><?php echo utf8_encode("Contraseña")?></label>
						<div class="control has-icons-left has-icons-right">
							<input id="clave" name="clave" class="input" required="required" type="password" value="<?php echo $clave; ?>"
								placeholder="<?php echo utf8_encode("Ingrese su contraseña")?>"> 
								<span class="icon is-small is-left"> <i class="fas fa-lock"></i></span>
						</div>
						<div id="mensajeClave"></div>
					</div>
					
					<div class="field">
						<label class="label"><?php echo utf8_encode("Ingrese de nuevo su contraseña")?></label>
					<div class="control has-icons-left has-icons-right">
							<input id="claveDeNuevo"class="input" required="required" type="password"
								placeholder="<?php echo utf8_encode("Repita su contraseña")?>"> 
								<span class="icon is-small is-left"> <i class="fas fa-lock"></i></span>
						</div>
						<div id="mensajeClaveDeNuevo"></div>
					</div>
					
					<div class="field">
						<label class="label">Tipo De Usuario</label>
						<div class="control">
							<div class="select">
								<select name="rol" required>
									<option value="" >Seleccionar</option>
									<option value="1" >Profesor</option>
									<option value="2" >Estudiante</option>
								</select>
							</div>
						</div>
					</div>
					<div class="field is-grouped">
							<div class="control">
								<button  type="submit" name="registrar" class="button" style="background-color:#7317DA; color:#FFFFFF">Registrarse</button>
							</div>
							<div class="control">
								<a class="button is-light" href="index.php?pid=<?php echo base64_encode("presentacion/home/inicio.php")?>&nos=true" >Cancelar</a>
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
	<!-- Validar Apellidos  -->
	$("#apellido").blur(function (){
		 var letras = /^[a-zA-Z ]+$/;
			if(!letras.test($("#apellido").val())){
				$("#apellido").removeClass();
				$("#apellido").addClass("input is-danger");
				$("#iconoApellido").empty();
			    $("#iconoApellido").append("<i class='fas fa-exclamation-triangle'></i>");
			    $("#mensajeApellido").empty();
			    $("#mensajeApellido").append("<p class='help is-danger'>Digite un apellido correcto</p>");
			}else{
				$("#apellido").removeClass();
               $("#apellido").addClass("input is-success");
               $("#iconoApellido").empty();
               $("#iconoApellido").append("<i class='fas fa-check'></i>");
               $("#mensajeApellido").empty();
			}
			
	  });
	$("#correo").blur(function (){
		 var correoP = /[A-Za-z]@udistrital.edu.co/;
		 var correoE = /[A-Za-z]@correo.udistrital.edu.co/;
		 var usuario = /[A-Za-z]+@[a-z]+\.[a-z]+/;
			if((!correoP.test($("#correo").val()) && !correoE.test($("#correo").val()))){
					$("#correo").removeClass();
					$("#correo").addClass("input is-danger");
					$("#iconoCorreo").empty();
				    $("#iconoCorreo").append("<i class='fas fa-exclamation-triangle'></i>");
				    $("#mensajeCorreo").empty();
				    $("#mensajeCorreo").append("<p class='help is-danger'>Digite su correo institucional</p>");
			}else{
				$("#correo").removeClass();
              $("#correo").addClass("input is-success");
              $("#iconoCorreo").empty();
              $("#iconoCorreo").append("<i class='fas fa-check'></i>");
              $("#mensajeCorreo").empty();
			}
			
	  });
	$("#clave").blur(function (){
		 var clave = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{6,15}$/;
		 
			if(!clave.test($("#clave").val())){
				$("#clave").removeClass();
				$("#clave").addClass("input is-danger");
			    $("#mensajeClave").empty();
			    $("#mensajeClave").append("<p class='help is-danger'>La clave debe contener al menos una letra mayuscula, una minuscula, un digito y tener entre 6 a 15 caracteres</p>");
			}else{
				$("#clave").removeClass();
             $("#clave").addClass("input is-success");
             $("#iconoClave").empty();
             $("#iconoClave").append("<i class='fas fa-check'></i>");
             $("#mensajeClave").empty();
			}
			
	  });
	$("#claveDeNuevo").blur(function (){
		 var clave = $("#clave").val();
		 
			if($("#claveDeNuevo").val()!=clave){
				$("#claveDeNuevo").removeClass();
				$("#claveDeNuevo").addClass("input is-danger");
			    $("#mensajeClaveDeNuevo").empty();
			    $("#mensajeClaveDeNuevo").append("<p class='help is-danger'>La clave no coincide</p>");
			}else{
				$("#claveDeNuevo").removeClass();
            $("#claveDeNuevo").addClass("input is-success");
            $("#mensajeClaveDeNuevo").empty();
			}
			
	  });
});
</script>
