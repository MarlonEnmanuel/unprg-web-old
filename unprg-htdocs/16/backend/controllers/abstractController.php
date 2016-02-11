<?php
abstract class abstractController {

	public static $acceso;

	abstract public function init();

	/**
	* Comprueba el acceso del usuario
	*
	* Comproueba si el usuario tiene permiso de acceso al controlador requerido
	*
	* @return boolean Indica si el usuario tiene acceso
	*
	*/
	protected final function checkAccess(){
		if(!isset($_SESSION['Usuario'])) return false;

		$perm = split(',', $_SESSION['Usuario']['permisos']);
		return in_array($this->acceso , $perm);
	}

	/**
	* Envía a respuesta del controlador al usuario
	*
	* @param $estado Si es verdadero, el script se ejecutó correctamente
	* @param $mensaje Mensaje del controlador
	* @param $detalle Detalle del controlador
	* @param $datos Datos enviados al usuario
	* @return boolean Indica si el usuario tiene acceso
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

}

?>