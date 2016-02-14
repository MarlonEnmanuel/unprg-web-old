<div class="titulo">
	<div class="unprg">Administración Web</div>
	<div class="usuario">Bienvenido, Administrador</div>
</div>
<ul>
	<li>
		<a href="#">UNPRG Avisos</a>
		<ul>
			<li><a href="#">Todos los avisos</a></li>
			<li><a href="<?= config::getPath(false, '/admin/nuevoAviso.php') ?>">Crear aviso</a></li>
		</ul>
	</li>
	<li><a href="#">UNPRG Noticias</a></li>
	<li><a href="#">UNPRG Eventos</a></li>
	<li><a href="<?= config::getPath(false, '/backend/controllers/ctrlUsuario.php?accion=logout') ?>">Cerrar Sesión</a></li>
</ul>