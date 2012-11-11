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
abstract class Component extends Module {

	/**
	 * Constructor de la clase. Crea la instancia de la clase que maneja el output
	 * @param string $output
	 */
	public function __construct($output=null) {
		parent::__construct($output);
		$this->render();
	}
}
?>
