<?php
/**
 * Clase abstracta para manejo de Modulos
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package bin
 * @subpackage application
 * @uses lib/Get.class.php
 */

abstract class Module {

	/**
	 * Clase para manejo de output
	 * @var stdClass
	 */
	protected $output;

	/**
	 * Constructor de la clase. Crea la instancia de la clase que maneja el output
	 * @param string $output
	 */
	public function __construct() {
		$output = ucfirst(Get::getParameter("output","OutputHtml"));
		
		if(class_exists($output)) {
			$this->output = new $output();
		}
		Config::module($this);
	}

	/**
	 * Devuelve la instancia de la clase de Output
	 * @return Output
	 */
	public function getOutput() {
		return $this->output;
	}

	public function write() {
		echo $this->output->write();
	}

	public function getContent() {
		return $this->output->getContent();
	}

}
?>
