<?php
/**
 * Motor de manejo de output del tipo html por medio de la Dom
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package output
 * @subpackage dom
 *
 */
final class DomHtml implements IOutput{
 
	const DOCTYPE = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">';

	const ENCODING = "UTF-8";

	private $dom;
	
	public function __construct() {
		$this->dom = new DOMDocument("1.0", self::ENCODING);
	}


	/**
	 * Levanta el TPL de configuracion
	 * @param string $src
	 */
	public function setTpl($src) {
		$this->dom->loadHTML(file_get_contents($src));
	}

	/**
	 * Trae un nodo en funcion del id
	 * @param string $elementId
	 * @return node
	 */
	public function getElementById($elementId) {
		return $this->dom->getElementById($elementId);
	}

	/**
	 * Setea un valor al nodo
	 * @param string $elementId
	 * @param string $value
	 */
	public function setValue($elementId,$value) {
		$this->getElementById($elementId)->nodeValue = $value;
	}

	/**
	 *
	 */
	public function getElementsByTagName($tagName) {
		return $this->dom->getElementsByTagName($tagName);
	}

	public function addChild($elementId,$child) {
		
	}

	public function write() {
		echo $this->dom->saveHTML();
	}
}
?>
