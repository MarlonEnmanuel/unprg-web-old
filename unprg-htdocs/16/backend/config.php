<?php

/**
 * Configuración general del proyecto
 *
 * Esta clase contiene datos, configuraciones y
 * y funciones importantes para el proyecto
 *
 * @author Marlon Enmanuel Montalvo Flores
 */

class config {

	public static $isDeveloping = true; // indica si el codigo actual está en desarrollo o producción


	/* Datos del dominio del proyecto
	*/
	public static $path_dom = 'http://www.unprg.edu.pe/';	// dominio del proyecto
	public static $path_int = '16';       					// carpeta interna del proyecto


	/* Datos de conección a la BD
	*/
	public static $db_host = "192.168.0.10";           		//Dirección de la BD
	public static $db_user = "root";            			//Usuario de la BD
	public static $db_pass = "root";          					//Password de la BD
	public static $db_name = "unprg-web";        			//Nombre de la BD	
	public static $db_port = "3306";         				//Puerto de la BD


	/* Formatos de fecha usados en el proyecto
	*/
	public static $date_sql = "Y-m-d H:i:s";				//Formato de la BD
	public static $date_aviso = "d/m/Y";					//Formato de los avisos


	/* Rutas de alamacenamiento de archivos
	*/
	public static $path_avisos = "/frontend/avisos/";     	//Debe comenzar y terminar en '/'



	/**
	* Genera la ruta para un archivo, orientado al lado del cliente (navegadores)
	*
	* @param $withDom Incluir el dominio
	* @param $path Ruta
	* @return Ruta relativa o absulta
	*/
	public static function getPath($withDom, $path){
		$rel = false;
		if(substr($path, 0, 1) == '/'){
			$path = substr($path, 1);
			$rel = true;
		}
		if($withDom===true && config::$isDeveloping===false){
			return config::$path_dom.config::$path_int.'/'.$path;
		}else{
			return (($rel)?'/':'').config::$path_int.'/'.$path;
		}
	}

	/**
	* Genera una ruta absoluta para importar clases o archivos, sin perder la referencia, al ser invocados desde scripts ubicados en diferentes carpetas y niveles del servidor.
	*
	* @return conección con la BD
	*/
	public static function getRequirePath($path){
		if(substr($path, 0, 1) == '/') $path = substr($path, 1);
		return $path = $_SERVER['DOCUMENT_ROOT'].'/'.config::$path_int.'/'.$path;
	}

	/**
	* Genera la etiqueta html link configurada, dada una ruta. Usada solo para mayor orden en los documentos.
	*
	* @return string Etiqueta html link
	*/
	public static function getLink($path){
		return '<link rel="stylesheet" type="text/css" href="'.$path.'">';
	}

	/**
	* Genera la etiqueta html script configurada, dada una ruta. Usada solo para mayor orden en los documentos.
	*
	* @return string Etiqueta html script
	*/
	public static function getScript($path){
		return '<script src="'.$path.'"></script>';
	}


	/**
	* Abre una conección a la BD, y configura el charset a UTF-8
	*
	* @return mysqli Conección a la base de datos
	*/
	public static function getMysqli(){
		$mysqli =   new mysqli (config::$db_host,
                            	config::$db_user,
                            	config::$db_pass,
                            	config::$db_name,
                            	config::$db_port);
		$mysqli->set_charset("utf8");
		return $mysqli;
	}

}

?>