<?php

require_once "abstractModel.php";

class Aviso extends abstractModel{

	public $fchReg;
	public $texto;
	public $emergente;
	public $visible;
	public $estado;
	public $bloqueado;
	public $idArchivo;
	public $idUsuario;

	public function __construct(&$mysqli, $id=null){
		parent::__construct($mysqli, $id);
	}

	public function get(){

	}

    public function set(){

    }

    public function edit(){

    }

    public function delete(){

    }

}

?>