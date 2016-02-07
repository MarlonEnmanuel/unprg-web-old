<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Vistas
 *
 * @author Enmanuel
 */
class Vistas {

    private static function rederTemplate($url, $data = array()) {
        try {
            $tmp = file_get_contents($url, true);
            if ($tmp) {
                foreach ($data as $clave => $valor) {
                    $bus = '<%= ' . $clave . ' %>';
                    $tmp = str_replace($bus, $valor, $tmp);
                }
                return $tmp;
            } else {
                return false;
            }
        } catch (Exception $ex) {
            return false;
        }
    }

    public static function getHeader($Usuario) {
        $url;
        $Usuario['nocache'] = time();
        if($Usuario['tipo']=='A'){
            $url = 'tpHeaderA.html';
        }else{
            $url = 'tpHeaderB.html';
        }
        return Vistas::rederTemplate($url, $Usuario);
    }

    public static function getFooter() {
        $url = 'tpFooter.html';
        return Vistas::rederTemplate($url);
    }
    
    public static function getMailBienvenido($Usuario){
        $url = 'mailBienvenido.html';
        return Vistas::rederTemplate($url,$Usuario);
    }
    
    public static function getMailInvitacionUser($datos){
        $url = 'mailInvitacionUser.html';
        return Vistas::rederTemplate($url,$datos);
    }
    
    public static function getMailInvitacionNew($datos){
        $url = 'mailInvitacionNew.html';
        return Vistas::rederTemplate($url,$datos);
    }
}