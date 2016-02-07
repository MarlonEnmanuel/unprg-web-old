<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of absModel
 *
 * @author Enmanuel
 */
abstract class absModel {
    
    private static $db_host = "localhost";
    private static $db_user = "root";
    private static $db_pass = "";
    private static $db_name = "entrevistado";
    private static $db_port = "3306";
    
//    private static $db_host = "localhost";
//    private static $db_user = "syscomys_marlon";
//    private static $db_pass = "1s2y3s4c5o6m7y8s9";
//    private static $db_name = "syscomys_empresa";
//    private static $db_port = "3306";
    
    protected $mysqli;
    
    public $md_estado;
    public $md_mensaje;
    public $md_detalle;
    
    abstract public function get();
    abstract public function set();
    abstract public function edit();
    abstract public function delete();
    abstract public function search();
    
    protected function cnn_open(){
        $this->mysqli = new mysqli( absModel::$db_host,
                                    absModel::$db_user,
                                    absModel::$db_pass,
                                    absModel::$db_name,
                                    absModel::$db_port);
        if($this->mysqli->connect_errno){
            $this->md_estado = false;
            $this->md_mensaje = "Error al conectar a a BD";
            $this->md_detalle = $this->mysqli->connect_error;
            return false;
        }else{
            $this->md_estado = true;
            $this->md_mensaje = "Conección establecida";
            return true;
        }
    }
    
    protected function cnn_close(){
        $this->mysqli->close();
    }
    
    public function toJSON(){
        return json_encode($this->toArray());
    }
    
    public function toArray(){
        $a1 = get_object_vars($this);
        $a2 = array();
        foreach ($a1 as $c=>$v){
            if($c!='mysqli' && substr($c,0,3)!='md_' && substr($c,0,3)!='db_'){
                $a2[$c] = $v;
            }
        }
        return $a2;
    }
}
