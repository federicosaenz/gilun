<?php
/**
 * Clase manager de contenido Home
 *
 * @author Federico Saenz
 * @version 1.0 12/04/2011
 * @package project
 * @subpackage page
 * 
 */

final class Home extends Page implements IPage {

	
	public function getConfigPath() {
		return dirname(__FILE__).DIRECTORY_SEPARATOR.self::CONFIG_FILE;
	}

	/**
	 * Metodo que devuelve los datos para impresion de la pagina
	 */
	public function render() {
		return array("hola","mundo");
	}
}
?>
