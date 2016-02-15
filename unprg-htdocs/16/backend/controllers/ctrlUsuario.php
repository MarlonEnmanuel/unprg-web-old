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

        }elseif($accion == ''){         //acción del controlador


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
        $user->permisos = split(',', $user->permisos);
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

}

$ctrl = new ctrlUsuario(true);

?>