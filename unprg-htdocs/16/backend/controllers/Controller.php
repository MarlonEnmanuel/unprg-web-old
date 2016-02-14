<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/16/backend/config.php';
require_once config::getRequirePath('backend/controllers/abstractController.php');

class Controller extends abstractController {

    protected function init($accion){
        return false;
    }

}

?>