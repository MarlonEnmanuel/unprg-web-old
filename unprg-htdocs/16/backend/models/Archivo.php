<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
require_once config::getRequirePath('backend/models/abstractModel.php');

class Archivo extends abstractModel{

    public $nombre;
    public $type;
    public $rutaArch;
    public $fchReg;

    public function __construct(&$mysqli, $id=null){
        parent::__construct($mysqli, $id);
    }

    public function get(){
        if($this->mysqli->errno) return false;  //verificar error en el cado

        if(!isset($this->id)){                  //debe tener id para buscar
            $this->md_mensaje = "Debe indicar un id para buscar";
            return $this->md_estado = false;
        }

        $sql = "select * from archivo where idArchivo=?";
        $stmt = $this->mysqli->stmt_init(); //se inicia la consulta preparada
        $stmt->prepare($sql);               //se arma la consulta preparada
        $stmt->bind_param('i', $this->id);  //se vinculan los parámetros
        $stmt->execute();                   //se ejecuta la consulta
        $stmt->bind_result(                 //se vinculan las variables que obtendrán los resultados
            $this->id,
            $this->nombre,
            $this->type,
            $this->rutaArch,
            $this->fchReg
            );
        if($stmt->fetch()){
            $this->fchReg = DateTime::createFromFormat(config::$date_sql, $this->fchReg); //se convierte de string a DateTime
            $this->md_estado = true;                //estado del procedimiento: correcto
            $this->md_mensaje = "Archivo obtenido"; //mensaje del procedimiento
        }else{
            $this->md_estado = false;               //estado del procedimiento: fallido
            $this->md_mensaje = "Error al obtener archivo";//mensaje del procedimiento
            $this->md_detalle = $stmt->error;       //detalle del procedimiento
        }
        return $this->md_estado;
    }

    public function set(){
        if($this->mysqli->errno) return false;

        if(isset($this->id)){   //si tiene ID entonces ya existe en la BD
            $this->md_mensaje = "El usuario ya tiene id";
            return $this->md_estado = false;
        }

        $sql = "INSERT INTO archivo (nombre, type, rutaArch) VALUES (?, ?, ?)";
        $stmt = $this->mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param('sss',
            $this->nombre,
            $this->type,
            $this->rutaArch
            );
        if($stmt->execute()){
            $this->id = $stmt->insert_id;
            $this->md_estado = true;
            $this->md_mensaje = "Archivo insertado";
        }else{
            $this->md_estado = false;
            $this->md_mensaje = "Error al insertar archivo";
            $this->md_detalle = $stmt->error;
        }
        return $this->md_estado;
    }

    public function edit(){
        if($this->mysqli->errno) return false;

        if(!isset($this->id)){  //debe tener id para poder editar
            $this->md_mensaje = "Debe indicar un id para buscar";
            return $this->md_estado = false;
        }

        $sql = "UPDATE archivo SET 
                    nombre=?, 
                WHERE idArchivo=?";
        $stmt = $this->mysqli->stmt_init();
        $stmt->prepare($sql);
        $stmt->bind_param('si',
            $this->nombre,
            $this->id
            );
        if($stmt->execute()){
            $this->md_estado = true;
            $this->md_mensaje = "Archivo actualizado";
        }else{
            $this->md_estado = false;
            $this->md_mensaje = "Error al actualizar archivo";
            $this->md_detalle = $stmt->error;
        }
        return $this->md_estado;
    }

    public function delete(){
        
    }

}

?>