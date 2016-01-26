<?php
	require_once 'backend/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>UNPRG | Sistema Académico</title>
	<meta name="description" content="UNPRG Sistema Académico">
	<link rel="shortcut icon" href="/unrpg-nueva/frontend/img/favicon.ico" type="image/x-icon">

	<meta name="viewport" content="width=device-width, user-scalable=no">

	<meta property="og:image"		content="http://unprg.edu.pe/unrpg-nueva/frontend/img/unprg-social.jpg" />
	<meta property="og:title"   	content="UNPRG | Sistema Académico" />
	<meta property="og:description"	content="UNPRG Sistema Académico" />
	<meta property="og:url" 		content="http://unprg.local/unrpg-nueva/sistemaAcademico.php" />
	<meta property="og:locale" 		content="es_ES" />
	<meta property="og:site_name" 	content="UNPRG" />

	<!-- Importación de Librerías -->
		<?= config::getScript(config::getPath(false,'/frontend/libs/jquery.js')) ?>
		<?= config::getLink('https://fonts.googleapis.com/css?family=Titillium+Web') ?>

	<!-- Importación de archivos propios -->
		<?= config::getLink(config::getPath(false,'/frontend/css/sistemaAcademico.css')) ?>
</head>
<body>
	<?php require_once 'includes/header.html'; ?>
	<?php require_once 'includes/nav.html'; ?>
	
	<section class="enlaces">
		<div class="wrap">
			<h1>Estatuto UNPRG</h1>
			<embed class="pdf" src="frontend/estatuto.pdf" type='application/pdf' style="width: 80%; height: 500px;">
		</div>
	</section>

	<?php require_once 'includes/footer.html'; ?>
</body>
</html>