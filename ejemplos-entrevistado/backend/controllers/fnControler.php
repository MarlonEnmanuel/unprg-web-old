<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fnControler
 *
 * @author Enmanuel
 */

function Respoder($estado,$mensaje,$detalle,$datos=array()){
    $rpta = array(
            'estado' => $estado,
            'mensaje' => $mensaje,
            'detalle' => $detalle,
            'data' => $datos
            );
    header('Content-type: application/json; charset=utf-8');
    echo json_encode($rpta);
    exit;
}