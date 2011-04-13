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
		$this->dom->loadHTML($src);
	}
}
?>
