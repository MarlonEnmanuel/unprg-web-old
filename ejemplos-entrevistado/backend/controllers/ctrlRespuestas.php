<?php

require_once '../models/mdEntrevista.php';
require_once '../models/mdPregunta.php';
require_once '../models/mdRespuesta.php';
require_once '../models/mdInvitacion.php';
require_once 'fnControler.php';

$files_dir = '../../audios/';
$files_url = '/audios/';

function init() {
    $accion = filter_input(INPUT_POST, 'accion');
    if ($accion) {
        if ($accion == 'guardarRespuesta') {
            GuardarRespuesta();
        } elseif ($accion == 'guardarVideo') {
            GuardarVideo();
        } elseif ($accion == 'terminarEntrevista') {
            TerminarEntrevista();
        } elseif ($accion == 'calificarInvitacion') {
            CalificarInvitacion();
        } else {
            Respoder(false, 'No existe la acción', null);
        }
    } else {
        Respoder(false, 'Debe indicar una acción', $_POST);
    }
}

function GuardarRespuesta() {
    global $files_dir, $files_url;
    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }
    if ($_SESSION['Usuario']['tipo'] != 'A') {
        Respoder(false, 'No tiene autorización', null);
    }
    if (!isset($_SESSION['Respondiendo'])) {
        Respoder(false, 'Debe indicar una entrevista', null);
    }

    $Invitacion = $_SESSION['Respondiendo']['Invitacion'];
    $Entrevista = $_SESSION['Respondiendo']['Entrevista'];
    $Reespuesta = new Respuesta();
    $Pregunta = new Pregunta();

    $_idPreg;
    if (!($_idPreg = filter_input(INPUT_POST, 'idPregunta', FILTER_VALIDATE_INT))) {
        Respoder(false, 'Error de parámetros', null);
    }
    if (!$Pregunta->get($_idPreg)) {
        Respoder(false, 'La pregunta no existe', null);
    }

    if (!isset($_FILES['audio'])) {
        Respoder(false, 'No se envió audio', null);
    }
    $fileName = $_FILES['audio']['name'];
    $fileType = $_FILES['audio']['type'];
    $fileSize = $_FILES['audio']['size'];
    $fileTemp = $_FILES['audio']['tmp_name'];
    $fileErro = $_FILES['audio']['error'];

    if ($fileErro != UPLOAD_ERR_OK) {
        Respoder(false, 'Error en la transmisión del archivo', null);
    }
    if ($fileSize <= 0) {
        Respoder(false, 'Debe indicar un documento para subir', null);
    }
    if ($fileType != 'audio/wav') {
        Respoder(false, 'El audio debe tener formato WAV', null);
    }

    $fileNewName = 'audio_' . sha1($Invitacion['idInvitacion'] . $Pregunta->idPregunta) . '.wav';
    $fileNew = $files_dir . $fileNewName;
    $fileUrl = $files_url . $fileNewName;
    if (!move_uploaded_file($fileTemp, $fileNew)) {
        Respoder(false, 'Error al guardar audio', null);
    }

    $Reespuesta->audio = $fileUrl;
    $Reespuesta->idInvitacion = $Invitacion['idInvitacion'];
    $Reespuesta->idPregunta = $Pregunta->idPregunta;

    array_push($_SESSION['Respondiendo']['Respuestas'], $Reespuesta->toArray());
    Respoder(true, 'Audio guardado', null);
}

function GuardarVideo() {
    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }
    if ($_SESSION['Usuario']['tipo'] != 'A') {
        Respoder(false, 'No tiene autorización', null);
    }
    if (!isset($_SESSION['Respondiendo'])) {
        Respoder(false, 'Debe indicar una entrevista', null);
    }

    $video = null;
    if (!($video = filter_input(INPUT_POST, 'video', FILTER_VALIDATE_URL))) {
        Respoder(false, 'Dirección del video no válido', null);
    }

    $_SESSION['Respondiendo']['video'] = $video;
    Respoder(true, 'Video guardado', null);
}

function TerminarEntrevista() {
    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }
    if ($_SESSION['Usuario']['tipo'] != 'A') {
        Respoder(false, 'No tiene autorización', null);
    }
    if (!isset($_SESSION['Respondiendo'])) {
        Respoder(false, 'Debe indicar una entrevista', null);
    }

    $Invitacion = $_SESSION['Respondiendo']['Invitacion'];
    $Preguntas = $_SESSION['Respondiendo']['Preguntas'];
    $Respuestas = $_SESSION['Respondiendo']['Respuestas'];
    $video = $_SESSION['Respondiendo']['video'];

    if (count($Respuestas) != count($Preguntas)) {
        Respoder(false, 'Falta responder algunas preguntas', null);
    }

    foreach ($Respuestas as $key => $res) {
        $encontrado = false;
        foreach ($Preguntas as $key => $pre) {
            if ($res['idPregunta'] == $pre['idPregunta']) {
                $encontrado = true;
            }
        }
        if (!$encontrado) {
            Respoder(false, 'Una respuesta no coincide con su pregunta', null);
        }
    }

    $invit = new Invitacion();
    if (!$invit->get('idInvitacion', $Invitacion['idInvitacion'])) {
        Respoder(false, 'No se encontró la invitación', null);
    }

    foreach ($Respuestas as $key => $res) {
        $rpta = new Respuesta();
        $rpta->audio = $res['audio'];
        $rpta->idInvitacion = $invit->idInvitacion;
        $rpta->idPregunta = $res['idPregunta'];

        if (!$rpta->set()) {
            Respoder(false, 'Una respuesta no se guardó', null, $rpta);
        }
    }

    $invit->respondido = true;
    $invit->video = $video;
    $invit->fchRpta = new DateTime();
    if ($invit->edit()) {
        unset($_SESSION['Respondiendo']);
        Respoder(true, 'Entrevista guardada', null);
    } else {
        Respoder(false, 'No se pudo guardar su entrevista', null, $invit);
    }
}

function CalificarInvitacion() {
    session_start();
    if (!isset($_SESSION['Usuario'])) {
        Respoder(false, 'Debe iniciar sesión', null);
    }
    if ($_SESSION['Usuario']['tipo'] != 'B') {
        Respoder(false, 'No tiene autorización', null);
    }

    $Invitacion = new Invitacion();
    $Respuestas;
    $Puntajes;

    if (!(($Invitacion->idInvitacion = filter_input(INPUT_POST, 'idInvitacion', FILTER_VALIDATE_INT)) &&
            ($Puntajes = filter_input(INPUT_POST, 'respuestas')))) {
        Respoder(false, 'Error al recibir parámetros', null);
    }

    $Puntajes = json_decode($Puntajes);
    if (is_null($Puntajes)) {
        Respoder(false, 'Error de JSON', 'No se pudo procesar el JSON recibido');
    }

    if (!$Invitacion->get('idInvitacion', $Invitacion->idInvitacion)) {
        Respoder(false, 'No se encontró la invitacion', '');
    }

    $Respuestas = (new Respuesta())->search($Invitacion->idInvitacion);

    if (count($Puntajes) != count($Respuestas)) {
        Respoder(false, 'Cantidades incorrectas', '', $Respuestas);
    }

    $rpp = array();
    foreach ($Puntajes as $keyPunt => $valPunt) {
        $encon = false;
        foreach ($Respuestas as $keyResp => $valResp) {
            if ($valResp->idRespuesta == $valPunt->idRespuesta) {
                $encon = true;
                $valResp->puntaje = $valPunt->puntaje;
                array_push($rpp, $valResp);
                break;
            }
        }
        if (!$encon) {
            Respoder(false, 'No se encontró idRespuesta: ' . $keyPunt, '');
        }
    }

    $acum = 0;
    foreach ($rpp as $key => $value) {
        $acum += $value->puntaje;
        if (!$value->edit()) {
            Respoder(false, 'Error al actualizar Rpta: ' . $value->idRespuesta, '', $value);
        }
    }

    $Invitacion->evaluado = true;
    $Invitacion->puntaje = ($acum / count($Respuestas));
    $Invitacion->fchEval = new DateTime();

    if ($Invitacion->edit()) {
        Respoder(true, 'Respuestas calificadas', '');
    } else {
        Respoder(false, 'Error al actualizar invitacion: ', '');
    }
}

init();
