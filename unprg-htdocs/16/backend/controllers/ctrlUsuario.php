<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
require_once config::getRequirePath('backend/controllers/abstractController.php');
require_once config::getRequirePath('backend/models/Usuario.php');

class ctrlUsuario extends abstractController {

    protected function init($accion){

        if($accion == 'login'){         //acción del controlador
            $this->login();

        }elseif($accion == 'logout'){   //acción del controlador
            $this->logout();    

        }elseif($accion == 'nuevoUsuario'){         //acción del controlador
            $this->nuevoUsuario();

        }elseif($accion == ''){         //acción del controlador


        }else{                          //responde cuando la acción no corresponde a ningun controlador
            $this->responder(false, "Acción no soportada");
        }
    }

    protected function login(){
        $inputs = array();
        $inputs['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $inputs['pass']  = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);
        $this->checkInputs($inputs);

        $mysqli = config::getMysqli();
        $user = new Usuario($mysqli);
        $user->getEmail($inputs['email']);

        if($user->md_estado == false) $this->responder(false, "El usuario no existe");
        if($user->password != $inputs['pass']) $this->responder(false, "Contraseña incorrecta");

        session_start();
        $user->permisos = explode(',', $user->permisos);
        $_SESSION['Usuario'] = $user->toArray();
        $this->responder(true, 'Bienvenido', 'redirect', 'panel.php');
    }

    public function logout(){
        session_start();
        session_destroy();
        $mensaje = "Hasta luego";
        header('Location: '.config::getPath(false ,'/admin').'?msj='.$mensaje);
        exit();
    }

    protected function nuevoUsuario(){
        $this->checkAccess('admin');

        $ipts = array(
            'email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
            'nombres' => filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING),
            'apellidos' => filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING),
            'oficina' => filter_input(INPUT_POST, 'oficina', FILTER_SANITIZE_STRING),
            'estado' => filter_input(INPUT_POST, 'estado', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'p-aviso' => filter_input(INPUT_POST, 'p-aviso', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'p-noticia' => filter_input(INPUT_POST, 'p-noticia', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE),
            'p-evento' => filter_input(INPUT_POST, 'p-evento', FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)
        );

        $this->checkInputs($ipts, ['estado','p-aviso','p-noticia','p-evento']);

        $ipts['permisos'] = [];
        if($ipts['p-aviso']) array_push($ipts['permisos'], 'aviso');
        if($ipts['p-noticia']) array_push($ipts['permisos'], 'noticia');
        if($ipts['p-evento']) array_push($ipts['permisos'], 'evento');
        if( empty($ipts['permisos']) ){
            $this->responder(false, 'Debe elegir al menos un acceso');
        }
        $ipts['permisos'] = implode(',', $ipts['permisos']);

        $mysqli = config::getMysqli();
        $aux = new Usuario($mysqli);
        if( $aux->getEmail($ipts['email']) ){
            $this->responder(false, 'El email '.$ipts['email'].' ya está en uso');
        }

        $randPass = $this->getRandomPass(8);
        $user = new Usuario($mysqli);
        $user->email = $ipts['email'];
        $user->password = sha1($randPass);
        $user->nombres = $ipts['nombres'];
        $user->apellidos = $ipts['apellidos'];
        $user->oficina = $ipts['oficina'];
        $user->estado = $ipts['estado'];
        $user->permisos = $ipts['permisos'];

        if($user->set()){
            $this->responder(true, 'Usuario creado! los datos de acceso son:<br>Email: '.$user->email.'<br>Contraseña: '.$randPass.'<br>Sírvase notificar al usuario');
        }else{
            $this->responder(false, $user->md_mensaje, $user->md_detalle);
        }
    }

    private function getRandomPass($length){
        $pass = '';
        for ($i=0; $i < $length; $i++) { 
            $pass .= chr(rand(97,122));
        }
        return $pass;
    }

}

$ctrl = new ctrlUsuario(true);

?>
