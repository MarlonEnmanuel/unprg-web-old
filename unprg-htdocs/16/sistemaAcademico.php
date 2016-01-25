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
		<script src="/unrpg-nueva/frontend/libs/jquery.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>

	<!-- Importación de archivos propios -->
		<link rel="stylesheet" type="text/css" href="/unrpg-nueva/frontend/css/sistemaAcademico.css">

</head>
<body>
	<?php require_once 'includes/header.html'; ?>
	<?php require_once 'includes/nav.html'; ?>
	
	<section class="enlaces">
		<div class="wrap">
			<a class="enlace" href="http://aplicaciones.unprg.edu.pe/ModuloAutenticacion/indice.jsp">
				<p class="nombre">Actas Virtuales</p>
				<img src="frontend/img/enlaces/actasv.jpg" height="150" width="150" alt="Actas Virtuales">
			</a>
			<a class="enlace" href="http://www2.unprg.edu.pe/ocaa/index.php">
				<p class="nombre">OCCA</p>
				<img src="frontend/img/enlaces/occa.JPG" alt="OCCA">
			</a>
		</div>
	</section>

	<?php require_once 'includes/footer.html'; ?>
</body>
</html>