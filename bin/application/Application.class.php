<?php
/**
 * Clase main de la aplicacion
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package bin
 * @subpackage pattern
 * @uses Config
 * 
 */

final class Application extends Singleton {

	private $displayErrors = true;
	
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
		Project::defineConstants();
		#Seteo el output
		$this->output = Get::getParameter("output","html");

		#Parametros globales
		$manager	= Get::getParameter("manager","Home");
		$accion		= Get::getParameter("accion","render");
		
		if(class_exists($className = $manager)) {
			$managerClass = new $className($accion);
			$cacheConf = $managerClass->getCache();
			Cache::setup($cacheConf->status,$cacheConf->expires,Server::get("REQUEST_URI"));
			if($cache = Cache::read()) {
				echo $cache;
				echo "<!-- FROM CACHE -->";
			} else {
				if(method_exists($managerClass, $accion) ) {
					$managerClass->$accion();
					$content = $managerClass->getOutput()->write();
					Cache::write($content);
					if($this->displayErrors) {
						ErrorLog::getInstance()->displayErrors();
					}
					echo $content;
				} else {
					#EXCEPCION: no existe la accion para ese manager.
				}
				
			}
		} else {
			#EXCEPCION: devolver excepcion de que no existe el manager o el output es invalido
		}

//		echo Timer::get();
	}

	public function displayErrors($displayErrors) {
		$this->displayErrors = $displayErrors;
	}
	
	public function getDomain() {
		return $this->env->domain;
	}
}
?>