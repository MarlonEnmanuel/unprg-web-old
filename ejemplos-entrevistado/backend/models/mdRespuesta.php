<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdRespuesta
 *
 * @author Enmanuel
 */
require_once 'absModel.php';

class Respuesta extends absModel{
    
    public $idRespuesta;
    public $audio;
    public $idInvitacion;
    public $idPregunta;
    public $puntaje;
    public $Pregunta;
    
    public function delete() {
        
    }

    public function edit() {
        $sql = "UPDATE respuesta SET puntaje=? WHERE idRespuesta=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('ii',  $this->puntaje, $this->idRespuesta);
            if($stmt->execute()){
                $this->md_estado = true;
                $this->md_mensaje = "Usuario actualizado"; 
            }else{
                $this->md_estado = false;
                $this->md_mensaje = 'Error al actuaizar "respuesta"'; 
                $this->md_detalle = $stmt->error;
            }
        }
        return $this->md_estado;
    }

    public function get($idRespuesta='') {
        if($idRespuesta==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar idRespuesta";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idRespuesta, audio, idInvitacion, idPregunta, puntaje 
                FROM respuesta 
                WHERE idRespuesta=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('i',$idRespuesta);
            $stmt->execute();
            $stmt->bind_result(
                    $this->idRespuesta,
                    $this->audio,
                    $this->idInvitacion,
                    $this->idPregunta,
                    $this->puntaje
                    );
            if($stmt->fetch()){
                $this->md_estado = true;
                $this->md_mensaje = "Respuesta obtenida";
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Respuesta no econtrada";
            }
        }
        return $this->md_estado;
    }

    public function search($idInvitacion='') {
        if($idInvitacion==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar idInvitacion para buscar";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idRespuesta, audio, idInvitacion, idPregunta, puntaje 
                FROM respuesta 
                WHERE idInvitacion=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('i',$idInvitacion);
            $stmt->execute();
            $stmt->bind_result(
                    $_idRespuesta,
                    $_audio,
                    $_idInvitacion,
                    $_idPregunta,
                    $_puntaje
                    );
            $list = array();
            while($stmt->fetch()){
                $res = new Respuesta();
                $res->idRespuesta = $_idRespuesta;
                $res->audio = $_audio;
                $res->idInvitacion = $_idInvitacion;
                $res->idPregunta = $_idPregunta;
                $res->puntaje = $_puntaje;
                array_push($list, $res);
            }
            $this->md_estado = true;
            $this->md_mensaje = "Respuesta obtenida";
            return $list;
        }
        return $this->md_estado;
    }

    public function set() {
        $sql = "INSERT INTO respuesta 
                    (audio, idInvitacion, idPregunta) 
                VALUES (?, ?, ?)";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('sii',
                    $this->audio,
                    $this->idInvitacion,
                    $this->idPregunta
                    );
            if($stmt->execute()){
                $this->idPregunta = $stmt->insert_id;
                $this->md_estado = true;
                $this->md_mensaje = "Pregunta insertada";
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Error al insertar pregunta";
                $this->md_detalle = $stmt->error;
            }
        }
        return $this->md_estado;
    }

}

