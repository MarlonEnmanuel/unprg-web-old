<?php

require_once '../models/mdUsuario.php';
require_once '../models/mdInvitacion.php';
require_once '../mailer/edoMailer.php';
require_once 'fnControler.php';

$files_dir = '../../files/';
$files_url = '/files/';
$photo_default = '/frontend/img/foto-perfil.jpg';

function init() {
    $accion = filter_input(INPUT_POST, 'accion');
    if ($accion) {
        if ($accion == 'registrarUsuario') {
            UsuarioNuevo();
        } elseif ($accion == 'logIn') {
            LogIn();
        } elseif ($accion == 'actualizarFoto') {
            ActualizarFoto();
        } elseif ($accion == 'actualizarDocumento') {
            ActualizarDocumento();
        } elseif ($accion == 'actualizarPassword') {
            ActualizarPassword();
        } elseif ($accion == 'actualizarDatos') {
            ActualizarDatos();
        } else {
            Respoder(false, 'No existe la acción', null);
        }
    } else {
        Respoder(false, 'Debe indicar una acción', null);
    }
}

function UsuarioNuevo() {
    global $files_url, $photo_default;

    $user = new Usuario();
    if (($user->dni = filter_input(INPUT_POST, 'dni', FILTER_VALIDATE_INT)) &&
            ($user->nombres = filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING)) &&
            ($user->apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING)) &&
            ($user->email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) &&
            ($user->pass = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING)) &&
            ($user->tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING))) {

        if ($user->tipo == 'A' || $user->tipo == 'B') {
            $u_aux = new Usuario;

            $u_aux->get('dni', $user->dni);
            if (!$u_aux->md_estado) {

                $u_aux->get('email', $user->email);
                if (!$u_aux->md_estado) {

                    $user->foto = $photo_default;
                    $user->documento = '';
                    $user->set();
                    
                    if ($user->md_estado) {
                        
                        $inv = new Invitacion();
                        $invs = $inv->searchEmail($user->email);
                        foreach ($invs as $key => $val) {
                            $val->idUsuario = $user->idUsuario;
                            $val->edit();
                        }
                        
                        session_start();
                        $_SESSION['Usuario'] = $user->toArray();
                        $mail = new edoMailer();
                        $mail->sendBienvenida($user->toArray());
                        Respoder(true, 'Usuario registrado', $mail->mensaje, '/perfil');
                    } else {
                        Respoder(false, $user->md_mensaje, $user->md_detalle);
                    }
                } else {
                    Respoder(false, 'Este email ya está en uso', null);
                }
            } else {
                Respoder(false, 'Este DNI ya está en uso', null);
            }
        } else {
            Respoder(false, 'Error al recibir los parámetros', null);
        }
    } else {
        Respoder(false, 'Error al recibir los parámetros', null);
    }
}

function LogIn() {
    $_email = filter_input(INPUT_POST, 'login-email');
    $_pass = filter_input(INPUT_POST, 'login-pass');
    if ($_email && $_pass) {
        $user = new Usuario();
        $user->get('email', $_email);
        if ($user->md_estado) {
            if ($user->pass == $_pass) {
                session_start();
                $_SESSION['Usuario'] = $user->toArray();
                Respoder(true, 'Bienvenido :D', '', '/home');
            } else {
                Respoder(false, 'Contraseña incorrecta', null);
            }
        } else {
            Respoder(false, 'El usuario no existe', null);
        }
    } else {
        Respoder(false, 'Error al recibir los parámetros', null);
    }
}

function ActualizarFoto() {
    global $photo_default, $files_dir, $files_url;

    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }

    if (!isset($_FILES['foto'])) {
        Respoder(false, 'Error de parámetros', null);
    }

    $fileName = $_FILES['foto']['name'];
    $fileType = $_FILES['foto']['type'];
    $fileSize = $_FILES['foto']['size'];
    $fileTemp = $_FILES['foto']['tmp_name'];
    $fileErro = $_FILES['foto']['error'];

    if ($fileErro != UPLOAD_ERR_OK) {
        Respoder(false, 'Error en la transmisión del archivo', null);
    }
    if ($fileSize <= 0) {
        Respoder(false, 'Debe indicar una imagen para subir', null);
    }
    if ($fileSize > 1000000) {
        Respoder(false, 'La imagen debe tener máximo 1MB', null);
    }
    if ($fileType != 'image/jpeg') {
        Respoder(false, 'La imagen debe tener formato JPG', null);
    }

    if ($_SESSION['Usuario']['foto'] == $photo_default) {

        $user = new Usuario;
        $user->get('idUsuario', $_SESSION['Usuario']['idUsuario']);

        if (!$user->md_estado) {
            Respoder(false, 'No se pudo obtener el usuario', null);
        }

        $fileNewName = 'foto_' . sha1($user->idUsuario) . '.jpg';

        $fileNew = $files_dir . $fileNewName;
        if (move_uploaded_file($fileTemp, $fileNew)) {
            $user->foto = $files_url . $fileNewName;
            if ($user->edit()) {
                $_SESSION['Usuario'] = $user->toArray();
                Respoder(true, 'Foto de perfil actualizada', null, $user->foto);
            } else {
                Respoder(false, $user->md_mensaje, $user->md_detalle);
            }
        } else {
            Respoder(false, 'Error al guardar archivo', null);
        }
    } else {
        $fileNewName = 'foto_' . sha1($_SESSION['Usuario']['idUsuario']) . '.jpg';
        $fileNew = $files_dir . $fileNewName;
        if (move_uploaded_file($fileTemp, $fileNew)) {
            Respoder(true, 'Foto de perfil actualizada', null, $files_url . $fileNewName);
        } else {
            Respoder(false, 'Error al guardar archivo', null);
        }
    }
}

function ActualizarDocumento() {
    global $photo_default, $files_dir, $files_url;

    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }

    if (!isset($_FILES['documento'])) {
        Respoder(false, 'Error de parámetros', null);
    }

    $fileName = $_FILES['documento']['name'];
    $fileType = $_FILES['documento']['type'];
    $fileSize = $_FILES['documento']['size'];
    $fileTemp = $_FILES['documento']['tmp_name'];
    $fileErro = $_FILES['documento']['error'];

    if ($fileErro != UPLOAD_ERR_OK) {
        Respoder(false, 'Error en la transmisión del archivo', null);
    }
    if ($fileSize <= 0) {
        Respoder(false, 'Debe indicar un documento para subir', null);
    }
    if ($fileSize > 1000000) {
        Respoder(false, 'El documento debe tener máximo 2MB', null);
    }
    if ($fileType != 'application/pdf') {
        Respoder(false, 'El documento debe tener formato PDF', null);
    }

    if ($_SESSION['Usuario']['documento'] == '') {

        $user = new Usuario;
        $user->get('idUsuario', $_SESSION['Usuario']['idUsuario']);
        if (!$user->md_estado) {
            Respoder(false, 'No se pudo obtener el usuario', null);
        }

        $fileNewName = 'documento_' . sha1($user->idUsuario) . '.pdf';
        $fileNew = $files_dir . $fileNewName;
        if (move_uploaded_file($fileTemp, $fileNew)) {
            $user->documento = $files_url . $fileNewName;
            if ($user->edit()) {
                $_SESSION['Usuario'] = $user->toArray();
                Respoder(true, 'Documento actualizado', null, $user->documento);
            } else {
                Respoder(false, $user->md_mensaje, $user->md_detalle);
            }
        } else {
            Respoder(false, 'Error al guardar archivo', null);
        }
    } else {
        $fileNewName = 'documento_' . sha1($_SESSION['Usuario']['idUsuario']) . '.pdf';
        $fileNew = $files_dir . $fileNewName;
        if (move_uploaded_file($fileTemp, $fileNew)) {
            Respoder(true, 'Documento actualizado', null, $files_url . $fileNewName);
        } else {
            Respoder(false, 'Error al guardar archivo', null);
        }
    }
}

function ActualizarPassword() {
    session_start();
    if (isset($_SESSION['Usuario'])) {
        $user = new Usuario();
        $user->get('idUsuario', $_SESSION['Usuario']['idUsuario']);

        if ($user->md_estado) {

            if (($pass0 = filter_input(INPUT_POST, 'pass0', FILTER_SANITIZE_STRING)) &&
                    ($pass1 = filter_input(INPUT_POST, 'pass1', FILTER_SANITIZE_STRING)) &&
                    ($pass2 = filter_input(INPUT_POST, 'pass2', FILTER_SANITIZE_STRING))) {

                if ($pass1 == $pass2) {
                    if ($pass0 == $user->pass) {
                        $user->pass = $pass1;
                        $user->edit();
                        Respoder($user->md_estado, $user->md_mensaje, $user->md_detalle);
                    } else {
                        Respoder(false, 'Contraseña actual incorrecta', null);
                    }
                } else {
                    Respoder(false, 'Las contraseñas no coinciden', null);
                }
            } else {
                Respoder(false, 'Error al recibir parámetros', null);
            }
        }
        Respoder(false, $user->md_mensaje, $user->md_detalle);
    } else {
        Respoder(false, 'Debe iniciar sesión', null);
    }
}

function ActualizarDatos() {
    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }

    $user = new Usuario();

    $user->get('idUsuario', $_SESSION['Usuario']['idUsuario']);
    if (!$user->md_estado) {
        Respoder(false, 'No se pudo obtener el usuario', null);
    }

    if (!(($user->dni = filter_input(INPUT_POST, 'dni', FILTER_VALIDATE_INT)) &&
            ($user->nombres = filter_input(INPUT_POST, 'nombres', FILTER_SANITIZE_STRING)) &&
            ($user->apellidos = filter_input(INPUT_POST, 'apellidos', FILTER_SANITIZE_STRING)) &&
            ($user->email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)))) {
        Respoder(false, 'Error al recibir parámetros', null);
    }
    
    $uAux = new Usuario();
    if($user->dni!=$_SESSION['Usuario']['dni'] && $uAux->get('dni', $user->dni)){
        Respoder(false, 'Este DNI no está disponible', null);
    }
    if($user->email!=$_SESSION['Usuario']['email'] && $uAux->get('email', $user->email)){
        Respoder(false, 'Este email no está disponible', null);
    }
    
    if($user->edit()){
        $_SESSION['Usuario'] = $user->toArray();
        Respoder(true, 'Información actualizada', null);
    }else{
        Respoder(false, $user->md_mensaje, $user->md_detalle);
    }
}


init();
