<?php
/**
 * Clase abstracta para manejo de outputs
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package lib
 * @subpackage output
 *
 */
abstract class Output {

	/**
	 * Contiene la clase que maneja el output de tipo Html
	 */
	protected $engine;

	/**
	 * Contiene el path del archivo de template
	 */
	protected $tpl;

	/**
	 * Contiene el valor que se escribe
	 * @var string
	 */
	protected $output;
	
	/**
	 * Setter de engine
	 * @param stdClass $engine
	 */
	public function setEngine($engine) {
		$this->engine = $engine;
	}

	/**
	 * Getter de engine
	 * @return class
	 */
	public function getEngine() {
		return $this->engine;
	}

	/**
	 * Setter de tpl
	 * @param string $tpl
	 */
	public function setTpl($tpl) {
		$this->engine->setTpl($tpl);
	}
}
?>
