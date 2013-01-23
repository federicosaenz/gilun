<?php
/**
 * Clase abstracta para manejo de outputs
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package console
 * @subpackage task
 *
 */
abstract class Task implements ITask{

	/**
	 * Constructor de la clase
	 * @return void
	 */
	public function __construct() {
		$this->declareArguments();
	}
	
	/**
	 * Declara los argumentos a ser utilizados
	 */
	public function declareArguments() {
	}
	
	public function run() {}
}
?>
