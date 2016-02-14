<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
require_once config::getRequirePath('backend/controllers/abstractController.php');
require_once config::getRequirePath('backend/models/Aviso.php');

class ctrlAviso extends abstractController {

    protected function init($accion){

        if($accion == 'getVisibles'){   //acción del controlador
            $this->getVisibles();

        }elseif($accion == ''){         //acción del controlador
            

        }elseif($accion == ''){         //acción del controlador


        }elseif($accion == ''){         //acción del controlador


        }else{                          //responde cuando la acción no corresponde a ningun controlador
            $this->responder(false, "No se indicó una acción");
        }
    }

    protected function getVisibles(){

    }

}

$ctrl = new ctrlAviso(true);

?>