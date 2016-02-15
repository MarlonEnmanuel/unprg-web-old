<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
	require_once config::getRequirePath('backend/controllers/Controller.php');

	$ctrl = new Controller();
	$ctrl->checkAccess('aviso');
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
		<?= config::getLink(config::getPath(false,'/frontend/css/admin/general.css')) ?>

</head>
<body>
	<?php require_once config::getRequirePath('includes/header.html'); ?>
	<?php require_once config::getRequirePath('includes/nav.html'); ?>
	
	<section>
		<div class="wraper">

			<div class="admin-col admin-nav">
				<?php require_once config::getRequirePath('includes/navAdmin.php'); ?>
			</div>

			<div class="admin-col admin-cuerpo">
				<div class="encabezado">Nuevo aviso</div>

				<form class="formAviso">
					<div>
						<span>Tipo de aviso</span>
						<select name="ar-type">
							<option value="img">Publicar Imagen</option>
							<option value="doc">Publicar Documento PDF</option>
							<option value="link">Enlace a otra página</option>
						</select>
					</div>
					<div>
						<span>Descripción del aviso</span>
						<input type="text" name="av-texto" maxlength="45">
					</div>
					<div>
						<span>Visible en página principal</span>
						<input type="checkbox" name="av-emergente" checked>
					</div>
					<div>
						<span>Mostrar al abrir la página</span>
						<input type="checkbox" name="av-visible">
					</div>
					<div>
						<span>Disponible al público</span>
						<input type="checkbox" name="av-estado" checked>
					</div>
					<hr>
					<div>
						<span class="p1">Seleccione imágen</span>
						<input type="file" name="archivo" accept="image/jpeg,image/png">
					</div>
					<div>
						<span class="p2">Nombre de la imágen</span>
						<input type="text" name="ar-nombre" maxlength="45">
					</div>
					<div class="formPie">
						<div class="info">Información de estado</div>
						<div class="boton">
							<input type="submit" class="boton boton-azul" value="Enviar">
						</div>
					</div>
				</form>
			</div>

			<script type="text/javascript">
				$('.formAviso select').change(function(){
					var op = $('.formAviso select').val();
					var p1 = $('.formAviso .p1');
					var p2 = $('.formAviso .p2');
					var fl = p1.siblings('input');
					if(op == 'img'){
						p1.text('Seleccione imágen');
						p2.text('Nombre de la imágen');
						fl.attr('accept', 'image/jpeg,image/png');
					}else if(op == 'doc'){
						p1.text('Seleccione documento');
						p2.text('Nombre del documento');
						fl.attr('accept', 'application/pdf');
					}else if(op == 'link'){
						p1.text('Imagen del enlace');
						p2.text('Enlace de la página');
						fl.attr('accept', 'image/jpeg,image/png');
					}
				});

				$('.formAviso').submit(function(event) {
					event.preventDefault();

					var form = $(this);
					var info = form.find('.info');

					if( form.find('input[name=av-texto]').val().length<1 || 
						form.find('input[name=ar-nombre]').val().length<1 || 
						form.find('input[name=archivo]').val().length<1 ){

						info.text('Llene los campos y/o seleccine un archivo');
						return false;
					}

					form.find('input[type=submit]').attr('disabled','disabled');

					var data = new FormData(form[0]);
					data.append('accion','nuevoAviso');

					console.log(data);
					$.ajax({
						url: "<?= config::getPath(false, '/backend/controllers/ctrlAviso.php') ?>",
						type: 'post',
						dataType: 'json',
						data: data,
						cache: false,
			            contentType: false,
				        processData: false
					})
					.done(function(rpta) {
						info.text(rpta.mensaje);
						if(rpta.detalle=='redirect'){
							window.setTimeout(function(){
								window.location = rpta.data;
							}, 600);
						}
						if(!rpta.estado){
							form.find('input[type=submit]').removeAttr('disabled');
						}
					})
					.fail(function(rpta) {
						console.log(rpta);
						info.text('Error de conección');
						form.find('input[type=submit]').removeAttr('disabled');
					});
					
				});
			</script>

		</div>
		<div class="clean"></div>
	</section>

	<?php require_once config::getRequirePath('includes/footer.html'); ?>
</body>
</html>