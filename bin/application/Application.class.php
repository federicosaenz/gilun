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
	private $config;

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
		$this->config = Config::getInstance();

		Routing::run();
	}


}
?>