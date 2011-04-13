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

	/**
	 * Contiene la clase de configuracion de la aplicacion
	 * @var stdClass
	 */
	public $env;

	/**
	 * Contiene la clase de configuracion de la aplicacion
	 * @var stdClass
	 */
	public $config;

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
	 * Corre la aplicacion
	 */
	public function run() {

		#Traigo el objeto de configuracion del entorno
		$this->env = Config::getEnv();

		if(class_exists($className = Get::getParameter("manager","Home"))) {
			$manager = new $className(ucfirst(Get::getParameter("output","OutputHtml")));
			
			if(method_exists($manager, $accion = Get::getParameter("accion","render")) ) {
				$manager->getOutput()->setData($manager->$accion());
//				$manager->getOutput()->write();
			} else {
				#EXCEPCION: no existe la accion para ese manager
			}
		} else {
			#EXCEPCION: devolver excepcion de que no existe el manager o el output es invalido
		}
		 
		#Levanto la cache
			#Si tiene cache, la muestro

			#Si no tiene cache,
				#levanto la base de datos

				#Creo la pagina
				#Levanto la configuracion de la pagina
				#Le seteo el output
				#Le seteo el action
				#Le seteo la data al output
				#Imprimo el output, y se lo asigno a la cache
			#
		#
	}
}
?>