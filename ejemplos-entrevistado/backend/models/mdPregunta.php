<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdPregunta
 *
 * @author Enmanuel
 */
require_once 'absModel.php';

class Pregunta extends absModel{
    
    public $idPregunta;
    public $premisa;
    public $tiempo;
    public $idEntrevista;
    
    public function delete() {
        
    }

    public function edit() {
        
    }

    public function get($idPregunta='') {
        if($idPregunta==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar un idPregunta para buscar";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idPregunta, premisa, tiempo, idEntrevista 
                FROM pregunta 
                WHERE idPregunta=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('i',$idPregunta);
            $stmt->execute();
            $stmt->bind_result(
                    $this->idPregunta,
                    $this->premisa,
                    $this->tiempo,
                    $this->idEntrevista
                    );
            if($stmt->fetch()){            
                $this->md_estado = true;
                $this->md_mensaje = "Pregunta obtenida";
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Pregunta no econtrada";
            }
        }
        return $this->md_estado;
    }

    public function search($idEntrevista='') {
        if($idEntrevista==''){
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar un idEntrevista para buscar";
            return $this->md_estado;
        }
        
        $sql = "SELECT 
                    idPregunta, premisa, tiempo, idEntrevista 
                FROM pregunta 
                WHERE idEntrevista=?";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('i',$idEntrevista);
            $stmt->execute();
            $stmt->bind_result(
                    $_idPregunta,
                    $_premisa,
                    $_tiempo,
                    $_idEntrevista
                    );
            $list = array();
            while($stmt->fetch()){
                $pre = new Pregunta();
                $pre->idPregunta = $_idPregunta;
                $pre->premisa = $_premisa;
                $pre->tiempo = $_tiempo;
                $pre->idEntrevista = $_idEntrevista;
                array_push($list, $pre);
            }
            $this->md_estado = true;
            $this->md_mensaje = "Preguntas obtenidas";
            return $list;
        }
        return $this->md_estado;
    }

    public function set() {
        $sql = "INSERT INTO pregunta 
                    (premisa, tiempo, idEntrevista) 
                VALUES (?, ?, ?)";
        if($this->cnn_open()){
            $stmt = $this->mysqli->stmt_init();
            $stmt->prepare($sql);
            $stmt->bind_param('sii',
                    $this->premisa,
                    $this->tiempo,
                    $this->idEntrevista
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