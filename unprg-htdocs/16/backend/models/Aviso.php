<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
require_once config::getRequirePath('backend/models/abstractModel.php');
require_once 'Archivo.php';

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
		if($this->mysqli->errno) return false;  //verificar error en el cado

        if(!isset($this->id)){                  //debe tener id para buscar
            $this->md_mensaje = "Debe indicar un id para buscar";
            return $this->md_estado = false;
        }
        $sql = "select * from Aviso where idAviso=?";
        $stmt = $this->mysqli->stmt_init(); //se inicia la consulta preparada
        $stmt->prepare($sql);               //se arma la consulta preparada
        $stmt->bind_param('i', $this->id);  //se vinculan los parámetros
        $stmt->execute();                   //se ejecuta la consulta
        $stmt->bind_result(    
        	$this->idAviso,
        	$this->fchReg,
        	$this->texto,
        	$this->emergente,
        	$this->visible,
        	$this->estado,
        	$this->bloqueado,
        	$this->idArchivo,
        	$this->idUsuario
        	);
        if($stmt->fetch()){
            $this->fchReg = DateTime::createFromFormat(config::$date_sql, $this->fchReg); //se convierte de string a DateTime
            $this->md_estado = true;                //estado del procedimiento: correcto
            $this->md_mensaje = "Aviso obtenido"; //mensaje del procedimiento
        }else{
            $this->md_estado = false;               //estado del procedimiento: fallido
            $this->md_mensaje = "Error al obtener Aviso";//mensaje del procedimiento
            $this->md_detalle = $stmt->error;       //detalle del procedimiento
        }
        return $this->md_estado;
	}

	public function searchVisible(){
		if($this->mysqli->errno) return false; //verificar error en el cado

		$sql = "select * from aviso where visible=? order by fchReg desc";

		$stmt = $this->mysqli->stmt_init();
		$stmt->prepare($sql);
		$vis=1;
		$stmt->bind_param('i', $vis);
		$stmt->execute();
		$stmt->bind_result(
			$_id,
			$_fchReg,
			$_texto,
			$_emergente,
			$_visible,
			$_estado,
			$_bloqueado,
			$_idArchivo,
			$_idUsuario
			);
		$list=array();
		
		while ($stmt->fetch()) {
			$avi=new Aviso($this->mysqli);
			$avi->id 	    = $_id;
			$avi->fchReg 	= DateTime::createFromFormat(config::$date_sql, $_fchReg);
			$avi->texto 	= $_texto;
			$avi->emergente = $_emergente;
			$avi->visible 	= $_visible;
			$avi->estado 	= $_estado;
			$avi->bloqueado = $_bloqueado;
			$avi->idArchivo = $_idArchivo;
			$avi->idUsuario = $_idUsuario;
			array_push($list, $avi);
		}

        return $list;
	}

    public function set(){

    }

    public function edit(){

    }

    public function delete(){

    }

}

?>