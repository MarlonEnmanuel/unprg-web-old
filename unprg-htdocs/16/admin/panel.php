<?php
	require_once '../backend/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>UNPRG | Administración</title>
	<meta name="description" content="UNPRG Sistema de Administración Web">
	<link rel="shortcut icon" href="<?= config::getPath(true,'/frontend/img/favicon.ico') ?>" type="image/x-icon">

	<meta name="viewport" content="width=device-width, user-scalable=no">

	<meta property="og:image"		content="<?= config::getPath(true,'frontend/img/unprg-social.jpg') ?>" />
	<meta property="og:title"   	content="UNPRG | Administración" />
	<meta property="og:description"	content="UNPRG Sistema de Administración Web" />
	<meta property="og:url" 		content="http://unprg.edu.pe/" />
	<meta property="og:locale" 		content="es_ES" />
	<meta property="og:site_name" 	content="UNPRG" />

	<!-- Importación de Librerías -->
		<?= config::getScript(config::getPath(false,'/frontend/libs/jquery.js')) ?>
		<?= config::getLink('https://fonts.googleapis.com/css?family=Titillium+Web') ?>

	<!-- Importación de archivos propios -->
		<?= config::getLink(config::getPath(false,'/frontend/css/general.css')) ?>
		<?= config::getLink(config::getPath(false,'/frontend/css/admin/login.css')) ?>

</head>
<body>
	<?php require_once '../includes/header.html'; ?>
	<?php require_once '../includes/nav.html'; ?>
	
	<section>
		<div class="wraper">
			<h1 class="titulo">Panel de Administración de ejemplo<br><b>UNPRG</b></h1>
			<form>
				<input type="email" name="email" value="" placeholder="Correo">
				<input type="password" name="pass" value="" placeholder="Contraseña">
				<input type="submit" value="Entrar" class="boton-amarillo">
			</form>
			<h2>Información</h2>
		</div>
	</section>

	<script type="text/javascript">
		$('section form').submit(function(event) {
			event.preventDefault();

			var form = {
				nombre : $('section form input[name=nombre]').val().trim().replace(/\s+/g, '_'),
				email : $('section form input[name=email]').val().trim().replace(/\s+/g, '_'),
				texto : $('section form textarea').val().replace(/\s+/g, '_')
			};

			if(!form.nombre || !form.email || !form.texto){
				$('section form .mensaje').text('Llene los campos');
				return false;
			}

			$('section form input[type=submit]').attr('disabled','disabled').val('Enviando ...');

			$.ajax({
				url: "<?= config::getPath(false,'/backend/documentos/nuevoMensaje.php') ?>",
				type: 'post',
				dataType: 'json',
				data: form,
			})
			.done(function(data) {
				$('section form .mensaje').text(data.mensaje);
				if(data.estado){
					$('section form input[type=submit]').val('Enviado');
				}else{
					$('section form input[type=submit]').removeAttr('disabled').val('Enviar');
				}
			})
			.fail(function(data) {
				$('section form input[type=submit]').removeAttr('disabled').val('Enviar');
				console.log(data);
			});
		});
	</script>

	<?php require_once '../includes/footer.html'; ?>
</body>
</html>