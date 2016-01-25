<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>UNPRG | Universidad Nacional Pedro Ruiz Gallo</title>
	<meta name="description" content="Somos una universidad pública que crea, imparte, difunde conocimientos científicos, tecnológicos y humanísticos; forma científicos y profesionales innovadores, éticos, críticos y competitivos, que participan activamente en el desarrollo integral y sustentable de la sociedad.">
	<link rel="shortcut icon" href="/unrpg-nueva/frontend/img/favicon.ico" type="image/x-icon">

	<meta name="viewport" content="width=device-width, user-scalable=no">

	<meta property="og:image"		content="http://unprg.edu.pe/unrpg-nueva/frontend/img/unprg-social.jpg" />
	<meta property="og:title"   	content="UNPRG | Universidad Nacional Pedro Ruiz Gallo" />
	<meta property="og:description"	content="Somos una universidad pública que crea, imparte, difunde conocimientos científicos, tecnológicos y humanísticos; forma científicos y profesionales innovadores, éticos, críticos y competitivos, que participan activamente en el desarrollo integral y sustentable de la sociedad." />
	<meta property="og:url" 		content="http://unprg.edu.pe/" />
	<meta property="og:locale" 		content="es_ES" />
	<meta property="og:site_name" 	content="UNPRG" />

	<!-- Importación de Librerías -->
		<script src="/unrpg-nueva/frontend/libs/jquery.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>

	<!-- Importación de Slider -->
		<link rel="stylesheet" href="/unrpg-nueva/frontend/owl-carousel/owl.carousel.css">
		<script src="/unrpg-nueva/frontend/owl-carousel/owl.carousel.min.js"></script>

	<!-- Importación de archivos propios -->
		<link rel="stylesheet" type="text/css" href="unrpg-nueva/frontend/css/home.css">

	<!-- Esto debería ir a un archivo aparte :P -->
		<script type="text/javascript">
			window.unprg = {};
			$(document).ready(function(){
				$(".unprg-cuerpo .autoridades .galeria").owlCarousel({
					autoPlay : 3000,
					navigation : false, // Show next and prev buttons
					slideSpeed : 300,
					paginationSpeed : 400,
					stopOnHover : true,
					items : 4,
					itemsDesktop : [1199,4],
				    itemsDesktopSmall : false,
				    itemsTablet: [768,3],
				    itemsTabletSmall: false,
				    itemsMobile : [479,2]
				});
			});
		</script>
</head>
<body>
	<?php require_once 'unrpg-nueva/includes/header.html'; ?>
	<?php require_once 'unrpg-nueva/includes/nav.html'; ?>
	
	<section class="unprg-portada">
		<div class="wraper">
			
			<div class="portada-col unprg-slider">
				<?php require_once 'unrpg-nueva/includes/slider.html'; ?>
			</div>

			<div class="portada-col unprg-avisos">
				<?php require_once 'unrpg-nueva/includes/avisos.html'; ?>
			</div>

			<div class="clean"></div>

		</div>
	</section>

	<div class="wraper unprg-cuerpo">

		<section class="cuerpo-col unprg-home">

			<div class="autoridades unprg-sec">
				<p class="titulo">Vicerrectores UNPRG</p>
				<div class="persona">
					<p class="persona-nombre">Dr. Bernardo Eliseo Nieto Castellanos</p>
					<p class="persona-cargo">Vicerrector Académico</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Ernesto Edmundo Hashimoto Moncayo</p>
					<p class="persona-cargo">Vicerrector de Investigación</p>
				</div>
				<div class="clean"></div>
			</div>

			<div class="autoridades unprg-sec">
				<p class="titulo">Decanos UNPRG</p>
				<div class="persona">
					<p class="persona-nombre">Dra. Adela Chambergo Llontop</p>
					<p class="persona-cargo">Facultad de Ciencias Biológicas</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Msc. José Lino Huertas Maco</p>
					<p class="persona-cargo">Facultad de Ciencias Económicas, Administrativas y Contables</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Alfonso Tesén Arroyo</p>
					<p class="persona-cargo">Facultad de Ciencias Físicas y Matemáticas</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Néstor Tenorio Requejo</p>
					<p class="persona-cargo">Facultad de Ciencias Históricos Sociales y Educación</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Ezequiel Chávarry Correa</p>
					<p class="persona-cargo">Facultad de Derecho y Ciencias Políticas</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Víctor Cornetero Ayudante</p>
					<p class="persona-cargo">Facultad de Ingeniería Agrícola</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Jorge Luis Saavedra Díaz</p>
					<p class="persona-cargo">Facultad de Ingeniería Agrónoma</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Walter Morales Uchofen</p>
					<p class="persona-cargo">Facultad de Ingeniería Civil, Sistemas y Arquitectura</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Msc. Juan Antonio Tumialan Hinostroza</p>
					<p class="persona-cargo">Facultad de Ingeniería Mecánica y Eléctrica</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Juan Carlos Díaz Visitación</p>
					<p class="persona-cargo">Facultad de Ingeniería Química e Industrias Alimentarias</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Msc. Carlos Herbert Pomares Neira</p>
					<p class="persona-cargo">Facultad de Ingeniería Zootecnia</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Mg. José Luis Vílchez Muñoz</p>
					<p class="persona-cargo">Facultad de Medicina Veterinaria</p>
				</div>
				<div class="clean"></div>
				<div class="galeria owl-carousel owl-theme">
					<div class="item"><img src="unrpg-nueva/frontend/img/autoridades/Agrícola.jpg" alt=""></div>
					<div class="item"><img src="unrpg-nueva/frontend/img/autoridades/FacFym.jpg" alt=""></div>
					<div class="item"><img src="unrpg-nueva/frontend/img/autoridades/FACHSE.jpg" alt=""></div>
					<div class="item"><img src="unrpg-nueva/frontend/img/autoridades/FICSA.jpg" alt=""></div>
					<div class="item"><img src="unrpg-nueva/frontend/img/autoridades/IngMecanica Electrica.jpg" alt=""></div>
					<div class="item"><img src="unrpg-nueva/frontend/img/autoridades/Zootecnia.jpg" alt=""></div>
					<div class="item"><img src="unrpg-nueva/frontend/img/autoridades/Agrícola.jpg" alt=""></div>
				</div>
				<div class="clean"></div>
			</div>

			<div class="autoridades unprg-sec">
				<p class="titulo">Comisión reorganizadora de la Escuela de Postgrado</p>
				<div class="persona">
					<p class="persona-nombre">Dr. Carlos Quiñonez Farro</p>
					<p class="persona-cargo">Director General</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dra. Consuelo Rojas</p>
					<p class="persona-cargo">Director asuntos académicos</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Juan Granados Inoñán</p>
					<p class="persona-cargo">Asuntos Administrativos</p>
				</div>
				<div class="clean"></div>
			</div>

			<div class="autoridades unprg-sec">
				<p class="titulo">Comisión reorganizadora de la Escuela de Postgrado</p>
				<div class="persona">
					<p class="persona-nombre">Dr. Carlos Quiñonez Farro</p>
					<p class="persona-cargo">Director General</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dra. Consuelo Rojas</p>
					<p class="persona-cargo">Director asuntos académicos</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Juan Granados Inoñán</p>
					<p class="persona-cargo">Asuntos Administrativos</p>
				</div>
				<div class="clean"></div>
			</div>

			<div class="autoridades unprg-sec">
				<p class="titulo">Funcionarios de la nueva gestión</p>
				<div class="persona">
					<p class="persona-nombre">Dr. Saúl Espinoza</p>
					<p class="persona-cargo">Director General de Administración</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Mg. José Reupo Periche</p>
					<p class="persona-cargo">Director General del Centro Pre Universitario</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Mg. Carlos Abramonte Atto</p>
					<p class="persona-cargo">Director Académico del Centro Pre Universitario</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Lic. Rolando Córdova Descalzi</p>
					<p class="persona-cargo">Director Administrativo del Centro Pre Universitario</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Lic. Manuel Castañeda Aurazo</p>
					<p class="persona-cargo">Jefe de Imagen Institucional</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Javier Uriol</p>
					<p class="persona-cargo">Jefe de la Oficina General de Recursos Humanos Humanos</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Mg. Luis Alberto  Llontop Cumpa</p>
					<p class="persona-cargo">Jefe de la Oficina General de Sistemas Informáticos Administrativos y Académicos</p>
				</div>
				<div class="clean"></div>
			</div>

		</section>

		<aside class="cuerpo-col unprg-panel">
			<div class="panel-elem">
				<p class="titulo">Sistema Académico</p>
				<a href="unrpg-nueva/sistemaAcademico.php"><img src="unrpg-nueva/frontend/img/enlaces/sistemaaca.jpeg" alt="Sistema Académico"></a>
				<div class="clean"></div>
			</div>
			<div class="panel-elem">
				<p class="titulo">Centro PRE</p>
				<a target="_blank" href="http://cpu.unprg.edu.pe/cpu/index.php"><img src="unrpg-nueva/frontend/img/enlaces/centropre.jpg" alt="Centro Pre"></a>
				<div class="clean"></div>
			</div>
			<div class="panel-elem">
				<p class="titulo">Videos</p>
				<iframe src="https://www.youtube.com/embed/lWDl8S7nrv8" frameborder="0" allowfullscreen></iframe>
				<div class="clean"></div>
			</div>
		</aside>

		<div class="clean"></div>

	</div>	

	<div class="construccion">
		<div class="wraper">
			<p>Página en Construcción</p>
		</div>
	</div>

	<?php require_once 'unrpg-nueva/includes/footer.html'; ?>
</body>
</html>