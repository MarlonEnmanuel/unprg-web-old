<?php
require_once '../models/mdUsuario.php';
require_once '../models/mdEntrevista.php';
require_once '../models/mdPregunta.php';
require_once '../models/mdInvitacion.php';
require_once '../mailer/edoMailer.php';
require_once 'fnControler.php';

function init(){
    $accion = filter_input(INPUT_POST, 'accion');
    if ($accion) {
        if ($accion == 'registrarEntrevista') {
            RegistrarEntrevista();
        } if ($accion == 'consultarUsuarios') {
            ConsultarUsuarios();
        } if ($accion == 'enviarInvitaciones') {
            EnviarInvitaciones();
        } elseif ($accion == 'logIn') {
            LogIn();
        } 
    } else {
        Respoder(false, 'Debe indicar una acción', null);
    }
}

function RegistrarEntrevista(){
    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }
    if($_SESSION['Usuario']['tipo']!='B'){
        Respoder(false, 'No tiene autorización', null);
    }
    
    $entr = new Entrevista();
    $preguntas;
    if (!(($entr->titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING)) &&
          ($entr->descripcion = filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_STRING)) &&
          ($entr->fchInicio = filter_input(INPUT_POST, 'fchInicio', FILTER_SANITIZE_STRING)) &&
          ($entr->fchFin = filter_input(INPUT_POST, 'fchFin', FILTER_SANITIZE_STRING)) &&
          ($preguntas = filter_input(INPUT_POST, 'preguntas')))) {
        Respoder(false, 'Error al recibir parámetros', null);
    }
    
    try{
        $entr->fchInicio = new DateTime($entr->fchInicio);
        $entr->fchFin = new DateTime($entr->fchFin);
    } catch (Exception $ex) {
        Respoder(false, 'Fecha inicio o fin incorrecta', 'Formato de la fecha incorrecto');
    }
    
    $preguntas = json_decode($preguntas);
    if(is_null($preguntas)){
        Respoder(false, 'Error al recibir preguntas', 'No se pudo procesar el JSON recibido');
    }
    
    try{
        foreach ($preguntas as $p){
            if(!is_int((int)$p->tiempo)){
                throw new Exception($p->tiempo.' no es entero');
            }
        }
    } catch (Exception $ex) {
        Respoder(false, 'Error al recibir parámetros de las preguntas', $ex->getMessage());
    }
    
    //Hasta aquí los param se verificaron
    //Aqui se procesan los datos y se guardan
    $entr->idUsuario = $_SESSION['Usuario']['idUsuario'];
    if(!$entr->set()){
        Respoder(true, 'Error al guardar la entrevista nueva', null, $preguntas);
    }
    
    try{
        foreach ($preguntas as $c=>$p){
            $pa = new Pregunta();
            $pa->premisa = $p->premisa;
            $pa->tiempo = $p->tiempo;
            $pa->idEntrevista = $entr->idEntrevista;
            if(!$pa->set()){
                throw new Exception($p->md_detalle);
            }
        }
        Respoder(true, 'La entrevista se guardó', null, '/invitar?idEntrevista='.$entr->idEntrevista);
    } catch (Exception $ex) {
        Respoder(false, 'Error al guardar pregunta', $ex->getMessage());
    }
    
}

function ConsultarUsuarios(){
    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }
    
//Obtener correos
    $entre = new Entrevista();
    $correos = '';
    if (!(  ($entre->idEntrevista = filter_input(INPUT_POST, 'idEntrevista', FILTER_VALIDATE_INT)) &&
            ($correos = filter_input(INPUT_POST, 'correos')))) {
        Respoder(false, 'Error al recibir parámetros', null);
    }
    
    if(!$entre->get($entre->idEntrevista)){
        Respoder(false, 'No se encontró la entrevista', null);
    }
    
    $correos = explode(',', $correos);
    
//Validar correos
    if(count($correos)<1){
        Respoder(false, 'Debe ingresar al menos un correo', null);
    }
    foreach ($correos as $key => $val) {
        if(!filter_var($val,FILTER_VALIDATE_EMAIL)){
            Respoder(false, 'Uno o varios correos son incorrectos', null);
        }
    }
    
//Consultar Usuarios
    $usersInv = array();
    $usersOk = array();
    $usersNew = array();
    $user = new Usuario();
    foreach ($correos as $key => $val) {
        $invit = new Invitacion();
        if($invit->getEmailEntrevista($val, $entre->idEntrevista)){
            array_push($usersInv, trim($val));
        }else{
            if($user->get('email', trim($val))){
                array_push($usersOk, array(
                    'idUsuario' => $user->idUsuario,
                    'email' => $user->email,
                    'nombres' => $user->nombres,
                    'apellidos' => $user->apellidos
                ));
            }else{
                array_push($usersNew, trim($val));
            }
        }
    }
    
    Respoder('true', 'Consulta correcta', null, array(
        'usersInv' => $usersInv,
        'usersOk' => $usersOk,
        'usersNew' => $usersNew
    ));
}

function EnviarInvitaciones(){
    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }
    
    $entre = new Entrevista();
    if(!($entre->idEntrevista = filter_input(INPUT_POST, 'idEntrevista',FILTER_VALIDATE_INT))){
        Respoder(false, 'Error al recibir parámetros', null);
    }
    
    if(!$entre->get($entre->idEntrevista)){
        Respoder(false, 'No se encontró la entrevista', null);
    }
    
    if($entre->idUsuario!=$_SESSION['Usuario']['idUsuario']){
        Respoder(false, 'No está autorizado', null);
    }
    
    if (!($invitaciones = filter_input(INPUT_POST, 'invitaciones'))) {
        Respoder(false, 'Error al recibir parámetros 2', null);
    }
    
    $invitaciones = json_decode($invitaciones);
    if(is_null($invitaciones)){
        Respoder(false, 'Error al recibir invitaciones', null);
    }
    
    $invError = array();
    $mail = new edoMailer();
    foreach ($invitaciones as $val) {
        $inv = new Invitacion();
        $inv->email = $val->email;
        $inv->nombres = $val->nombres;
        $inv->apellidos = $val->apellidos;
        $inv->idEntrevista = $entre->idEntrevista;
        if(isset($val->idUsuario) && strlen($val->idUsuario)>0){
            $inv->idUsuario = $val->idUsuario;
        }else{
            $inv->idUsuario = null;
        }
        
        if(!$inv->set()){
            array_push($invError, array(
                'email' => $inv->email,
                'error' => $inv->md_mensaje
            ));
        }else{
            $datos = array(
                'email' => $inv->email,
                'nombres' => $inv->nombres,
                'apellidos' => $inv->apellidos,
                'titulo' => $entre->titulo,
                'fchInicio' => $entre->fchInicio->format(Entrevista::$fchFtoMail),
                'fchFin' => $entre->fchFin->format(Entrevista::$fchFtoMail),
            );
            if(is_null($inv->idUsuario)){
                $datos['codigo'] = sha1($inv->idInvitacion);
            }
            if(!$mail->sendInvitacion($datos)){
                array_push($invError, array(
                    'email' => $inv->email,
                    'error' => $mail->mensaje
                ));
            }
        }
    }
    
    Respoder(true, 'Invitaciones enviadas', null, $invError);
    
}

init();