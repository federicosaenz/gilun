<?php
/**
 * Clase que maneja el tipo de output html
 *
 * @author Federico Saenz
 * @version 1.0 13/04/2011
 * @package lib
 * @subpackage output
 * 
 */

class OutputHtml extends Output {


	const OUTPUT_TYPE = "html";
	
	/**
	 * Setea la data
	 */
	public function setData(array $data) {
		
	}

	/**
	 * Devuelve el valor de la constante OUTPUT_TYPE. Debe tener el mismo valor que el indice del json de configuracion
	 * @return string
	 */
	public function getType() {
		return self::OUTPUT_TYPE;
	}
	
}
?>