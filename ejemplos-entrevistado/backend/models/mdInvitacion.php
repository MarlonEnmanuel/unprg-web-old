<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdInvitacion
 *
 * @author Enmanuel
 */
require_once 'absModel.php';

class Invitacion extends absModel {
    
    public $idInvitacion;
    public $email;
    public $nombres;
    public $apellidos;
    public $idUsuario;
    public $idEntrevista;
    public $respondido;
    public $video;
    public $fchRpta;
    public $evaluado;
    public $puntaje;
    public $fchEval;
    public $Respuestas;
    
    public static $fchFtoSql = 'Y-m-d H:i:s';
    
    public function delete() {
        
    }

    public function edit() {
        if(isset($this->idInvitacion)){
            $sql = "UPDATE invitacion SET 
                        email=?, 
                        nombres=?, 
                        apellidos=?, 
                        idUsuario=?, 
                        idEntrevista=?, 
                        respondido=?, 
                        video=?, 
                        fchRpta=?, 
                        evaluado=?, 
                        puntaje=?, 
                        fchEval=? 
                    WHERE idInvitacion=?";
            if($this->cnn_open()){
                $stmt = $this->mysqli->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('sssiiissiiis',
                        $this->email,
                        $this->nombres,
                        $this->apellidos,
                        $this->idUsuario,
                        $this->idEntrevista,
                        intval($this->respondido),
                        $this->video,
                        ($this->fchRpta)?$this->fchRpta->format(Invitacion::$fchFtoSql):null,
                        intval($this->evaluado),
                        $this->puntaje,
                        ($this->fchEval)?$this->fchEval->format(Invitacion::$fchFtoSql):null,
                        $this->idInvitacion
                        );
                if($stmt->execute()){
                    $this->md_estado = true;
                    $this->md_mensaje = "Invitación actualizada";
                }else{
                    $this->md_estado = false;
                    $this->md_mensaje = "Error al actualizar invitación";
                    $this->md_detalle = $stmt->error;
                }
            }
        }else{
            $this->md_estado = false;
            $this->md_mensaje = "La invitación no tiene id";
        }
        return $this->md_estado;
    }

    public function get($campo = '', $valor = '') {
        if($campo=='' || $valor==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar un campo y un valor para buscar";
            return $this->md_estado;
        }
        if($campo!='idInvitacion' && $campo!='codigo' ){
            $this->md_estado = false;
            $this->md_mensaje = "Campo no válido para buscar";
            return $this->md_estado;
        }
        if($campo=='codigo'){
            $campo = 'sha1(idInvitacion)';
            if( strlen($valor)!=40 ){
                $this->md_estado = false;
                $this->md_mensaje = "El codigo debe tener 40 caracteres";
                return $this->md_estado;
            }
        }
        
        $sql = "SELECT 
                    idInvitacion, email, nombres, apellidos, idUsuario, idEntrevista, respondido, video, fchRpta, evaluado, puntaje, fchEval 
                FROM invitacion 
                WHERE $campo=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('s',$valor);
            $stmt->execute();
            $stmt->bind_result(
                    $this->idInvitacion,
                    $this->email,
                    $this->nombres,
                    $this->apellidos,
                    $this->idUsuario,
                    $this->idEntrevista,
                    $this->respondido,
                    $this->video,
                    $this->fchRpta,
                    $this->evaluado,
                    $this->puntaje,
                    $this->fchEval
                    );
            if($stmt->fetch()){
                $this->fchRpta = DateTime::createFromFormat(Invitacion::$fchFtoSql, $this->fchRpta);
                $this->fchEval = DateTime::createFromFormat(Invitacion::$fchFtoSql, $this->fchEval);
                $this->md_estado = true;
                $this->md_mensaje = "Invitación obtenida";
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Invitación no econtrada";
            }
        }
        return $this->md_estado;
    }
    
    public function getEmailEntrevista($email, $idEntrevista) {
        if(!(isset($email) && isset($idEntrevista))){
            $this->md_estado = false;
            $this->md_mensaje = "Error de parámetros";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idInvitacion, email, nombres, apellidos, idUsuario, idEntrevista, respondido, video, fchRpta, evaluado, puntaje, fchEval 
                FROM invitacion 
                WHERE email=? AND idEntrevista=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('si',$email,$idEntrevista);
            $stmt->execute();
            $stmt->bind_result(
                    $this->idInvitacion,
                    $this->email,
                    $this->nombres,
                    $this->apellidos,
                    $this->idUsuario,
                    $this->idEntrevista,
                    $this->respondido,
                    $this->video,
                    $this->fchRpta,
                    $this->evaluado,
                    $this->puntaje,
                    $this->fchEval
                    );
            if($stmt->fetch()){   
                $this->fchRpta = DateTime::createFromFormat(Invitacion::$fchFtoSql, $this->fchRpta);
                $this->fchEval = DateTime::createFromFormat(Invitacion::$fchFtoSql, $this->fchEval);
                $this->md_estado = true;
                $this->md_mensaje = "Invitación obtenida";
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Invitación no econtrada";
            }
        }
        return $this->md_estado;
    }

    public function search($campo='', $valor='') {
        if($campo=='' || $valor==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar un campo y un valor para buscar";
            return $this->md_estado;
        }
        if($campo!='idUsuario' && $campo!='idEntrevista' ){
            $this->md_estado = false;
            $this->md_mensaje = "Campo no válido para buscar";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idInvitacion, email, nombres, apellidos, idUsuario, idEntrevista, respondido, video, fchRpta, evaluado, puntaje, fchEval 
                FROM invitacion 
                WHERE $campo=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('s',$valor);
            $stmt->execute();
            $stmt->bind_result(
                    $p_idInvitacion,
                    $p_email,
                    $p_nombres,
                    $p_apellidos,
                    $p_idUsuario,
                    $p_idEntrevista,
                    $p_respondido,
                    $p_video,
                    $p_fchRpta,
                    $p_evaluado,
                    $p_puntaje,
                    $p_fchEval
                    );
            $list = array();
            while($stmt->fetch()){            
                $iv = new Invitacion();
                $iv->idInvitacion = $p_idInvitacion;
                $iv->email = $p_email;
                $iv->nombres = $p_nombres;
                $iv->apellidos = $p_apellidos;
                $iv->idUsuario = $p_idUsuario;
                $iv->idEntrevista = $p_idEntrevista;
                $iv->respondido = $p_respondido;
                $iv->video = $p_video;
                $iv->fchRpta = DateTime::createFromFormat(Invitacion::$fchFtoSql, $p_fchRpta);
                $iv->evaluado = $p_evaluado;
                $iv->puntaje = $p_puntaje;
                $iv->fchEval = DateTime::createFromFormat(Invitacion::$fchFtoSql, $p_fchEval);
                array_push($list, $iv);
            }
            $this->md_estado = true;
            $this->md_mensaje = "Invitaciónes obtenidas";
            return $list;
        }
        return $this->md_estado;
    }
    
    public function searchEmail($email='') {
        if($email==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar un email para buscar";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idInvitacion, email, nombres, apellidos, idUsuario, idEntrevista, respondido, video, fchRpta, evaluado, puntaje, fchEval 
                FROM invitacion 
                WHERE email=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('s',$email);
            $stmt->execute();
            $stmt->bind_result(
                    $p_idInvitacion,
                    $p_email,
                    $p_nombres,
                    $p_apellidos,
                    $p_idUsuario,
                    $p_idEntrevista,
                    $p_respondido,
                    $p_video,
                    $p_fchRpta,
                    $p_evaluado,
                    $p_puntaje,
                    $p_fchEval
                    );
            $list = array();
            while($stmt->fetch()){            
                $iv = new Invitacion();
                $iv->idInvitacion = $p_idInvitacion;
                $iv->email = $p_email;
                $iv->nombres = $p_nombres;
                $iv->apellidos = $p_apellidos;
                $iv->idUsuario = $p_idUsuario;
                $iv->idEntrevista = $p_idEntrevista;
                $iv->respondido = $p_respondido;
                $iv->video = $p_video;
                $iv->fchRpta = DateTime::createFromFormat(Invitacion::$fchFtoSql, $p_fchRpta);
                $iv->evaluado = $p_evaluado;
                $iv->puntaje = $p_puntaje;
                $iv->fchEval = DateTime::createFromFormat(Invitacion::$fchFtoSql, $p_fchEval);
                array_push($list, $iv);
            }
            $this->md_estado = true;
            $this->md_mensaje = "Invitaciónes obtenidas";
            return $list;
        }
        return $this->md_estado;
    }

    public function set() {
        $sql = "INSERT INTO invitacion 
                    (email, nombres, apellidos, idUsuario, idEntrevista) 
                VALUES (?, ?, ?, ?, ?)";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('sssii',
                    $this->email,
                    $this->nombres,
                    $this->apellidos,
                    $this->idUsuario,
                    $this->idEntrevista
                    );
            if($stmt->execute()){
                $this->idInvitacion = $stmt->insert_id;
                $this->md_estado = true;
                $this->md_mensaje = "Invitación insertada";
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Error al insertar invitación";
                $this->md_detalle = $stmt->error;
            }
        }
        return $this->md_estado;
    }
    
}