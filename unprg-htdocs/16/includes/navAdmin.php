<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';

$menuItems = [
	array(
		'text' => 'Avisos',
		'menu' => [
			array('text' => 'Crear Aviso', 'perm' => 'aviso', 'link' => '/admin/nuevoAviso.php'),
			array('text' => 'Mis Avisos', 'perm' => 'aviso', 'link' => '/admin/misAvisos.php'),
			array('text' => 'Todos los Avisos', 'perm' => 'admin', 'link' => '/admin/todosAvisos.php'),
		]
	),
	array(
		'text' => 'Noticias'
	),
	array(
		'text' => 'Eventos'
	),
	array(
		'text' => 'Usuario',
		'menu' => [
			array('text' => 'Crear Usuario', 'perm' => 'admin', 'link' => '/admin/nuevoUsuario.php'),
			array('text' => 'Mi usuario', 'perm' => 'all', 'link' => '/admin/perfil.php'),
		]
	),
	array(
		'text' => 'Cerrar Sesión', 'link' => '/backend/controllers/ctrlUsuario.php?accion=logout'
	),
];

?>

<div class="titulo">
	<div class="unprg">Administración Web</div>
	<div class="usuario">Bienvenido, Administrador</div>
</div>
<ul>
	<?php
		foreach ($menuItems as $key => $val) {
			if(isset($val['link'])){
				echo '<li><a href="'.config::getPath(false, $val['link']).'">'.$val['text'].'</a>';
			}else{
				echo '<li><p>'.$val['text'].'</p>';
			}
			if(isset($val['menu'])){
				echo '<ul>';
				foreach ($val['menu'] as $idx => $itm) {
					if( $itm['perm']=='all'){
						echo '<li><a href="'.config::getPath(false, $itm['link']).'">'.$itm['text'].'</a></li>';
					}else{
						if( in_array($itm['perm'], $_SESSION['Usuario']['permisos']) ){
							echo '<li><a href="'.config::getPath(false, $itm['link']).'">'.$itm['text'].'</a></li>';
						}
					}
				}
				echo '</ul>';
			}
			echo '</li>';
		}
	?>
</ul>