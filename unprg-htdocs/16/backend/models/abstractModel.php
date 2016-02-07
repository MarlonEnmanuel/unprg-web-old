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
require_once '../config.php';

abstract class abstractModel {
    
    protected $mysqli;      //Mysqli cado para mysql
    
    public $md_estado;      //Estado del modelo
    public $md_mensaje;     //Mensaje para un procedimiento
    public $md_detalle;     //Detalle del procedimiento

    public $id;             //Todo modelo tiene un id

    /**
    * Constructor para cada modelo
    *
    * @param $mysqli Conección pasado por referencia
    * @param $id Identificador del modelo
    */
    public function __construct(&$mysqli, $id=null){
        $this->mysqli = $mysqli;
        if(isset($id)) $this->id = $id;
    }
    
    abstract public function get();
    abstract public function set();
    abstract public function edit();
    abstract public function delete();
    
    public function toJSON(){
        return json_encode($this->toArray());
    }
    
    public function toArray(){
        $a1 = get_object_vars($this);
        $a2 = array();
        foreach ($a1 as $c=>$v){
            if($c!='mysqli' && substr($c,0,3)!='md_'){
                $a2[$c] = $v;
            }
        }
        return $a2;
    }
}
