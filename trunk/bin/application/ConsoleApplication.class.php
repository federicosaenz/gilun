<?php
/**
 * Clase main de la consola
 *
 * @author Federico Saenz
 * @version 1.0 23/01/2013
 * @package bin
 * @subpackage application
 * @uses Config
 * 
 */

final class ConsoleApplication extends Singleton {

	/**
	 * Contiene la clase de configuracion de la aplicacion
	 * @var stdClass
	 */
	private $env;

	/**
	 * Contiene la clase de configuracion de la aplicacion
	 * @var stdClass
	 */
	private $config;

	/**
	 * Contiene el valor del output que se desea generar
	 * @var string
	 */
	private $output;
	
	/**
	 * Constructor de la clase
	 */
	protected function  __construct() {
		Console::declareArgument("manager");
	}

	/**
	 * Devuelve la instancia de Application. 
	 * @return stdClass
	 */
	public static function getInstance() {
		parent::$classname = __CLASS__;
		return parent::getInstance();
	}

	/**
	 * Getter para output
	 * @return string
	 */
	public function getOutput() {
		return $this->output;
	}

	/**
	 * Getter para env
	 * @return stdClass
	 */
	public function getEnv() {
		return $this->env;
	}

	/**
	 * Getter para config
	 * @return string
	 */
	public function getConfig() {
		return $this->config;
	}
	
	/**
	 * Corre la aplicacion
	 */
	public function run() {
		Timer::begin();
		
		#Traigo el objeto de configuracion del entorno
		$this->env = Config::getEnv();
		$manager = Console::getArgument("manager");
		
		if(class_exists($className = $manager)) {
			$managerClass = new $className();
			if($managerClass instanceof Task) {
				$managerClass->run();
			} else {
				Console::error("No esta definido el task ".$manager);
			}
		} else {
			Console::error("No esta definido el task ".$manager);
		}
	}

	/**
	 * Devuelve el dominio del sitio
	 * @return string
	 */
	public function getDomain() {
		return $this->env->domain;
	}
}
?>