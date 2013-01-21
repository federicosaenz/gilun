<?php
/**
 * Motor de manejo de output del tipo json 
 *
 * @author Federico Saenz
 * @version 1.0 11/04/2011
 * @package output
 * @subpackage dom
 *
 */
final class Json implements IOutput {
 
	private $tpl;
	
	public function __construct() {
//		$this->dom = new DOMDocument("1.0", self::ENCODING);
	}

	public function getDom() {
//		return $this->dom;
	}
	
	/**
	 * Levanta el TPL de configuracion
	 * @param string $src
	 */
	public function setTpl($src) {
		$this->tpl = file_get_contents($src);
	}

	/**
	 * Setea un valor al nodo
	 * @param string $elementId
	 * @param string $value
	 */
	public function setValue($elementName,$value) {
		$this->tpl = str_replace("@@".$elementName."@@",$value,$this->tpl);
//		$this->getElementById($elementId)->nodeValue = $value;
	}

	public function addObjectChild($elementName,stdClass $object){}
	
	public function addChild($elementName,array $child){
		$strArray = json_encode($child);
		$this->tpl = str_replace("@@".$elementName."@@",$strArray,$this->tpl);
	}
	
	
	public function setAttribute($element,$attribute,$value) {
//		$node = $this->getElementById($element);
//		$node->setAttribute($attribute,$value);
	}

	/**
	 *
	 */
	public function getElementsByTagName($tagName) {
//		return $this->dom->getElementsByTagName($tagName);
	}

	public function getContent() {
		return $this->tpl;
	}

	public function write() {
		$return = $this->tpl;
		return $return;
	}

	public function getElement($tagName) {
	}
}
?>