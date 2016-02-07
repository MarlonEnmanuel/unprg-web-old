<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdEntrevista
 *
 * @author Enmanuel
 */
require_once 'absModel.php';

class Entrevista extends absModel{
    
    public $idEntrevista;
    public $titulo;
    public $descripcion;
    public $fchInicio;
    public $fchFin;
    public $idUsuario;
    
    public static $fchFtoSql = 'Y-m-d H:i:s';
    public static $fchFtoMail = 'j/n/Y';
    
    public function delete() {
        
    }

    public function edit() {
        
    }

    public function get($idEntrevista = '') {
        if($idEntrevista==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar idEntrevista";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idEntrevista,titulo,descripcion,fchInicio,fchFin,idUsuario 
                FROM entrevista 
                WHERE idEntrevista=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('i',$idEntrevista);
            $stmt->execute();
            $stmt->bind_result(
                    $this->idEntrevista,
                    $this->titulo,
                    $this->descripcion,
                    $this->fchInicio,
                    $this->fchFin,
                    $this->idUsuario
                    );
            if($stmt->fetch()){
                $this->fchInicio = new DateTime($this->fchInicio);
                $this->fchFin = new DateTime($this->fchFin);
            
                $this->md_estado = true;
                $this->md_mensaje = "Entrevista obtenida";
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Entrevista no econtrada";
            }
        }
        return $this->md_estado;
    }

    public function search($idUsuario = '', $disponibles = false) {
        if($idUsuario==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar idUsuario para buscar";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idEntrevista,titulo,descripcion,fchInicio,fchFin,idUsuario 
                FROM entrevista 
                WHERE idUsuario=? ";
        if($disponibles){
            $sql .= " AND (now() BETWEEN fchInicio AND fchFin)";
        }
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('i',$idUsuario);
            $stmt->execute();
            
            $stmt->bind_result(
                    $br_id,
                    $br_titulo,
                    $br_descripcion,
                    $br_fchInicio,
                    $br_fchFin,
                    $br_idUsuario
                    );
            
            $list = array();
            while($stmt->fetch()){
                $e = new Entrevista();
                $e->idEntrevista = $br_id;
                $e->titulo = $br_titulo;
                $e->descripcion = $br_descripcion;
                $e->fchInicio = new DateTime($br_fchInicio);
                $e->fchFin = new DateTime($br_fchFin);
                $e->idUsuario = $br_idUsuario;
                array_push($list, $e);
            }
            $this->md_estado = true;
            $this->md_mensaje = "Entrevista obtenida";
            return $list;
        }
        return $this->md_estado;
    }

    public function set() {
        $sql = "INSERT INTO entrevista 
                    (titulo, descripcion, fchInicio, fchFin, idUsuario) 
                VALUES (?, ?, ?, ?, ?)";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('ssssi',
                    $this->titulo,
                    $this->descripcion,
                    $this->fchInicio->format(Entrevista::$fchFtoSql),
                    $this->fchFin->format(Entrevista::$fchFtoSql),
                    $this->idUsuario
                    );
            if($stmt->execute()){
                $this->idEntrevista = $stmt->insert_id;
                $this->md_estado = true;
                $this->md_mensaje = "Entrevista insertada";
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Error al insertar entrevista";
                $this->md_detalle = $stmt->error;
            }
        }
        return $this->md_estado;
    }
    
}