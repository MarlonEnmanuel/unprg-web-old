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
        $mysqli = config::getMysqli();
$aviso = new Aviso($mysqli, 1);

$lista=array();
$lista=$aviso->searchVisible();
$datos='{
    "avisos" : [';
for ($i=0; $i < count($lista); $i++) { 
    $id=$lista[$i]->idAviso;
    $fchReg=$lista[$i]->fchReg;
    $texto=$lista[$i]->texto;
    $emergente=$lista[$i]->emergente;
    $visible=$lista[$i]->visible;
    $estado=$lista[$i]->estado;
    $bloqueado=$lista[$i]->bloqueado;
    $idArchivo=$lista[$i]->idArchivo;
    $idUsuario=$lista[$i]->idUsuario;
    $datos=$datos .'{';
    $datos=$datos .'"id":"'.$id.'",';
    $datos=$datos .'"fecha":"'.$fchReg.'",';
    $archivo= new Archivo($mysqli,$idArchivo);
    $archivo->get();
    $resp='false';
        if($emergente==1){
            $resp='true';
        }
    if($archivo->type=='link'){
        $datos=$datos.'"img":"'.$archivo->link.'",';
        $datos=$datos .'"emergente":"'.$resp.'",';
        $datos=$datos .'"link":"' .$archivo->nombre.'",';
    }else{
            $datos=$datos.'"'.$archivo->type.'":"'.$archivo->link.'",' ;
        
        $datos=$datos .'"emergente":"'.$resp.'",';
        $datos=$datos .'"nombre":"'.$archivo->nombre.'",';
    }
    
    $datos=$datos .'"texto:"'.$texto.'"';
    if($i+1==count($lista)){
        $datos=$datos .'}';
    }else{
        $datos=$datos .'},';
    }
    

}
$datos=$datos .'] }';

print_r($datos);

    }

}

$ctrl = new ctrlAviso(true);

?>