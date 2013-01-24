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


	/**
	 * Contiene el objeto de configuracion de la conexion a la base de datos
	 * @var stdClass
	 */
	private static $connection;

	const ENVIRONMENT_FILE	= "environment.config.json";
	const DATABASE_FILE		= "database.json";
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
				self::$env = $envConfig[0];
				foreach($envConfig as $env=>$oConfig) {
					if($oConfig->domain == Server::get("HTTP_HOST")) {
						self::$env = $oConfig;
						break;
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
			if($return = json_decode(file_get_contents($file))) {
				return $return;
			} else {
				echo "no leyo el json o el json esta vacio. archivo:$file";
				#Devolver excepcion de archivo json failed
			}
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
			$accion = $module->getAccion();
			
			foreach($cnf->actions->$accion->$type as $property => $value) {
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

	/**
	 * Configura la conexion a la base de datos
	 * @return stdClass
	 */
	public static function connection() {
	 	if(!self::$connection) {
			if(self::$env) {
				$dbFile = PATH_CONFIG.self::$env->name.DS.self::DATABASE_FILE;
			}
			self::$connection = self::getJson($dbFile);
			if(!is_array(self::$connection->connections)) {
				#Excepcion de que no existen conexiones a la BD
			}
		}

		return self::$connection;
	}
	
	/**
	 * Configura la clase de manejos de error
	 * @return stdClass
	 */
	public static function error(Errors $Error) {
		if(!self::$config) {
			if(self::$env) {
				$configFile = PATH_CONFIG.self::$env->name.DS.self::CONFIG_FILE;
			}
			self::$config = self::getJson($configFile);
		}
		$methodName = $Error::errorLevelText;
		$Error->setConfig(self::$config->debug->$methodName);
	}
}
?>