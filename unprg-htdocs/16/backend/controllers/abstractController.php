<?php
require_once '../config.php';

abstract class abstractController {

	/**
	* Inicia el controlador
	*
	* Esta funcion recibe la acción del usuario por get o post
	* y hace el llamado a la funcion del controlador correspondiente.
	* Esta función debe ser implementada por cada controlador.
	*
	*/
	abstract public function init();

	/**
	* Controla el acceso del usuario
	*
	* Controla el acceso del usuario dependiendo de sus permisos,
	* verifica si el usuario ha iniciado sesión, luego si tiene permisos.
	* En caso de inflingir, se manda una alerta al usuario
	* y se pide al cliente su redirección a la pagina de logeo.
	* Si el codigo de acceso no se indica o es null, entonces todos
	* los usuarios tendrán acceso al controlador.
	*
	* @param $codAcceso Codigo de acceso del controlador, por defecto es null
	* @return boolean Indica si el usuario tiene acceso
	*/
	protected final function checkAccess($codAcceso=null){
		if( !isset($_SESSION['Usuario']) ){
			$this->responder(false, 'Debe iniciar sesión', 'redirect', config::getPath(false ,'/admin'));
		}
		if( $codAcceso!=null && !in_array($codAcceso , $_SESSION['Usuario']['permisos']) ){
			$this->responder(false, 'No tiene permisos para esta acción', 'redirect', config::getPath(false ,'/admin/panel.php'));
		}
		return true;
	}

	/**
	* Envía la respuesta del controlador al usuario
	*
	* Esta funcón recibe la respuesta del controlador, y da el formato a los datos
	* para que estos puedan ser entendidos por el cliente, finalmente termina
	* la ejecución del script php.
	*
	* @param $estado Si es verdadero, el script se ejecutó correctamente
	* @param $mensaje Mensaje del controlador
	* @param $detalle Detalle del controlador
	* @param $datos Datos enviados al usuario
	*/
	protected final function responder($estado, $mensaje, $detalle='', $datos=array()){
		$rpta = array(
	            'estado' => $estado,
	            'mensaje' => $mensaje,
	            'detalle' => $detalle,
	            'data' => $datos
	            );
	    header('Content-type: application/json; charset=utf-8');
	    echo json_encode($rpta);
	    exit;
	}

	/**
	* Comprueba los datos recibidos por get o post
	*
	* Comprueba que los dato se hayan filtrado correctamente
	* verificando si es null o false, en tal caso responde con una alerta
	* al cliente
	*
	* @param $inputs Array con los datos
	* @return boolean Indica el estado
	*/
	protected final function checkInputs($inputs){
		foreach ($inputs as $key => $value) {
			if( $value==false || $value==null){
				$this->responder(false, 'Error al recibir datos');
				break;
			}
		}
		return true;
	}

}

?>