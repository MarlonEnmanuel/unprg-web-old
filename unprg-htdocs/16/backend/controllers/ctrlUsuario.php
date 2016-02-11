<?php
require_once 'abstractController.php';
require_once '../models/Usuario.php';
require_once '../config.php';

class ctrlUsuario extends abstractController {

    public function __construct(){
        $this->acceso = 'admin';
    }

    public function init(){

    }

    public function Login(){
        session_destroy();

        $_email = filter_input(INPUT_POST, 'login-email', FILTER_VALIDATE_EMAIL);
        $_pass = filter_input(INPUT_POST, 'login-pass', FILTER_SANITIZE_STRING);

        if(!$_email || !$_pass) Responder(false, "Error al recibir datos");

        $user = new Usuario();
        $user->getEmail($_email);

        if($user->md_estado == false) Responder(false, "El usuario no existe");

        if($user->password != $_pass) Responder(false, "Contraseña incorrecta");

        Responder(true,'Bienvenido','','panel.php');
    }

}

?>