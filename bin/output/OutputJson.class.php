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
class OutputJson extends Output {


	const OUTPUT_TYPE = "json";
	
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

	public function write() {
		return $this->engine->write();
	}

	public function addChild($elementName,array $child) {
		$this->engine->addChild($elementName,$child);
	}

	public function getContent() {
		return $this->engine->getContent();
	}

	public function setValue($elementName,$value) {
		$this->engine->setValue($elementName,$value);
	}

	public function setAttribute($element,$attribute,$value) {
		$this->engine->setAttribute($element,$attribute,$value);
	}

	public function process($moduleClass) {
	}

	public function getElement($tagName) {
		return $this->engine->getElement($tagName);
	}
}
?>