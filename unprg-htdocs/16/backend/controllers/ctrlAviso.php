<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
require_once config::getRequirePath('backend/controllers/abstractController.php');
require_once config::getRequirePath('backend/models/Aviso.php');
require_once config::getRequirePath('backend/models/Archivo.php');

class ctrlAviso extends abstractController {

    protected function init($accion){
        
        if($accion == 'getVisibles'){   //acción del controlador
            $this->getVisibles();

        }elseif($accion == 'nuevoAviso'){         //acción del controlador
            $this->nuevoAviso();

        }elseif($accion == ''){         //acción del controlador


        }elseif($accion == ''){         //acción del controlador


        }else{                          //responde cuando la acción no corresponde a ningun controlador
            $this->responder(false, "Acción no soportada");
        }
    }

    protected function getVisibles() {
        $mysqli = $this->getMysqli();
        
        $aux = new Aviso($mysqli);
        $lista = $aux->searchVisible();
        $avisos = array();

        foreach ($lista as $key => $aviso) {
            $archivo = new Archivo($mysqli,$aviso->idArchivo);
            $archivo->get();
            $arrayAviso = array(
                'id'        => $aviso->id,
                'fecha'     => $aviso->fchReg->format(config::$date_aviso),
                'destacado' => $aviso->destacado,
                'emergente' => $aviso->emergente,
                'texto'     => $aviso->texto
            );
            if($archivo->type == 'img'){
                $arrayAviso['img'] = config::getPath(false, $archivo->rutaArch);
                $arrayAviso['nombre'] = $archivo->nombre;
            }elseif($archivo->type == 'doc'){
                $arrayAviso['doc'] = config::getPath(false, $archivo->rutaArch);
                $arrayAviso['nombre'] = $archivo->nombre;
            }elseif($archivo->type == 'link'){
                $arrayAviso['img'] = config::getPath(false, $archivo->rutaArch);
                $arrayAviso['link'] = $archivo->nombre;
            }
            $avisos[$key] = $arrayAviso;
        }

        $this->responder(true, 'Avisos visible', '', $avisos);
    }

    protected function nuevoAviso(){
        $Usuario = $this->checkAccess('aviso');

        $ops = array(
            'tipo' => 'string',
            'descripcion' => array('string', 12, null),
            'destacado' => 'boolean',
            'emergente' => 'boolean',
            'visible' => 'boolean',
            'estado' => 'boolean',
            'nombre' => array('string',5,45)
        );

        $type = filter_input(INPUT_POST, 'tipo');
        if($type==='link'){
            $ops['nombre'] = 'url';
        }else{
            if( $type!=='img' && $type!=='doc' ) $this->responder(false, 'Tipo de aviso inválido');
        }

        $file; $ipts = $this->getFilterInputs('post', $ops);
        if($type==='doc'){
            $file = $this->getFileUpload('archivo', array('application/pdf'));
        }else{
            $file = $this->getFileUpload('archivo', array('image/jpeg','image/jpg','image/png'));
        }

        //Abrir coneccion en modo NO autoconfirmado
        $mysqli = $this->getMysqli();
        
        $mysqli->autocommit(false);

        //Creando el archivo
        $archivo = new Archivo($mysqli);
        $archivo->nombre    = $ipts['nombre'];
        $archivo->type      = $type;
        $archivo->rutaArch  = '';

        if(!$archivo->set()) { //Insertar archivo
            $this->responder(false, 'No se pudo insertar archivo', $archivo->md_detalle, null, $mysqli);
        }

        //Crear el nombre a partir del id del archivo
        $nombre = md5($archivo->id).'.'.substr(strrchr($file['type'], "/"), 1);

        //Actualizar ruta del archivo
        $archivo->rutaArch = config::$path_avisos.$nombre;
        if(!$archivo->edit()) {
            $this->responder(false, 'No se pudo insertar archivo (ruta)', $archivo->md_detalle, null, $mysqli);
        }

        //Creando el aviso
        $aviso = new Aviso($mysqli);
        $aviso->texto       = $ipts['descripcion'];
        $aviso->destacado   = $ipts['destacado'];
        $aviso->emergente   = $ipts['emergente'];
        $aviso->visible     = $ipts['visible'];
        $aviso->estado      = $ipts['estado'];
        $aviso->bloqueado   = false;
        $aviso->idArchivo   = $archivo->id;
        $aviso->idUsuario   = $Usuario['id'];

        if(!$aviso->set()) { //Insertando el aviso
            $this->responder(false, "No se pudo guardar el aviso", $aviso->md_detalle, null, $mysqli);
        }

        $rutaNueva = $_SERVER['DOCUMENT_ROOT'].config::getPath(false, config::$path_avisos.$nombre);
        if(!move_uploaded_file($file['tmp'], $rutaNueva)){
            $this->responder(false, "No se pudo guardar archivo", 'Error al almacear el archivo subido', null, $mysqli);
        }

        if(!$mysqli->commit()){
            $this->responder(false, "No se pudo confirmar cambios", $mysqli->error, null, $mysqli);
        }

        $this->responder(true, "Aviso creado!", "redirect", '/');

    }

}

$ctrl = new ctrlAviso(true);

?>