<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
require_once config::getRequirePath('backend/controllers/abstractController.php');
require_once config::getRequirePath('backend/models/Aviso.php');
require_once config::getRequirePath('backend/models/Archivo.php');

class ctrlAviso extends abstractController {

    protected function init($accion){

        if($accion == 'getVisibles'){   //acción del controlador
            $this->getVisibles();

        }elseif($accion == ''){         //acción del controlador
            

        }elseif($accion == ''){         //acción del controlador


        }elseif($accion == ''){         //acción del controlador


        }else{                          //responde cuando la acción no corresponde a ningun controlador
            $this->responder(false, "Acción no soportada");
        }
    }

    protected function getVisibles() {
        $mysqli = config::getMysqli();
        $aux = new Aviso($mysqli);

        $lista = $aux->searchVisible();
        $avisos = [];
        foreach ($lista as $key => $aviso) {
            $archivo = new Archivo($mysqli,$aviso->idArchivo);
            $archivo->get();
            $arrayAviso = array(
                'id'        => $aviso->id,
                'fecha'     => $aviso->fchReg->format(config::$date_aviso),
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
        $avisos = array('avisos' => $avisos);
        echo json_encode($avisos);
    }

}

$ctrl = new ctrlAviso(true);

?>