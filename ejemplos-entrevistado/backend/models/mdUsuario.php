<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Enmanuel
 */
require_once 'absModel.php';

class Usuario extends absModel{
    
    public $idUsuario;
    public $email;
    public $pass;
    public $dni;
    public $nombres;
    public $apellidos;
    public $foto;
    public $fchReg;
    public $tipo;
    public $documento;
    
    public function delete() {
        
    }

    public function edit() {
        if(isset($this->idUsuario)){
            $sql = "UPDATE usuario SET 
                        email=?, 
                        pass=?, 
                        dni=?, 
                        nombres=?, 
                        apellidos=?, 
                        tipo=?,
                        foto=?,
                        documento=? 
                    WHERE idUsuario=?";
            if($this->cnn_open()){
                $stmt = $this->mysqli->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('ssisssssi',
                        $this->email,
                        $this->pass,
                        $this->dni,
                        $this->nombres,
                        $this->apellidos,
                        $this->tipo,
                        $this->foto,
                        $this->documento,
                        $this->idUsuario
                        );
                if($stmt->execute()){
                    $this->md_estado = true;
                    $this->md_mensaje = "Usuario actualizado";
                }else{
                    $this->md_estado = false;
                    $this->md_mensaje = "Error al actualizar usuario";
                    $this->md_detalle = $stmt->error;
                }
            }
        }else{
            $this->md_estado = false;
            $this->md_mensaje = "El Usuario no tiene id";
        }
        return $this->md_estado;
    }

    public function get($campo='',$valor='') {
        if($valor!='' && $campo!=''){
            if($campo=='idUsuario'||$campo=='email'||$campo=='dni'){
                $sql =  "SELECT "
                       .    "idUsuario,email,pass,dni,nombres,apellidos,tipo,fchReg,foto,documento "
                       ."FROM usuario where $campo=?";
                if($this->cnn_open()){
                    $stmt = $this->mysqli->stmt_init();
                    $stmt->prepare($sql);
                    $stmt->bind_param('s',$valor);
                    $stmt->execute();
                    $stmt->bind_result(
                            $this->idUsuario,
                            $this->email,
                            $this->pass,
                            $this->dni,
                            $this->nombres,
                            $this->apellidos,
                            $this->tipo,
                            $this->fchReg,
                            $this->foto,
                            $this->documento
                            );
                    if($stmt->fetch()){
                        $this->md_estado = true;
                        $this->md_mensaje = "Usuario obtenido";
                    }else{
                        $this->md_estado = false;
                        $this->md_mensaje = "Usuario no encontrado";
                    }
                }
            }else{
                $this->md_estado = false;
                $this->md_mensaje = "Debe proporcionar un campo válido para buscar";
            }
        }else{
            $this->md_estado = false;
            $this->md_mensaje = "Debe proporcionar un campo y un valor para buscar";
        }
        return $this->md_estado;
    }

    public function set() {
        if(isset($this->idUsuario)){
            $this->md_estado = false;
            $this->md_mensaje = "El Usuario ya tiene id";
        }else{
            $sql =  "INSERT INTO "
                   ."   usuario (email,pass,dni,nombres,apellidos,tipo,foto,documento) "
                   ."VALUES (?,?,?,?,?,?,?,?)";
            if($this->cnn_open()){
                $stmt = $this->mysqli->stmt_init();
                $stmt->prepare($sql);
                $stmt->bind_param('ssssssss',
                        $this->email,
                        $this->pass,
                        $this->dni,
                        $this->nombres,
                        $this->apellidos,
                        $this->tipo,
                        $this->foto,
                        $this->documento
                        );
                if($stmt->execute()){
                    $this->idUsuario = $stmt->insert_id;
                    $this->md_estado = true;
                    $this->md_mensaje = "Usuario insertado";
                }else{
                    $this->md_estado = false;
                    $this->md_mensaje = "Error al insertar usuario";
                    $this->md_detalle = $stmt->error;
                }
            }
        }
        return $this->md_estado;
    }

    public function search() {
        
    }

}