<?php
/**
 * Clase de configuracion de la aplicacion
 *
 * @author Federico Saenz 
 * @version 1.0 11/04/2011
 * @package bin
 * @subpackage system
 *
 */

final class Config extends Singleton {

	/**
	 * Contiene el objeto de configuracion de environment que sale del json correspondiente
	 * @var stdClass
	 */
	public static $env;

	/**
	 * Contiene el objeto de configuracion de la aplicacion que sale del json de configuracion en el environment correspondiente
	 * @var stdClass
	 */
	private static $config;

	const ENVIRONMENT_FILE	= "environment.json";
	const CONFIG_FILE		= "config.json";

	/**
	 * Constructor de la clase
	 */
	protected function  __construct() {
	}
	
	/**
	 * Devuelve la instancia de Application.
	 * @return stdClass
	 */
	public static function getInstance() {
		parent::$classname = __CLASS__;
		self::init();
		return parent::getInstance();
	}

	/**
	 * Devuelve la configuracion del environment
	 * 
	 */
	public static function init() {
		self::setEnv();

		$pathConfig = PATH_CONFIG.self::$env->name.DIRECTORY_SEPARATOR.self::CONFIG_FILE;
		
		#Cargar la configuracion del environment
	}

	private static function setEnv() {
		if(!self::$env) {
			$envFile = PATH_CONFIG.self::ENVIRONMENT_FILE;
			if(is_readable($envFile)) {
				$envConfig = json_decode(file_get_contents($envFile));
				if(!empty($envConfig)) {
					foreach($envConfig as $env=>$oConfig) {
						if($oConfig->domain == Server::get("HTTP_HOST")) {
							self::$env = $oConfig;
						}
					}
				} else {
					#Devolver excepcion de que no se encuentra el objeto de configuracion o que no es un json valido
				}
			} else {
				#Devolver excepcion de que no se ecuentra el environment
			}
		}
	}
}
?>