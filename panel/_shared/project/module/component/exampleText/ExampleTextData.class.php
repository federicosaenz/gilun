<?php
/**
 * Clase de modelo de la home
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package project
 * @subpackage page
 * 
 */

final class ExampleTextData extends DataObject {

	public function init() {
		$this->setText("Bienvenido al Framework Gilún.");
	}
}
?>