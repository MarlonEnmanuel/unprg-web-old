<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';

abstract class abstractController {

	public $isAjax = false;

	public function __construct($isAjax=false){
		
		if($isAjax===true || $isAjax===false){
			$this->isAjax = $isAjax;
		}

		//Se inicializa el controlador solo si recibe peticiones ajax
		if($isAjax){
	        $accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);

	        //Si no encuentra se pide por get
	        if($accion==null){
	        	$accion = filter_input(INPUT_GET , 'accion', FILTER_SANITIZE_STRING);
	        }

	        //Si falla se responde al usuario
	        if($accion==false || $accion==null){
            	$this->responder(false, "No se indicó una acción");
            }

            //Se inicializar el controlador
            $this->init($accion);
		}
	}

	/**
	* Inicia el controlador
	*
	* Esta funcion recibe la acción del cliente
	* y hace el llamado a la funcion del controlador correspondiente.
	* Esta función debe ser implementada por cada controlador.
	*
	*/
	abstract protected function init($accion);

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
	public final function checkAccess($codAcceso=null){
		if(!isset($_SESSION)) session_start();

		if(!isset($_SESSION['Usuario'])){
			$mensaje = 'Debe iniciar sesión';
			if($this->isAjax){
				$this->responder(false, $mensaje, 'redirect', config::getPath(false ,'/admin'.'?msj='.$mensaje));
			}else{
				header('Location: '.config::getPath(false ,'/admin').'?msj='.$mensaje);
				echo 'hola';
				exit;
			}
		}
		if( $codAcceso!=null && !in_array($codAcceso , $_SESSION['Usuario']['permisos']) ){
			$mensaje = 'No tiene permisos para esta acción';
			if($this->isAjax){
				$this->responder(false, $mensaje, 'redirect', config::getPath(false ,'/admin/panel.php'.'?msj='.$mensaje));
			}else{
				header('Location: '.config::getPath(false ,'/admin/panel.php').'?msj='.$mensaje);
				exit;
			}
		}
		return $_SESSION['Usuario'];
	}

	/**
	* Comprueba los datos recibidos por get o post
	*
	* Comprueba que los dato se hayan filtrado correctamente
	* verificando si es null o false, en tal caso responde con una alerta
	* al cliente
	*
	* @param $inputs Array con los datos
	* @return boolean Devuelve true si todos los datos son correctos
	*/
	public final function checkInputs($inputs, $booleans=[]){
		foreach ($inputs as $key => $value) {
			if( in_array($key, $booleans) ){
				if( is_null($value) ) {
					if($this->isAjax){
						$this->responder(false, 'Error al recibir datos');
					}else{
						return false;
					}
					break;
				}
			}else{
				if( is_null($value) || $value===false) {
					if($this->isAjax){
						$this->responder(false, 'Error al recibir datos');
					}else{
						return false;
					}
					break;
				}
			}
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
	* @return Boolean Devuelve falso si $isAjax está consifurado en false
	*/
	protected final function responder($estado, $mensaje, $detalle='', $datos=array()){
		if($this->isAjax==false) return false;
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