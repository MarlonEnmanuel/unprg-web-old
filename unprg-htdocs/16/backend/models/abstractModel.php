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
    
    public final function toJSON($campos=[]){
        return json_encode($this->toArray($campos));
    }
    
    public final function toArray($campos=[]){
        $filtrar = count($campos)>0;
        $model = get_object_vars($this);
        $array = array();
        foreach ($model as $campo=>$valor){
            if($campo!='mysqli' && substr($campo,0,3)!='md_'){
                if($filtrar){
                    if(in_array($campo, $campos)){
                        $array[$campo] = $valor;
                    }
                }else{
                    $array[$campo] = $valor;
                }
            }
        }
        return $array;
    }
}