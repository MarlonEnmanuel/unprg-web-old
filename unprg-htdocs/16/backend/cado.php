<?php

require_once 'config.php';

class Cado{

	public $mysqli;

	public function cnn_open(){
        $this->mysqli = new mysqli( config::$db_host,
                                    config::$db_user,
                                    config::$db_pass,
                                    config::$db_name,
                                    config::$db_port);
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
    
    public function cnn_close(){
        $this->mysqli->close();
    }

}

?>