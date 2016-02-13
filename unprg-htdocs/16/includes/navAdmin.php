<nav>
	<div class="wraper">
		<div class="titulo">
			<p class="titulo1">UNPRG Administración Web</p>
			<p class="titulo2">Bienvenido: 
				<?php
					if($_SESSION['Usuario']['permisos']=='admin'){
						echo 'Administrador';
					}else{
						echo $_SESSION['Usuario']['nombres'].' '.$_SESSION['Usuario']['apellidos'];
					}
				?>
			</p>
		</div>
		<div class="cerrar">Cerrar Sesión</div>
	</div>
</nav>