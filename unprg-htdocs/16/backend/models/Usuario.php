<?php

require_once "abstractModel.php";

class Usuario extends abstractModel{

	public $email;
	public $password;
	public $nombres;
	public $apellidos;
	public $oficina;
	public $fchReg;
	public $permisos;

	public function __construct(&$mysqli, $id=null){
		parent::__construct($mysqli, $id);
	}

	public function get(){
		if($this->mysqli->errno) return false;

		$sql = "select * from usuario where idUsuario=?";
		$stmt = $this->mysqli->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param('i', $this->id);
		$stmt->execute();
		$stmt->bind_result(
			$this->id,
			$this->email,
			$this->password,
			$this->nombres,
			$this->apellidos,
			$this->oficina,
			$this->fchReg,
			$this->permisos
			);
		if($stmt->fetch()){
            $this->md_estado = true;
            $this->md_mensaje = "Usuario obtenido";
        }else{
            $this->md_estado = false;
            $this->md_mensaje = "Error al obtener usuario";
            $this->md_detalle = $stmt->error;
        }
        return $this->md_estado;
	}

	public function getEmail($email){
		if($this->mysqli->errno) return false;

		$sql = "select * from usuario where email=?";
		$stmt = $this->mysqli->stmt_init();
		$stmt->prepare($sql);
		$stmt->bind_param('i', $email);
		$stmt->execute();
		$stmt->bind_result(
			$this->id,
			$this->email,
			$this->password,
			$this->nombres,
			$this->apellidos,
			$this->oficina,
			$this->fchReg,
			$this->permisos
			);
		if($stmt->fetch()){
            $this->md_estado = true;
            $this->md_mensaje = "Usuario obtenido";
        }else{
            $this->md_estado = false;
            $this->md_mensaje = "Error al obtener usuario";
            $this->md_detalle = $stmt->error;
        }
        return $this->md_estado;
	}

    public function set(){

    }

    public function edit(){

    }

    public function delete(){

    }

}

//Probando el funcionamiento del modelo
require_once "../config.php";
$mysqli = config::getMysqli();

$user = new Usuario($mysqli, 1);

$user->get();
echo $user->toJSON();

?>