<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
	$msj = filter_input(INPUT_GET, 'msj', FILTER_SANITIZE_STRING);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>UNPRG | Evento</title>
	<meta name="description" content="Ceremonia de Asunción del Rector (Periodo 2015-2020)">
	<link rel="shortcut icon" href="<?= config::getPath(true,'/frontend/img/favicon.ico') ?>" type="image/x-icon">

	<meta name="viewport" content="width=device-width, user-scalable=no">

	<meta property="og:image"		content="<?= config::getPath(true,'frontend/img/unprg-social.jpg') ?>" />
	<meta property="og:title"   	content="Evento | Ceremonia de Asunción del Rector" />
	<meta property="og:description"	content="Ceremonia de Asunción del Rector (Periodo 2015-2020)" />
	<meta property="og:url" 		content="<?= config::getPath(true, 'eventos/juramentacion.php') ?>" />
	<meta property="og:locale" 		content="es_ES" />
	<meta property="og:site_name" 	content="UNPRG" />

	<!-- Importación de Librerías -->
		<?= config::getScript(config::getPath(false,'/frontend/libs/jquery.js')) ?>
		<?= config::getScript(config::getPath(false,'/frontend/libs/sha1.js')) ?>
		<?= config::getLink('https://fonts.googleapis.com/css?family=Titillium+Web') ?>

	<!-- Importación de Slider -->
		<?= config::getLink(config::getPath(false,'/frontend/owl-carousel/owl.carousel.css')) ?>
		<?= config::getScript(config::getPath(false,'/frontend/owl-carousel/owl.carousel.min.js')) ?>

	<!-- Importación de archivos propios -->
		<?= config::getLink(config::getPath(false,'/frontend/css/general.css')) ?>
		<?= config::getLink(config::getPath(false,'/frontend/css/eventos.css')) ?>

		<script type="text/javascript">
			$(document).ready(function(){
				$("section .galeria .slider").owlCarousel({
				    lazyLoad : true,
				    navigation : false,
				    items : 3,
				    itemsDesktop : [1100,3],
				    itemsDesktopSmall : false,
				    itemsTablet: [860,2],
				    itemsTabletSmall: false,
				    itemsMobile : [560,1]
				});
			});
		</script>

</head>
<body>
	<?php require_once config::getRequirePath('includes/header.html'); ?>
	<?php require_once config::getRequirePath('includes/nav.html'); ?>
	
	<section class="evento">
		<div class="wraper">
			<div class="titulo">
				Ceremonia de Asunción del Rector (Periodo 2015-2020)
			</div>
			<div class="info">
				<div class="tipo">Evento @19/02/2016</div>
				<div class="oficina">por Imagen Institucional</div>
			</div>
			
			<div class="galeria">
				<div class="subtitulo">ENTRADA</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/1.Entrada/DSC_0074.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/1.Entrada/DSC_0076.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/1.Entrada/DSC_0083.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/1.Entrada/DSC_0087.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/1.Entrada/DSC_0090.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/1.Entrada/DSC_0092.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/1.Entrada/DSC_0093.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/1.Entrada/DSC_0095.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>

			<div class="galeria">
				<div class="subtitulo">SALUDO MUCHIK Y ENTREGA DEL BASTÓN DE MANDO A RECTOR</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0107.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0113.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0117.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0120.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0124.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0126.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0127.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0128.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/2.Saludo_Muchik/DSC_0129.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>

			<div class="galeria">
				<div class="subtitulo">JURAMENTACION DE RECTOR, VICERRECTORES Y DECANOS</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0138.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0141.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0143.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0146.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0151.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0154.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0156.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0158.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0159.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0162.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0175.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/3.Juramentacion/DSC_0181.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>

			<div class="galeria">
				<div class="subtitulo">MENSAJE DEL RECTOR A LA COMUNIDAD UNIVERSITARIA</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0192.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0193.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0202.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0203.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0207.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0209.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0222.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0225.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/4.Discurso_rector/DSC_0228.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>

			<div class="galeria">
				<div class="subtitulo">RECONOCIMIENTO A RECTOR</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/5.Reconocimiento_rector/DSC_0229.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/5.Reconocimiento_rector/DSC_0231.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/5.Reconocimiento_rector/DSC_0235.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/5.Reconocimiento_rector/DSC_0237.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/5.Reconocimiento_rector/DSC_0243.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/5.Reconocimiento_rector/DSC_0245.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/5.Reconocimiento_rector/DSC_0246.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>

			<div class="galeria">
				<div class="subtitulo">DISTINCIÓN DE LA ALTA DIRECCIÓN A MIEMBROS DEL CAUTA, ASAMBLEA UNIVERSITARIA Y COMITÉ ELECTORAL</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/6.Reconocimiento_alta_direccion/DSC_0252.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/6.Reconocimiento_alta_direccion/DSC_0254.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/6.Reconocimiento_alta_direccion/DSC_0256.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/6.Reconocimiento_alta_direccion/DSC_0258.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/6.Reconocimiento_alta_direccion/DSC_0261.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/6.Reconocimiento_alta_direccion/DSC_0266.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/6.Reconocimiento_alta_direccion/DSC_0268.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/6.Reconocimiento_alta_direccion/DSC_0275.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>
			
			<div class="galeria">
				<div class="subtitulo">MENSAJE DE LA  PRESIDENTA DE LA SUNEDU</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0282.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0284.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0286.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0291.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0297.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0307.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0311.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0313.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0314.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0316.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0318.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0320.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0322.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0325.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0329.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/7.Mensaje_Presidenta_SUNEDU/DSC_0333.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>
			
			<div class="galeria">
				<div class="subtitulo">BRINDIS DE HONOR</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/8.Brindis_honor/DSC_0338.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/8.Brindis_honor/DSC_0341.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/8.Brindis_honor/DSC_0342.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/8.Brindis_honor/DSC_0344.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/8.Brindis_honor/DSC_0346.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>

			<div class="galeria">
				<div class="subtitulo">RECTOR IMPONE DISTINTIVOS A DECANOS E INVITADOS ESPECIALES</div>
				<div class="slider owl-carousel">
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0383.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0407.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0410.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0412.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0416.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0420.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0423.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0425.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0426.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0429.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0432.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0439.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0445.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0453.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0455.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0456.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0457.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0458.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0462.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0463.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0464.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0465.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0466.jpg') ?>"></div>
					<div class="item"><img class="lazyOwl" data-src="<?= config::getPath(false, '/eventos/galeria/9.Imposicion_distintivos/DSC_0468.jpg') ?>"></div>
				</div>
				<div class="clean"></div>
			</div>

		</div>
	</section>

	<?php require_once config::getRequirePath('includes/footer.html'); ?>
</body>
</html>