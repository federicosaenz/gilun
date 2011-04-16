<?php
/**
 * Clase abstracta para manejo de Paginas
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package bin
 * @subpackage application
 *
 */

abstract class Page {

	/**
	 * Clase para manejo de output
	 * @var stdClass
	 */
	protected $output;

	/**
	 * Constructor de la clase. Crea la instancia de la clase que maneja el output
	 * @param string $output
	 */
	public function __construct($output) {
		$output = ucfirst($output);
		if(class_exists($output)) {
			$this->output = new $output();
		}
		Config::page($this);
	}

	/**
	 * Devuelve la instancia de la clase de Output
	 * @return Output
	 */
	public function getOutput() {
		return $this->output;
	}
}
?>
