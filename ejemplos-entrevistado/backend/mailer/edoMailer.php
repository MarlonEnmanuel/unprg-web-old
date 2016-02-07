<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of edoMailer
 *
 * @author Enmanuel
 */
require_once('class.phpmailer.php');
require_once('class.smtp.php');
require_once('../views/Vistas.php');

class edoMailer {
    
    private static $m_user = 'entrevistado.com@gmail.com';
    private static $m_pass = 'negocioselectronicos';
    private static $m_smtp = 'smtp.gmail.com';
    private static $m_port = '465';
    
    public $estado;
    public $mensaje;
    public $detalle;
    
    public function sendBienvenida($datos){
        if( !(  isset($datos['email']) &&
                isset($datos['nombres']) &&
                isset($datos['apellidos'])
                ) ){
            $this->estado = false;
            $this->mensaje = 'Faltan datos para el envío del correo';
            return $this->estado;
        }
        
        $html = Vistas::getMailBienvenido($datos);
        if($html){
            try{
                $mail = $this->createMail();
                
                $mail->Subject = 'Bienvenido '.$datos['nombres'];
                $mail->msgHTML($html);
                $mail->addAddress($datos['email'],$datos['nombres']);
                if($mail->send()){
                    $this->estado = true;
                    $this->mensaje = 'Correo enviado';
                }else{
                    $this->estado = false;
                    $this->mensaje = 'Error al enviar correo';
                    $this->detalle = $mail->ErrorInfo;
                }
            } catch (Exception $ex) {
                $this->estado = false;
                $this->mensaje = 'Error al enviar correo';
                $this->detalle = $ex->getMessage();
            }
        }else{
            $this->estado = false;
            $this->mensaje = 'Error al cargar plantilla';
        }
        return $this->estado;
    }
    
    public function sendInvitacion($datos){
        if( !(  isset($datos['email']) &&
                isset($datos['nombres']) &&
                isset($datos['apellidos']) &&
                isset($datos['titulo']) &&
                isset($datos['fchInicio']) &&
                isset($datos['fchFin']) 
                ) ){
            $this->estado = false;
            $this->mensaje = 'Faltan datos para el envío del correo';
            return $this->estado;
        }
        
        $html = false;
        if(isset($datos['codigo'])){
            $html = Vistas::getMailInvitacionNew($datos);
        }else{
            $html = Vistas::getMailInvitacionUser($datos);
        }
        if(!$html){
            $this->estado = false;
            $this->mensaje = 'Error al cargar plantilla';
            return $this->estado;
        }
        
        try{
            $mail = $this->createMail();

            $mail->Subject = 'Tiene una invitació en entrevistaDO';
            $mail->msgHTML($html);
            $mail->addAddress($datos['email'],$datos['nombres']);
            if($mail->send()){
                $this->estado = true;
                $this->mensaje = 'Correo enviado';
            }else{
                $this->estado = false;
                $this->mensaje = 'Error al enviar correo';
                $this->detalle = $mail->ErrorInfo;
            }
        } catch (Exception $ex) {
            $this->estado = false;
            $this->mensaje = 'Error al enviar correo';
            $this->detalle = $ex->getMessage();
        }
        
        return $this->estado;
    }
    
    private function createMail(){
        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        
        $mail->Host = edoMailer::$m_smtp;
        $mail->Port = edoMailer::$m_port;
        $mail->Username = edoMailer::$m_user;
        $mail->Password = edoMailer::$m_pass;
        
        $mail->setFrom(edoMailer::$m_user, 'entrevistaDO');
        $mail->addReplyTo(edoMailer::$m_user, 'entrevistaDO');
        
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        
        return $mail;
    }
    
}