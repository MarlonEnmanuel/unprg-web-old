<?php
require_once 'abstractController.php';
require_once '../models/Usuario.php';
require_once '../config.php';

class ctrlUsuario extends abstractController {

    public function init($accion){

        if($accion == 'login'){         //acción del controlador
            $this->login();

        }elseif($accion == 'logout'){   //acción del controlador


        }elseif($accion == ''){         //acción del controlador


        }elseif($accion == ''){         //acción del controlador


        }else{                          //responde cuando la acción no corresponde a ningun controlador
            $this->responder(false, "No se indicó una acción");
        }
    }

    public function login(){
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

}

$ctrl = new ctrlUsuario();

?>