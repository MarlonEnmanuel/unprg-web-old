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
	<?php require_once '../includes/header.html'; ?>
	<?php require_once '../includes/nav.html'; ?>
	
	<section>
		<div class="wraper">
			<div class="contacto">
				<p class="titulo">Haznos llegar tus aportes, dudas o comentarios</p>
				<form action="">
					<div>
						<span>Tu nombre</span><input type="text" name="nombre" value="">
					</div>
					<div>
						<span>Tu correo</span><input type="text" name="email" value="">
					</div>
					<div>
						<textarea name="texto" value=""></textarea>
					</div>
					<div style="text-align: right">
						<i class="mensaje"></i>
						<input type="submit" value="Enviar">
					</div>
				</form>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		$(document).ready(function(){
			setTimeout(function(){
				$('html body').animate({
					scrollTop : $('nav').offset().top
				});
			},1200);
		});
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