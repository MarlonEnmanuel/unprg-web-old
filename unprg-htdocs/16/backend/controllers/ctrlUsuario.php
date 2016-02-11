<?php
require_once 'abstractController.php';
require_once '../models/Usuario.php';
require_once '../config.php';

class ctrlUsuario extends abstractController {

    public function __construct(){
        $this->acceso = 'admin';
    }

    public function init(){
        $accion = filter_input(INPUT_POST, 'accion', FILTER_SANITIZE_STRING);
        if(!$accion) $this->responder(false, "Error de parámetros");

        if($accion == 'login'){
            $this->Login();
        }else{
            $this->responder(false, "No se indicó una acción");
        }
    }

    public function Login(){
        $_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $_pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING);

        if(!$_email || !$_pass) $this->responder(false, "Error al recibir datos");

        $mysqli = config::getMysqli();
        $user = new Usuario($mysqli);
        $user->getEmail($_email);

        if($user->md_estado == false) $this->responder(false, "El usuario no existe");

        if($user->password != $_pass) $this->responder(false, "Contraseña incorrecta");

        session_start();
        $_SESSION['Usuario'] = $user->toArray();
        $this->responder(true, 'Bienvenido', '', config::$path_admin);
    }

}

$ctrl = new ctrlUsuario();
$ctrl->init();

?>