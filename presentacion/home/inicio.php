<?php
    $categoria1 = new Categoria("","","","",1);
    $categorias1 = $categoria1 -> consultarTodos();
    $categoria2 = new Categoria("","","","",2);
    $categorias2 = $categoria2 -> consultarTodos();
    $noticia = new Noticia();
    $noticias = $noticia ->consultarTodos();
    include 'presentacion/home/menu.php';
?>
<!--seccion inicial de la descripcion del portal -->
<section class="section is-medium"
	style="background-image: linear-gradient(to right, rgba(0, 0, 0, 0.32), rgba(0, 0, 0, 0.32)), url('Imagenes/computador.jpg'); background-size: cover;">
	<div style="margin-left: 2.5%">
		<h1 class="subtitle is-3 has-text-white"
			style="margin-top: auto; margin-bottom: -30px">
			<i>Una mirada al futuro</i>
		</h1>
		<h2 class="title is-1" style="color:#7317DA ;margin-bottom: 30px">
			<br> BIENVENIDO
		</h2>
		<p class="subtitle is-5 has-text-white"
			style="width: 60%; line-height: 200%; text-align: justify"> <?php echo utf8_encode("El observatorio tiene la finalidad de medir el uso de las TIC en los profesores y estudiantes
      en la Universidad Distrital Francisco Jos� de Caldas Facultad Tecnol�gica, con el proposito de 
      apoyar a la creaci�n de nuevos proyectos entorno a las TIC y establecer una medida para evaluar
       proyectos ya implementados. Otorgando de tal manera a la universidad ventajas competitivas frente 
       a otras universidades y aportar grandes beneficios al proceso de ense&ntildeanza-aprendizaje de los estudiantes,
        generando profesionales de calidad.");?>
        </p>
	</div>
</section>

<!--Seccion del objetivo  -->
<section class="section"
	style="text-align: center; margin-left: 3%; margin-right: 3%">
	<h1 class="title">Objetivo</h1>
	<hr
		style="height: 3px; background-color: #7317DA; margin-left: 42%; margin-right: 42%"></hr>
	<h2 class="subtitle">
   <?php echo utf8_encode("El objetivo principal de este portal web es observar el uso de las TIC en la Universidad Distrital Francisco Jos� de Caldas Facultad Tecnol�gica");?>
  </h2>
</section>

<!--Seccion de la descripcion del modelo  -->
<section class="section" style="margin-left: 3%; margin-right: 3%">
	<h1 class="title" style="text-align:center "> <?php echo utf8_encode("Modelo De Medici�n De Uso De TIC")?></h1>
	<hr style="height: 3px; background-color: #7317DA; margin-left: 42%; margin-right: 42%"></hr>
	<div class="subtitle has-text-justified ">
	<p>
   <?php echo utf8_encode("Para cumplir con el objetivo del proyecto surg�a la necesidad de buscar un instrumento que permitiera medir el uso de las TIC 
    en la comunidad acad�mica (profesores y estudiantes) de la Universidad Distrital Francisco Jos� de Caldas Facultad Tecnol�gica, por lo que se desarroll�
    un modelo el cual busca recolectar y analizar informaci�n a trav�s de unos lineamientos que tienen como prop�sito determinar el nivel de desarrollo de competencias 
    digitales de la comunidad acad�mica en cuanto al uso y apropiaci�n de las TIC en los procesos de ense�anza y aprendizaje. La construcci�n del modelo a utilizar para medir
     el uso de las TIC en la Universidad Distrital Francisco Jos� de Caldas Facultad Tecnol�gica se  llev� a cabo en tres fases, las cuales son:");?>
  </p>
  <div class="content">
  <ol type="1">
    <li><?php echo utf8_encode("Revisar los objetivos del proyecto, de acuerdo a la problem�tica de este proyecto se busca medir el nivel de uso de las TIC por parte de los estudiantes y profesores en instituciones de educaci�n superior tomando como caso de estudio la Universidad Distrital Francisco Jos� de Caldas Facultad Tecnologica.")?></li>
    <li><?php echo utf8_encode("Revisi�n de la literatura, esta fase tiene el prop�sito de establecer la base conceptual del modelo de uso de TIC por la cual se regir� el instrumento. ")?></li>
    <li><?php echo utf8_encode("Adaptaci�n de un modelo de medici�n de uso TIC y creaci�n de un cuestionario para la recolecci�n de datos, todo esto bajo los criterios de las competencias digitales del siglo XXI, pues estos nos indican cuales son las habilidades que debe poseer un profesional para adaptarse y desenvolverse en este mundo a base de tecnolog�a.")?></li>
  </ol>
    </div>
  <p>
  <?php echo utf8_encode("Al finalizar estas tres fases se obtuvieron los siguientes modelos para ")?> <a href="index.php?pid=<?php echo base64_encode("presentacion/categoria/profesoresCategoria.php")?>&nos=true">profesores</a> y <a  href="index.php?pid=<?php echo base64_encode("presentacion/categoria/estudiantesCategoria.php")?>&nos=true">estudiantes</a> :
  </p>
  </div>
 <p style="text-align:center">
 <img src="Imagenes/Descripcion modelo - Pagina web.png">
 </p>
 
 <div class="columns is-mobile is-multiline is-centered" style="margin-top: 10px">
  <div class="column">
  <p style="margin-top: 10px" class="subtitle is-3 has-text-centered"><strong>Profesores</strong></p>
  <div id="profesores">
  <?php  echo "<script>";
 $json="[";
 foreach ($categorias1 as $c){
     $json .= "[\"". $c -> getNombre() ."\",". ($c -> valorCategoria()*100)/ $c ->getValor()."],";	   
 }
  
 $json .= "]";
                    	
                    	echo "new Chartkick.ColumnChart(\"profesores\", " . $json . ")";
                        echo "</script>";
   ?>	
  </div>
  </div>
  <div class="column">
  <p style="margin-top: 10px" class="subtitle is-3 has-text-centered"><strong>Estudiantes</strong></p>
  <div id="estudiantes">
  <?php  echo "<script>";
 $json="[";
 foreach ($categorias2 as $c){
     $json .= "[\"". $c -> getNombre() ."\",". ($c -> valorCategoria()*100)/ $c ->getValor()."],";	   
 }
  
 $json .= "]";
                    	
                    	echo "new Chartkick.ColumnChart(\"estudiantes\", " . $json . ")";
                        echo "</script>";
   ?>
  </div>
  </div>
  </div>
 
</section>

<!-- Seccion de los autores -->
<section class="section is-small"
	style="text-align: center; margin-left: 3%; margin-right: 3%">
	<h1 class="title">Autores</h1>
	<hr style="height: 3px; background-color: #7317DA; margin-left: 42%; margin-right: 42%"></hr>
	<div class="columns">
	
	<!-- Autor 1 -->
		<div class="column">
			<div class="card">
				<div class="card-image ">
					<figure style="padding-top: 10px">
						<img width="200px" height="200px"
							src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
							style="border: 2px solid grey; margin: 0; padding: 0; border-radius: 800px; overflow: hidden;">
					</figure>
				</div>
				<div class="card-content">
					<div class="media">
						<div class="media-left"></div>
						<div class="media-content">
							<p class="title is-4">Diego Fernando Machado Barrera</p>
							<p class="subtitle is-6">Desarrollador</p>
						</div>
					</div>

					<div class="content">
						<?php echo utf8_encode("Estudiante de Tecnolog�a en tecnolog�a en sistematizaci�n de datos, perteneciente al grupo de investigaci�n Metis de la Universidad Distrital Francisco Jos� de caldas")?>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Autor 2 -->
		<div class="column">
			<div class="card">
				<div class="card-image ">
					<figure style="padding-top: 10px">
						<img width="200px" height="200px"
							src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
							style="border: 2px solid grey; margin: 0; padding: 0; border-radius: 800px; overflow: hidden;">
					</figure>
				</div>
				<div class="card-content">
					<div class="media">
						<div class="media-left"></div>
						<div class="media-content">
							<p class="title is-4">Stiven Alexander Imbacuan Garcia</p>
							<p class="subtitle is-6">Desarrollador</p>
						</div>
					</div>

					<div class="content">
						<?php echo utf8_encode("Estudiante de Tecnolog�a en tecnolog�a en sistematizaci�n de datos, perteneciente al grupo de investigaci�n Metis de la Universidad Distrital Francisco Jos� de caldas")?>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Autor 3 -->
		<div class="column">
			<div class="card">
				<div class="card-image ">
					<figure style="padding-top: 10px">
						<img width="200px" height="200px"
							src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
							style="border: 2px solid grey; margin: 0; padding: 0; border-radius: 800px; overflow: hidden;">
					</figure>
				</div>
				<div class="card-content">
					<div class="media">
						<div class="media-left"></div>
						<div class="media-content">
							<p class="title is-4">Juan Carlos Guevara <?php echo utf8_encode("Bola�os")?></p>
							<p class="subtitle is-6">Scrum Manager</p>
						</div>
					</div>

					<div class="content">
						<?php echo utf8_encode("Docente de Tecnolog�a en tecnolog�a en sistematizaci�n de datos, perteneciente al grupo de investigaci�n Metis de la Universidad Distrital Francisco Jos� de caldas")?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
if($noticias!= null && count($noticias)>=2){ ?>
    <section class="section">
    <div class="container">
				<!-- Start Carousel -->
	<div id="carousel-demo1" class="carousel">
   <?php $i =1;
     foreach ($noticias as $n) { ?>
        <div class="card" style="width: 550px; margin-top:50px">
        <a id="ver<?php $n ->getId()?>" style="color:hsl(0, 0%, 21%)">
        <div class="card-content">
        <div class="media">
        <div class="media-content">
        <p class="title is-4"><?php echo $n -> getNombre()?></p>
        </div>
        </div>
        <div class="content"><?php echo $n -> limitar_cadena($n -> getDescripcion(), 100) ?><br>
         </div></div></a></div>
	   
<?php  $i++;
     } ?>
   </div>
   </div>
   </section>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bulma-carousel@4.0.3/dist/js/bulma-carousel.min.js"></script>
		<script>
		bulmaCarousel.attach('#carousel-demo1', {
			slidesToScroll: 1,
			  slidesToShow: 2,
			  infinite: true,
			  breakpoints:
		      [{
			      changePoint:480,
			      slidesToScroll: 1,
				  slidesToShow: 1,
		      }, {
			      changePoint:640,
			      slidesToScroll: 2,
				  slidesToShow: 2,
		      },{
			      changePoint:768,
			      slidesToScroll: 3,
				  slidesToShow: 3,
		      },]
		});
		</script>
<div class="modal" id="myModalNoticia">
  <div class="modal-background" id="atras1"></div>
  <div class="modal-card">
    <header class="modal-card-head" style="background-color:#7317DA">
      <p class="modal-card-title has-text-white">Detalles De la Noticia o Evento</p>
      <button id="borrar1" class="delete" aria-label="close"></button>
    </header>
    <section class="modal-card-body" >
    <div id="modalContent1">
    
    </div>

    </section>
  </div>
</div>

<!-- Control Modal -->
<script type="text/javascript"> 
$(document).ready(function(){
	 <?php foreach ($noticias as $n) { ?>
		$("#ver<?php echo $n -> getId(); ?>").click(function(e){
			e.preventDefault();
			<?php  echo "var ruta = \"indexAjax.php?pid=" . base64_encode("presentacion/noticia/modalNoticia.php") . "&idNoticia=" . $n -> getId() . "\";\n"; ?>
			$("#modalContent1").load(ruta);
			$("#myModalNoticia").addClass("is-active");
			
		});
		<?php } ?>

		$("#borrar1").click(function(e){
			e.preventDefault();
			$("#myModalNoticia").removeClass("is-active");
			
		});
		$('body').on('click', '#atras1', function(){
			$("#myModalNoticia").removeClass("is-active");
		  })
});
</script>	