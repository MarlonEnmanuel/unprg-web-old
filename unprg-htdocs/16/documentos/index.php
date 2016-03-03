<?php
	require_once '../backend/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>UNPRG | Introducción</title>
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

	<!-- Importación de archivos propios -->
		<?= config::getLink(config::getPath(false,'/frontend/css/general.css')) ?>
		<?= config::getLink(config::getPath(false,'/frontend/css/documentosIntro.css')) ?>

</head>
<body>
	<?php require_once '../includes/header.php'; ?>
	<?php require_once '../includes/nav.php'; ?>
	
	<section>
		<div class="wraper">
			<div class="comunicado">
				<h1>Vicerrectorado de Investigación</h1>
				<p>
					El Vicerrectorado de Investigación, en su proceso de implementación, pone a su disposición los siguientes documentos:
				</p>
				<ol>
					<li>
						<a target="_blank" href="Plan-de-Investigacion-UNPRG.pdf">El Plan de Investigación UNPRG</a>
					</li>
					<li>
						<a target="_blank" href="Reglamento-para-la-Form-y-Sust-de-Trab-de-Invest.pdf">Reglamento para la Formulación y Sustentación de Trabajos de Investigación Multi o Inter Disciplinario a nivel de Pre y Post Grado en la UNPRG</a>
					</li>
					<li>
						<a target="_blank" href="Reglamento-para-la-Carrera-Docente.pdf">Reglamento para la Carrera del Docente.</a>
					</li>
					<li>
						<a target="_blank" href="Manual-de-Organizacion-y-Funciones.pdf">Manual de Organización y Funciones.</a>
					</li>
				</ol>
				<p>
					Esperando que la comunidad universitaria revise los documentos y nos haga llegar sus aportes para el enriquecimiento y mejorar la propuesta de la calidad académica de la Universidad Nacional Pedro Ruiz Gallo.
				</p>
				<div class="firma">
					<div>
						<p>Dr. Ernesto Hashimoto Moncayo</p>
						<p>Vicerrector de Investigación</p>
					</div>
				</div>
			</div>
			<div class="contacto">
				<p class="titulo">Haznos llegar tus aportes, dudas o comentarios al siguiente correo</p>
				<p class="titulo">vice_investigacion@unprg.edu.pe</p>
			</div>
		</div>
	</section>

	<?php require_once '../includes/footer.php'; ?>
</body>
</html>