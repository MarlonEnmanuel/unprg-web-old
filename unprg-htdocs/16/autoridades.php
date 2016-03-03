<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>UNPRG | Estatuto</title>
	<meta name="description" content="UNPRG Estatuto">
	<link rel="shortcut icon" href="<?= config::getPath(true,'/frontend/img/favicon.ico') ?>" type="image/x-icon">

	<meta name="viewport" content="width=device-width, user-scalable=no">

	<meta property="og:image"		content="<?= config::getPath(true,'frontend/img/unprg-social.jpg') ?>" />
	<meta property="og:title"   	content="UNPRG | Estatuto" />
	<meta property="og:description"	content="Somos una universidad pública que crea, imparte, difunde conocimientos científicos, tecnológicos y humanísticos; forma científicos y profesionales innovadores, éticos, críticos y competitivos, que participan activamente en el desarrollo integral y sustentable de la sociedad." />
	<meta property="og:url" 		content="http://unprg.edu.pe/" />
	<meta property="og:locale" 		content="es_ES" />
	<meta property="og:site_name" 	content="UNPRG" />

	<!-- Importación de Librerías -->
		<?= config::getScript(config::getPath(false,'/frontend/libs/jquery.js')) ?>
		<?= config::getLink('https://fonts.googleapis.com/css?family=Titillium+Web') ?>

	<!-- Importación de Slider -->
		<?= config::getLink(config::getPath(false,'/frontend/owl-carousel/owl.carousel.css')) ?>
		<?= config::getScript(config::getPath(false,'/frontend/owl-carousel/owl.carousel.min.js')) ?>

	<!-- Importación de archivos propios -->
		<?= config::getLink(config::getPath(false,'/frontend/css/general.css')) ?>
		<?= config::getLink(config::getPath(false,'/frontend/css/autoridades.css')) ?>

		<script type="text/javascript">
			window.unprg = {};
			$(document).ready(function(){
				$("section .autoridades .galeria").owlCarousel({
					autoPlay : 2000,
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
	<?php require_once config::getRequirePath('includes/header.php'); ?>
	<?php require_once config::getRequirePath('includes/nav.php'); ?>
	
	<section>
		<div class="wraper">
			
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
					<p class="persona-nombre">M. Sc. José Lino Huertas Maco</p>
					<p class="persona-cargo">Facultad de Ciencias Económicas, Administrativas y Contables</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. Alfonso Tesén Arroyo</p>
					<p class="persona-cargo">Facultad de Ciencias Físicas y Matemáticas</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. Néstor Tenorio Requejo</p>
					<p class="persona-cargo">Facultad de Ciencias Históricos Sociales y Educación</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Exequiel Baudelio Chávarry Correa</p>
					<p class="persona-cargo">Facultad de Derecho y Ciencias Políticas</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Víctor Cornetero Ayudante</p>
					<p class="persona-cargo">Facultad de Ingeniería Agrícola</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Dr. Jorge Luis Saavedra Díaz</p>
					<p class="persona-cargo">Facultad de la Facultad de Agronomía</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. Walter Morales Uchofen</p>
					<p class="persona-cargo">Facultad de Ingeniería Civil, Sistemas y Arquitectura</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. Juan Antonio Tumialan Hinostroza</p>
					<p class="persona-cargo">Facultad de Ingeniería Mecánica y Eléctrica</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. Juan Carlos Díaz Visitación</p>
					<p class="persona-cargo">Facultad de Ingeniería Química e Industrias Alimentarias</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. Carlos Herbert Pomares Neira</p>
					<p class="persona-cargo">Facultad de Ingeniería Zootecnia</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. José Luis Vílchez Muñoz</p>
					<p class="persona-cargo">Facultad de Medicina Veterinaria</p>
				</div>
				<div class="clean"></div>
				<div class="galeria owl-carousel owl-theme">
					<div class="item"><img src="<?= config::getPath(false,'/frontend/img/autoridades/agricola.jpg') ?>" alt=""></div>
					<div class="item"><img src="<?= config::getPath(false,'/frontend/img/autoridades/facfym.jpg') ?>" alt=""></div>
					<div class="item"><img src="<?= config::getPath(false,'/frontend/img/autoridades/fachse.jpg') ?>" alt=""></div>
					<div class="item"><img src="<?= config::getPath(false,'/frontend/img/autoridades/ficsa.jpg') ?>" alt=""></div>
					<div class="item"><img src="<?= config::getPath(false,'/frontend/img/autoridades/mecanicaElectrica.jpg') ?>" alt=""></div>
					<div class="item"><img src="<?= config::getPath(false,'/frontend/img/autoridades/zootecnia.jpg') ?>" alt=""></div>
				</div>
				<div class="clean"></div>
			</div>

			<div class="autoridades unprg-sec">
				<p class="titulo">Comisión reorganizadora de la Escuela de Postgrado</p>
				<div class="persona">
					<p class="persona-nombre">Dr. Carlos Quiñones Farro</p>
					<p class="persona-cargo">Director General</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. Consuelo Rojas</p>
					<p class="persona-cargo">Director asuntos académicos</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">M. Sc. Juan Granados Inoñán</p>
					<p class="persona-cargo">Asuntos Administrativos</p>
				</div>
				<div class="clean"></div>
			</div>

			<div class="autoridades unprg-sec">
				<p class="titulo">Jefes de Oficinas Generales</p>
				<div class="persona">
					<p class="persona-nombre">Ing. Daniel Carranza Montenegro</p>
					<p class="persona-cargo">Jefe de la Oficina General de Servicios Generales y Gestión Ambiental</p>
				</div>
				<div class="persona">
					<p class="persona-nombre"> Ing. Norman Oswaldo Aguirre Zaquinaula</p>
					<p class="persona-cargo">Jefe de la Oficina General de Admisión</p>
				</div>
				<div class="persona">
					<p class="persona-nombre"> Eco. Sebastián Javier Uriol Chávez</p>
					<p class="persona-cargo">Jefe de la Oficina General de Recursos Humanos</p>
				</div>
				<div class="persona">
					<p class="persona-nombre"> Med. Vet. Oscar Granda Sotero</p>
					<p class="persona-cargo">Jefe de la Oficina General de Bienestar Universitario</p>
				</div>
				<div class="persona">
					<p class="persona-nombre"> Med. Vet. Lumber Gonzáles Zamora</p>
					<p class="persona-cargo">Jefe de la Oficina General de Asuntos Académicos</p>
				</div>
				<div class="persona">
					<p class="persona-nombre"> Enf. Dennie Shirley Rojas Manrique</p>
					<p class="persona-cargo">Jefe de la Oficina General de Responsanilidad Universitaria</p>
				</div>
				<div class="persona">
					<p class="persona-nombre"> Ing. Emilio de la Rosa Rios</p>
					<p class="persona-cargo">Jefe de la Oficina General de Proyectos</p>
				</div>
				<div class="persona">
					<p class="persona-nombre"> Ing. Pilar del Rosario Rios Campos</p>
					<p class="persona-cargo">Jefe de la Oficina General de Biblioteca</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Ing. Luis Alberto  Llontop Cumpa</p>
					<p class="persona-cargo">Jefe de la Oficina General de Sistemas Informáticos Administrativos</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Eco. Luis Anibal Espinoza Polo</p>
					<p class="persona-cargo">Jefe de la Oficina General de Planificación y Presupuesto</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Abg. Luis Gilberto Carrasco Lucero</p>
					<p class="persona-cargo">Jefe de la Oficina General de Asesoría Jurídica</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Lic. Manuel Castañeda Aurazo</p>
					<p class="persona-cargo">Jefe de Imagen Institucional y Relaciones Públicas</p>
				</div>
				<div class="clean"></div>
			</div>
			<div class="autoridades unprg-sec">
				<p class="titulo">Otras Dependencias</p>
				<div class="persona">
					<p class="persona-nombre">Sr. Santos Manfreo Quiróz Nevado</p>
					<p class="persona-cargo">Jefatura de la Oficina de COntrol de Personal</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Lic. Adm. July Alvarado Ventura</p>
					<p class="persona-cargo">Jefatura de Abastecimiento y Control Patrimonial</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Bach. Julie Carolina Valdiviezo Inoñan</p>
					<p class="persona-cargo">Jefatura de la Unidad de Programación</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Bach. Miriam Morante Eneque</p>
					<p class="persona-cargo">Jefatura de la Unidad de Compras</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">C.P.C. Margot Heredia Ramírez</p>
					<p class="persona-cargo">Jefatura de la Unidad de Almacén</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Abg. Segundo Britaldo Balcazar Zelada</p>
					<p class="persona-cargo">Jefatura de la Unidad de Escalafón</p>
				</div>
				<div class="persona">
					<p class="persona-nombre">Sr. Francisco Sandoval Díaz</p>
					<p class="persona-cargo">Jefatura de la Unidad de Margesí de Bienes</p>
				</div>
				<div class="clean"></div>
			</div>
			<div class="autoridades unprg-sec">
				<p class="titulo">Centro Pre Universitario</p>
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
			</div>
		</div>
	</section>

	<?php require_once config::getRequirePath('includes/footer.php'); ?>
</body>
</html>