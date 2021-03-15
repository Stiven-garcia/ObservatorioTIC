<?php
include 'presentacion/home/menu.php';
$error=0;
if(isset($_GET["correo"])){
    $correo = $_GET["correo"];
    $hash = $_GET["hash"];
    $usuario= new Usuario("","","",$correo,"","","");
    $usuario -> verificarCorreo();
    if($hash == $usuario -> getHash()){
    $usuario -> actualizarEstado();
    $error=1;
    }
}
if(isset($_GET["error"])){
    $error=$_GET["error"];
}
?>
<div class="columns is-mobile is-centered" style="margin-top: 20px; margin-bottom: 20px">
	<div class="column is-half  is-one-third">
		<div class="card">
		<header class="card-header" style="background-color:#7317DA">
				<p class="card-header-title has-text-white is-centered"  style="font-size:20px "><?php echo utf8_encode("Iniciar Sesión")?></p>
			</header>
			<div class="card-content">
				<div class="content">
				    <?php if($error==1){
						    echo utf8_encode('<div class="notification is-success">
                               Su cuenta se ha activado correctamente
                                </div>');
				    }else{
				        if($error==2){
				            echo utf8_encode('<div class="notification is-danger">
				            Correo o clave incorrectas <br/>
                            Intente nuevamente
                                 </div>');
				        }
				    }?>
					<form action=<?php echo "index.php?pid=" . base64_encode("presentacion/home/autenticar.php")."&nos=true" ?> method="post">
					<div class="field">
					<label class="label">Correo Institucional</label>
						<p class="control has-icons-left has-icons-right">
							<input name="correo" class="input" type="email" placeholder="ejemplo@correo.udistrital.edu.co"> <span
								class="icon is-small is-left"> <i class="fas fa-envelope"></i>
							</span> 
						</p>
					</div>
					<div class="field">
					<label class="label"><?php echo utf8_encode("Contraseña")?></label>
						<p class="control has-icons-left">
							<input name="clave" class="input" type="password" placeholder="<?php echo utf8_encode("Ingrese su contraseña")?>"> <span
								class="icon is-small is-left"> <i class="fas fa-lock"></i>
							</span>
						</p>
					</div>
					<div class="field is-grouped" style="margin-top: 20px">
							<div class="control">
								<button type="submit" class="button" style="background-color:#7317DA; color:#FFFFFF"><?php echo utf8_encode("Iniciar Sesión")?></button>
							</div>
							<div class="control">
								<a class="button is-light" href="index.php?pid=<?php echo base64_encode("presentacion/home/inicio.php")?>&nos=true">Cancelar</a>
							</div>
					</div>
				</form>
				</div>
			</div>
		</div>
	</div>
</div>