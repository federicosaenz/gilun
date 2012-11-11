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

	public function createCssNode() {
		$nodeList = $this->engine->getElementsByTagName("head");
		$link = $this->engine->getDom()->createElement("link");
		$link->setAttribute("href",Css::getUrl());
	    $link->setAttribute("rel","stylesheet");
		$this->addChild($nodeList->item(0), $link);
	}
	public function write() {
		$this->createCssNode();
		return $this->engine->write();
	}

	public function addChild($element,$child) {
		return $this->engine->addChild($element,$child);
	}

	public function getContent() {
		return $this->engine->getContent();
	}

	public function setValue($elementId,$value) {
		$this->engine->setValue($elementId,$value);
	}

	public function process($moduleClass) {
		if($this->css) {
			Css::append($this->css,$moduleClass);
		}
//		if($this->js) {
//			Js::append($this->js);
//		}

	}
}
?>