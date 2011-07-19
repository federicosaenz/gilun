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
final class Config {

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

	const ENVIRONMENT_FILE	= "environment.config.json";
	const CONFIG_FILE		= "config.json";


	/**
	 * Devuelve el objeto de configuracion del environment
	 * @return stdClass
	 */
	public static function getEnv() {
		if(!self::$env) {
			$envFile = PATH_CONFIG.self::ENVIRONMENT_FILE;
			$envConfig = self::getJson($envFile);
			if(!empty($envConfig)) {
				foreach($envConfig as $env=>$oConfig) {
					if($oConfig->domain == Server::get("HTTP_HOST")) {
						self::$env = $oConfig;
					}
				}
			} else {
				#Devolver excepcion de que no se encuentra el objeto de configuracion o que no es un json valido
			}
		}
		return self::$env;
	}

	/**
	 * Levanta y devuelve un archivo de configuracion json
	 * @param string $jsonPath El path del archivo
	 */
	public static function getJson($file) {
		if(is_readable($file)) {
			return json_decode(file_get_contents($file));
		} else {
			#Devolver excepcion de que no se encuentra el archivo json
		}
	}


	/**
	 * Configura el modulo
	 * @param Page $module
	 */
	public static function module(Module $module) {
		if($module->getOutput()) {
			$type = $module->getOutput()->getType();
			$cnf = self::getJson($module->getConfigPath());
			if($cnf->data) {
				$module->data =  new $cnf->data();
			}
			foreach($cnf->output->$type as $property => $value) {
				switch($property) {
					case "engine":
						$module->getOutput()->setEngine(new $value());
					break;
					case "tpl":
						$module->getOutput()->setTpl(PATH_PROJECT.$value);
					break;
					default:
						$module->getOutput()->$property = $value;
					break;
				}
			}
			if($cnf->cache) {
				$module->setCache($cnf->cache);
			}
		} else {
			#Excepcion de que no existe el output
		}
	}
}
?>